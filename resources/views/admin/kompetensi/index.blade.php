@extends('layouts.admin')
@section('title', 'Kompetensi | LSP CMS')
@section('page_title', 'Manajemen Kompetensi')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold">Manajemen Kompetensi</h1>
      <p class="text-sm text-gray-600">Kelola data unit kompetensi per skema.</p>
    </div>
    <div class="flex items-center gap-3">
      <form action="{{ route('admin.kompetensi.index') }}" method="GET"
        class="hidden sm:flex items-center gap-2 h-[48px] bg-gray-50 rounded-lg px-4 flex-shrink-0">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <input name="q" value="{{ request('q') }}" placeholder="Cari sesuatu..."
          class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder:text-gray-400" />
      </form>
      <a href="{{ route('admin.kompetensi.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-[#FACC15] text-[#132133] font-semibold hover:bg-yellow-400">Tambah Data</a>
    </div>
  </div>

  @if(session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3">{{ session('success') }}</div>
  @endif

  <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Kode Unit</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Unit Kompetensi</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Skema</th>
          <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($kompetensis as $k)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 font-mono text-sm text-gray-700">{{ $k->kode_unit }}</td>
            <td class="px-4 py-3 text-gray-900 font-medium">{{ $k->unit_kompetensi }}</td>
            <td class="px-4 py-3 text-gray-700">{{ $k->skema?->nama_skema }}</td>
            <td class="px-4 py-3">
              <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.kompetensi.show', $k) }}" class="inline-flex px-3 py-1.5 text-sm rounded-md border border-gray-200 hover:bg-gray-50">Lihat</a>
                <a href="{{ route('admin.kompetensi.edit', $k) }}" class="inline-flex px-3 py-1.5 text-sm rounded-md bg-amber-500 text-white hover:bg-amber-600">Edit</a>
                <form action="{{ route('admin.kompetensi.destroy', $k) }}" method="POST" onsubmit="return confirm('Hapus kompetensi ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="inline-flex px-3 py-1.5 text-sm rounded-md bg-rose-600 text-white hover:bg-rose-700">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-4 py-10 text-center text-gray-500">Belum ada kompetensi.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
