@extends('layouts.admin')

@section('title', 'Berita | LSP CMS')
@section('page_title', 'Manajemen Berita')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold">Manajemen Berita</h1>
      <p class="text-sm text-gray-600">Kelola data berita.</p>
    </div>

    <div class="flex items-center gap-2">
      <form action="{{ route('admin.berita.index') }}" method="GET"
        class="hidden sm:flex items-center gap-2 h-[48px] bg-gray-50 rounded-lg px-4 flex-shrink-0">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <input name="q" value="{{ request('q') }}" placeholder="Cari sesuatu..."
          class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder:text-gray-400" />
      </form>

      <a
        href="{{ route('admin.berita.create') }}"
        class="inline-flex items-center px-4 py-2 rounded-lg bg-[#FACC15] text-[#132133] font-semibold hover:bg-yellow-400"
      >
        Tambah Data
      </a>
    </div>
  </div>

  @if(session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3">
      {{ session('success') }}
    </div>
  @endif

  <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Judul</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Tanggal</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Status</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Sumber</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Gambar</th>
          <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600">Aksi</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-100">
        @forelse($beritas as $item)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3">
              <div class="text-gray-900 font-medium max-w-xs truncate">
                {{ $item->judul }}
              </div>
              <div class="text-xs text-gray-500">/{{ $item->slug }}</div>
            </td>

            <td class="px-4 py-3 text-gray-700">
              {{ \Illuminate\Support\Carbon::parse($item->tanggal)->format('d M Y') }}
            </td>

            <td class="px-4 py-3">
              <span
                class="px-2 py-1 text-xs rounded-full
                {{ $item->status === 'publish'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-yellow-100 text-yellow-700' }}"
              >
                {{ ucfirst($item->status) }}
              </span>
            </td>

            <td class="px-4 py-3 text-gray-700">
              {{ $item->sumber }}
            </td>

            <td class="px-4 py-3">
              @if($item->gambar)
                <img
                  src="{{ asset('storage/' . $item->gambar) }}"
                  alt="{{ $item->judul }}"
                  class="h-10 w-16 rounded-md object-cover border"
                />
              @else
                <span class="text-xs text-gray-400">—</span>
              @endif
            </td>

            <td class="px-4 py-3">
              <div class="flex items-center justify-end gap-2">
                <a
                  href="{{ route('admin.berita.edit', $item) }}"
                  class="inline-flex px-3 py-1.5 text-sm rounded-md border border-gray-200 hover:bg-gray-50"
                >
                  Edit
                </a>

                <form
                  action="{{ route('admin.berita.destroy', $item) }}"
                  method="POST"
                  onsubmit="return confirm('Hapus berita ini?')"
                >
                  @csrf
                  @method('DELETE')
                  <button
                    class="inline-flex px-3 py-1.5 text-sm rounded-md bg-red-600 text-white hover:bg-red-700"
                  >
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-4 py-10 text-center text-gray-500">
              Belum ada berita.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $beritas->links() }}
  </div>
@endsection
