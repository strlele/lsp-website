@extends('layouts.admin')
@section('title', 'Pendaftar | LSP CMS')
@section('page_title', 'Pendaftar')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold">Pendaftar</h1>
      <p class="text-sm text-gray-600">Daftar pendaftar uji kompetensi.</p>
    </div>
    <form action="{{ route('admin.pendaftaran.index') }}" method="GET" class="flex items-center gap-2">
      <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/nis/nik/email" class="w-64 rounded-lg border-gray-300 focus:border-black focus:ring-black" />
      <button class="inline-flex px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50">Cari</button>
    </form>
  </div>

  <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">ID</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Nama</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Skema</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Kategori</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Email</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">No Telp</th>
          <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($pendaftarans as $p)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 text-gray-700">{{ $p->id }}</td>
            <td class="px-4 py-3 text-gray-900 font-medium">{{ $p->nama_lengkap }}</td>
            <td class="px-4 py-3 text-gray-700">{{ optional($p->skema)->nama_skema ?? '-' }}</td>
            <td class="px-4 py-3 text-gray-700">{{ optional(optional($p->skema)->kategori)->nama_kategori ?? '-' }}</td>
            <td class="px-4 py-3 text-gray-700">{{ $p->email ?? '-' }}</td>
            <td class="px-4 py-3 text-gray-700">{{ $p->no_telp ?? '-' }}</td>
            <td class="px-4 py-3">
              <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.pendaftaran.show', $p) }}" class="inline-flex px-3 py-1.5 text-sm rounded-md border border-gray-200 hover:bg-gray-50">Detail</a>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="px-4 py-10 text-center text-gray-500">Belum ada pendaftar.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $pendaftarans->links() }}</div>
@endsection
