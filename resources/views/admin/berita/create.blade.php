@extends('layouts.admin')

@section('title', 'Tambah Berita | LSP CMS')
@section('page_title', 'Tambah Berita')
@section('content')
<a href="javascript:history.back()" class="inline-flex items-center gap-2 text-gray-600 text-sm mb-4">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
        <path d="M10.828 12l4.95-4.95a1 1 0 10-1.414-1.414l-6.364 6.364a1 1 0 000 1.414l6.364 6.364a1 1 0 001.414-1.414L10.828 12z" />
    </svg>
    Kembali
</a>
<h1 class="text-3xl font-semibold mb-4">Tambah Berita</h1>
<div class="bg-white rounded-2xl shadow border overflow-hidden">
    <div class="p-6">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if ($errors->any())
            <div class="rounded-lg border border-red-200 bg-red-50 text-red-700 px-4 py-3">{{ $errors->first() }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-5">
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                            class="block w-full rounded-lg border border-gray-300 bg-white shadow-sm
                       px-3 py-2 focus:border-black focus:ring-1 focus:ring-black sm:text-sm" required>
                        @error('judul')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-1">
                            Isi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="isi" id="isi" rows="6"
                            class="block w-full rounded-lg border border-gray-300 bg-white shadow-sm
                       px-3 py-2 focus:border-black focus:ring-1 focus:ring-black sm:text-sm" required>{{ old('isi') }}</textarea>
                        @error('isi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="sumber" class="block text-sm font-medium text-gray-700 mb-1">
                            Penulis <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="sumber" id="sumber" value="{{ old('sumber') }}"
                            class="block w-full rounded-lg border border-gray-300 bg-white shadow-sm
                       px-3 py-2 focus:border-black focus:ring-1 focus:ring-black sm:text-sm" required>
                        @error('sumber')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">
                            Tanggal
                        </label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                            max="{{ now()->toDateString() }}"
                            class="block w-full rounded-lg border border-gray-300 bg-white shadow-sm
                       px-3 py-2 focus:border-black focus:ring-1 focus:ring-black sm:text-sm" required>
                        @error('tanggal')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="rounded-xl border border-gray-200 p-4">
                        <div class="flex items-center justify-between mb-3">
                            <span class="font-medium">Unggah Gambar</span>
                            <span class="text-red-500">*</span>
                        </div>
                        <div class="rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 overflow-hidden">
                            <label class="block relative cursor-pointer min-h-[220px]">
                                <!-- Placeholder content -->
                                <div id="uploadPlaceholder" class="absolute inset-0 flex flex-col items-center justify-center p-10 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mb-4"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M3 5a2 2 0 012-2h5l2 2h7a2 2 0 012 2v3h-2V7H5v10h6v2H5a2 2 0 01-2-2V5z" />
                                        <path d="M21 15l-5-5-4 4-2-2-5 5v2h16v-4z" />
                                    </svg>
                                    <div class="text-gray-800 font-semibold">Unggah gambar, atau
                                        <span class="text-blue-600 hover:underline">telusuri</span>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">Ukuran 1920×1080px, PNG/JPG</div>
                                </div>

                                <!-- Image preview fills the card -->
                                <img id="preview" class="absolute inset-0 w-full h-full object-cover hidden" alt="Preview">

                                <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden" required>
                            </label>
                        </div>

                        @error('gambar')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="block w-full rounded-lg border border-gray-300 bg-white shadow-sm
                       px-3 py-2 focus:border-black focus:ring-1 focus:ring-black sm:text-sm" required>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="publish" {{ old('status') === 'publish' ? 'selected' : '' }}>Publish</option>
                        </select>
                        @error('status')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>


            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ url()->previous() }}" class="px-5 py-2.5 border border-gray-300 text-gray-800 rounded-lg hover:bg-gray-50">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-black text-white font-semibold rounded-lg shadow hover:brightness-95">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto generate slug from judul
    const judul = document.getElementById('judul');
    const slug = document.getElementById('slug');
    if (judul && slug) {
        judul.addEventListener('input', () => {
            const s = judul.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            if (!slug.dataset.touched) slug.value = s;
        });
        slug.addEventListener('input', () => slug.dataset.touched = '1');
    }

    // Image preview inside upload card
    const fileInput = document.getElementById('gambar');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('uploadPlaceholder');
    if (fileInput && preview) {
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files?.[0];
            if (!file) {
                preview.src = '';
                preview.classList.add('hidden');
                if (placeholder) placeholder.classList.remove('hidden');
                return;
            }
            const url = URL.createObjectURL(file);
            preview.src = url;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        });
    }
</script>
@endpush
