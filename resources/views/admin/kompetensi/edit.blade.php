@extends('layouts.admin')
@section('title', 'Edit Kompetensi | LSP CMS')
@section('page_title', 'Edit Kompetensi')

@section('content')
<div class="py-8">
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-semibold">Edit Kompetensi</h1>
      <p class="text-sm text-gray-600">Perbarui data unit kompetensi.</p>
    </div>
    <a href="{{ route('admin.kompetensi.index') }}" class="inline-flex px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50">Kembali</a>
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

  <form action="{{ route('admin.kompetensi.update', $kompetensi) }}" method="POST" class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-5">
    @csrf
    @method('PUT')

    <div>
      <label class="block text-sm font-medium text-gray-700">Skema</label>
      <select name="skema_id" class="mt-1 w-full rounded-lg border-gray-300 focus:border-black focus:ring-black">
        @foreach($skemas as $s)
          <option value="{{ $s->id }}" @selected(old('skema_id', $kompetensi->skema_id)==$s->id)>{{ $s->kode_skema }} - {{ $s->nama_skema }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Kode Unit</label>
      <input type="text" name="kode_unit" value="{{ old('kode_unit', $kompetensi->kode_unit) }}" class="mt-1 w-full rounded-lg border-gray-300 focus:border-black focus:ring-black">
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Unit Kompetensi</label>
      <input type="text" name="unit_kompetensi" value="{{ old('unit_kompetensi', $kompetensi->unit_kompetensi) }}" class="mt-1 w-full rounded-lg border-gray-300 focus:border-black focus:ring-black">
    </div>

    <div class="flex items-center justify-end gap-2">
      <a href="{{ route('admin.kompetensi.index') }}" class="inline-flex px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50">Batal</a>
      <button type="submit" class="inline-flex px-4 py-2 rounded-lg bg-[#FACC15] text-[#132133] font-semibold hover:bg-yellow-400">Simpan</button>
    </div>
  </form>
</div>
@endsection
