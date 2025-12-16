@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto lg:px-[40px] md:px-[24px] px-[16px] py-8">
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold">Detail Kompetensi</h1>
      <p class="text-sm text-gray-600">Informasi unit kompetensi dan skema terkait.</p>
    </div>
    <div class="flex items-center gap-2">
      <a href="{{ route('admin.kompetensi.edit', $kompetensi) }}" class="inline-flex px-4 py-2 rounded-lg bg-amber-500 text-white hover:bg-amber-600">Edit</a>
      <a href="{{ route('admin.kompetensi.index') }}" class="inline-flex px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50">Kembali</a>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-4">
      <div>
        <div class="text-xs text-gray-500">Kode Unit</div>
        <div class="font-mono text-gray-900">{{ $kompetensi->kode_unit }}</div>
      </div>
      <div>
        <div class="text-xs text-gray-500">Unit Kompetensi</div>
        <div class="text-gray-900 font-medium">{{ $kompetensi->unit_kompetensi }}</div>
      </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-4">
      <div>
        <div class="text-xs text-gray-500">Skema</div>
        <div class="text-gray-900 font-medium">{{ $kompetensi->skema?->kode_skema }} - {{ $kompetensi->skema?->nama_skema }}</div>
        @if($kompetensi->skema)
          <a href="{{ route('admin.skema.show', $kompetensi->skema) }}" class="inline-flex mt-2 text-sm text-teal-700 hover:text-teal-800">Lihat Skema</a>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
