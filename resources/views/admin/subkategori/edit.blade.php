@extends('layouts.admin')
@section('title', 'Edit Subkategori | LSP CMS')
@section('page_title', 'Edit Subkategori')

@section('content')
<div class="max-w-3xl mx-auto lg:px-[40px] md:px-[24px] px-[16px] py-8">
  <div class="mb-6">
    <h1 class="text-2xl font-semibold">Edit Subkategori</h1>
    <p class="text-sm text-gray-600">Perbarui data subkategori.</p>
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

  <form action="{{ route('admin.subkategori.update', $subkategori) }}" method="POST" class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-5">
    @csrf
    @method('PUT')

    <div>
      <label class="block text-sm font-medium text-gray-700">Kategori</label>
      <select name="kategori_id" class="mt-1 w-full rounded-lg border-gray-300 focus:border-black focus:ring-black">
        <option value="">— Pilih Kategori —</option>
        @foreach($kategoris as $k)
          <option value="{{ $k->id }}" {{ (string)old('kategori_id', $subkategori->kategori_id) === (string)$k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
        @endforeach
      </select>
      @error('kategori_id')
        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Nama Subkategori</label>
      <input type="text" name="nama_subkategori" value="{{ old('nama_subkategori', $subkategori->nama_subkategori) }}" class="mt-1 w-full rounded-lg border-gray-300 focus:border-black focus:ring-black">
      @error('nama_subkategori')
        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="flex items-center justify-end gap-2">
      <a href="{{ route('admin.subkategori.index') }}" class="inline-flex px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50">Batal</a>
      <button type="submit" class="inline-flex px-4 py-2 rounded-lg bg-[#FACC15] text-[#132133] font-semibold hover:bg-yellow-400">Simpan Perubahan</button>
    </div>
  </form>
</div>
@endsection
