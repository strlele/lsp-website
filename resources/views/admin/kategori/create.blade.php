@extends('layouts.admin')
@section('title', 'Tambah Kategori | LSP CMS')
@section('page_title', 'Tambah Kategori')

@section('content')
<div class="py-8">
  <div class="mb-6">
    <h1 class="text-2xl font-semibold">Tambah Kategori</h1>
    <p class="text-sm text-gray-600">Isi form berikut untuk menambah kategori baru.</p>
  </div>

  @if ($errors->any())
    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 text-rose-800 px-4 py-3">
      <ul class="list-disc list-inside text-sm">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.kategori.store') }}" method="POST" class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-5">
    @csrf

    <div>
      <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
      <input type="text"
             name="nama_kategori"
             value="{{ old('nama_kategori') }}"
             class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-black focus:ring-black"
             placeholder="contoh: Rekayasa Perangkat Lunak">
    </div>

    <div class="flex items-center justify-end gap-2">
      <a href="{{ route('admin.kategori.index') }}" class="inline-flex px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50">Batal</a>
      <button type="submit" class="inline-flex px-4 py-2 rounded-lg bg-[#FACC15] text-[#132133] font-semibold hover:bg-yellow-400">Simpan</button>
    </div>
  </form>
</div>
@endsection
