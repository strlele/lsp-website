@extends('layouts.admin')
@section('title', 'Kategori | LSP CMS')
@section('page_title', 'Manajemen Kategori')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold">Kategori</h1>
      <p class="text-sm text-gray-600">Kelola daftar kategori skema.</p>
    </div>
    <a href="{{ route('admin.kategori.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-[#FACC15] text-[#132133] font-semibold hover:bg-yellow-400">Tambah Data</a>
  </div>

  @if(session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3">{{ session('success') }}</div>
  @endif

  <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">ID</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Nama Kategori</th>
          <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($kategoris as $k)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 text-gray-700">{{ $k->id }}</td>
            <td class="px-4 py-3 text-gray-900 font-medium">{{ $k->nama_kategori }}</td>
            <td class="px-4 py-3">
              <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.kategori.edit', $k) }}" class="inline-flex px-3 py-1.5 text-sm rounded-md border border-[#132133]/40 text-[#132133] hover:bg-[#132133]/5">Edit</a>
                <form action="{{ route('admin.kategori.destroy', $k) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="inline-flex px-3 py-1.5 text-sm rounded-md bg-red-600 text-white hover:bg-red-700">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="px-4 py-10 text-center text-gray-500">Belum ada kategori.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $kategoris->links() }}</div>
@endsection
