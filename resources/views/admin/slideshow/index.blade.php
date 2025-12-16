@extends('layouts.admin')

@section('title', 'Slideshow | LSP CMS')
@section('page_title', 'Manajemen Slideshow')

@section('content')
    <h1 class="text-3xl font-semibold mb-4">Slideshow</h1>
    <div class="bg-white rounded-2xl shadow border">
        <div class="p-6">
            @if ($errors->any())
                <div class="mb-3 text-sm text-red-600">{{ $errors->first() }}</div>
            @endif

            @php
                $count = isset($slideshows) ? $slideshows->count() : 0;
                $maxed = $count >= 3;
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
    @if(isset($slideshows) && $count)
        @foreach($slideshows as $slide)
            <div class="border rounded-xl overflow-hidden bg-gray-50 h-full">
                <div class="relative h-full">
                    @if($slide->files)
                        <img src="{{ asset('storage/'.$slide->files) }}" alt="slide" class="w-full h-full object-cover">
                    @endif
                    <div class="absolute top-2 right-2 flex gap-2">
                        <button type="button"
                                class="px-3 py-1 bg-[#E6E3FF] hover:bg-[#1D06F2] text-[#1D06F2] hover:text-white font-medium rounded text-sm open-edit-modal shadow"
                                data-action="{{ route('admin.slideshow.update', $slide) }}"
                                data-image="{{ $slide->files ? asset('storage/'.$slide->files) : '' }}">
                            Edit
                        </button>
                        <form action="{{ route('admin.slideshow.destroy', $slide) }}" method="POST" onsubmit="return confirm('Hapus slide ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-[#FFE3E3] hover:bg-[#D40008] text-[#D40008] hover:text-white font-medium rounded text-sm shadow">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if(!$maxed)
        <div class="rounded-xl border border-gray-200 p-5 flex flex-col">
            <div class="flex items-center justify-between mb-3">
                <span class="font-medium">Unggah Gambar</span>
                <span class="text-red-500">*</span>
            </div>
            <div class="rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 flex-1 flex items-center justify-center">
                <form action="{{ route('admin.slideshow.store') }}" method="POST" enctype="multipart/form-data" class="w-full h-full">
                    @csrf
                    <label class="flex flex-col items-center justify-center text-center cursor-pointer w-full h-full px-6 py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 text-gray-400 mb-4">
                            <path d="M3 5a2 2 0 012-2h5l2 2h7a2 2 0 012 2v3h-2V7H5v10h6v2H5a2 2 0 01-2-2V5z"/>
                            <path d="M21 15l-5-5-4 4-2-2-5 5v2h16v-4z"/>
                        </svg>
                        <div class="text-gray-800 font-semibold">Unggah gambar, atau
                            <span class="text-blue-600 hover:underline">telusuri</span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">Ukuran 1920×1080px diperlukan dalam format PNG atau JPG saja.</div>
                        <input type="file" name="files" accept="image/png,image/jpeg" class="hidden" onchange="this.form.submit()">
                    </label>
                </form>
            </div>
        </div>
    @endif
</div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl w-[90%] max-w-lg shadow-xl">
            <div class="flex items-center justify-between px-5 py-3 border-b">
                <h3 class="font-semibold">Edit Slide</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700" id="closeEditModal">✕</button>
            </div>
            <form id="editForm" action="#" method="POST" enctype="multipart/form-data" class="p-5 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pratinjau Saat Ini</label>
                    <img id="editPreview" src="" alt="preview" class="w-full h-48 object-cover rounded bg-gray-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ganti Gambar (opsional)</label>
                    <input type="file" name="files" accept="image/png,image/jpeg" class="border rounded px-3 py-2 w-full">
                    <p class="text-xs text-gray-500 mt-1">Disarankan 1920×1080px, PNG/JPG</p>
                </div>
                <div class="flex items-center justify-end gap-2 pt-2">
                    <button type="button" class="px-4 py-2 rounded bg-gray-200" id="cancelEdit">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded bg-gray-900 text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function () {
            const modal = document.getElementById('editModal');
            const closeBtn = document.getElementById('closeEditModal');
            const cancelBtn = document.getElementById('cancelEdit');
            const form = document.getElementById('editForm');
            const preview = document.getElementById('editPreview');
            function open(action, img) {
                form.setAttribute('action', action);
                if (img) { preview.src = img; } else { preview.removeAttribute('src'); preview.classList.add('bg-gray-100'); }
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
            function close() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
            document.addEventListener('click', (e) => {
                const btn = e.target.closest('.open-edit-modal');
                if (btn) {
                    e.preventDefault();
                    open(btn.getAttribute('data-action'), btn.getAttribute('data-image'));
                }
            });
            [closeBtn, cancelBtn].forEach(el => el && el.addEventListener('click', close));
            modal.addEventListener('click', (e) => { if (e.target === modal) close(); });
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });
        })();
    </script>
@endsection
