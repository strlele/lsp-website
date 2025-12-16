@extends('layouts.admin')
@section('title', 'Tambah Subkategori | LSP CMS')
@section('page_title', 'Tambah Subkategori')

@section('content')
<div class="py-8">
  <div class="mb-6">
    <h1 class="text-2xl font-semibold">Tambah Subkategori</h1>
    <p class="text-sm text-gray-600">Isi form berikut untuk menambah subkategori baru.</p>
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

  <form action="{{ route('admin.subkategori.store') }}" method="POST" class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-5">
    @csrf

    <div>
      <label class="block text-sm font-medium text-gray-700">Kategori</label>
      <select
        name="kategori_id"
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-black focus:ring-black"
      >
        <option value="">— Pilih Kategori —</option>
        @foreach($kategoris as $k)
          <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
            {{ $k->nama_kategori }}
          </option>
        @endforeach
      </select>
      @error('kategori_id')
        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Nama Subkategori</label>
      <input
        type="text"
        name="nama_subkategori"
        value="{{ old('nama_subkategori') }}"
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-black focus:ring-black"
        placeholder="contoh: Sistem Informasi"
      >
      @error('nama_subkategori')
        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="flex items-center justify-end gap-2">
      <a href="{{ route('admin.subkategori.index') }}" class="inline-flex px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50">Batal</a>
      <button type="submit" class="inline-flex px-4 py-2 rounded-lg bg-[#FACC15] text-[#132133] font-semibold hover:bg-yellow-400">Simpan</button>
    </div>
  </form>
</div>
@endsection
