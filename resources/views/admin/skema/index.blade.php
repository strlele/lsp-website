@extends('layouts.admin')
@section('title', 'Skema | LSP CMS')
@section('page_title', 'Manajemen Skema')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold">Manajemen Skema</h1>
      <p class="text-sm text-gray-600">Kelola data skema sertifikasi.</p>
    </div>
    <div class="flex items-center gap-3">
      <form action="{{ route('admin.skema.index') }}" method="GET"
        class="hidden sm:flex items-center gap-2 w-[240px] h-[48px] bg-gray-50 rounded-lg px-4 flex-shrink-0">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <input name="q" value="{{ request('q') }}" placeholder="Cari sesuatu..."
          class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder:text-gray-400" />
      </form>
      <a href="{{ route('admin.skema.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-[#FACC15] text-[#132133] font-semibold hover:bg-yellow-400">Tambah Data</a>
    </div>
  </div>

  <form action="{{ route('admin.skema.index') }}" method="GET" class="sm:hidden mb-4">
    <div class="flex items-center gap-2 w-full h-[48px] bg-gray-50 rounded-lg px-4">
      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
      </svg>
      <input name="q" value="{{ request('q') }}" placeholder="Cari sesuatu..."
        class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder:text-gray-400" />
    </div>
  </form>

  @if(session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3">{{ session('success') }}</div>
  @endif

  <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Kode</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Nama Skema</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Kategori - Subkategori</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Jumlah Kompetensi</th>
          <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($skemas as $s)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 font-mono text-sm text-gray-700">{{ $s->kode_skema }}</td>
            <td class="px-4 py-3 text-gray-900 font-medium">{{ $s->nama_skema }}</td>
            <td class="px-4 py-3 text-gray-700">{{ (optional($s->kategori)->nama_kategori ?? '-') . ' - ' . (optional($s->subkategori)->nama_subkategori ?? '-') }}</td>
            <td class="px-4 py-3 text-gray-700">{{ $s->kompetensis_count ?? $s->kompetensis()->count() }}</td>
            <td class="px-4 py-3">
              <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.skema.show', $s) }}" class="inline-flex px-3 py-1.5 text-sm rounded-md border border-gray-200 hover:bg-gray-50">Lihat</a>
                <a href="{{ route('admin.skema.edit', $s) }}" class="inline-flex px-3 py-1.5 text-sm rounded-md border border-[#132133]/40 text-[#132133] hover:bg-[#132133]/5">Edit</a>
                <form action="{{ route('admin.skema.destroy', $s) }}" method="POST" onsubmit="return confirm('Hapus skema ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="inline-flex px-3 py-1.5 text-sm rounded-md bg-red-600 text-white hover:bg-red-700">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-4 py-10 text-center text-gray-500">Belum ada skema.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
