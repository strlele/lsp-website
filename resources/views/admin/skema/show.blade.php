@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto lg:px-[40px] md:px-[24px] px-[16px] py-8">
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold">Detail Skema</h1>
      <p class="text-sm text-gray-600">Informasi lengkap skema dan daftar unit kompetensi.</p>
    </div>
    <div class="flex items-center gap-2">
      <a href="{{ route('admin.skema.edit', $skema) }}" class="inline-flex px-4 py-2 rounded-lg bg-amber-500 text-white hover:bg-amber-600">Edit</a>
      <a href="{{ route('admin.skema.index') }}" class="inline-flex px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50">Kembali</a>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
      <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-3">
        <div>
          <div class="text-xs text-gray-500">Kode Skema</div>
          <div class="font-mono text-gray-900">{{ $skema->kode_skema }}</div>
        </div>
        <div>
          <div class="text-xs text-gray-500">Nama Skema</div>
          <div class="font-medium text-gray-900">{{ $skema->nama_skema }}</div>
        </div>
        <div>
          <div class="text-xs text-gray-500">Kategori</div>
          <div class="text-gray-900">{{ optional($skema->kategori)->nama_kategori ?? '-' }}</div>
        </div>
        <div>
          <div class="text-xs text-gray-500">Jumlah Kompetensi</div>
          <div class="text-gray-900">{{ $skema->kompetensis->count() }}</div>
        </div>
      </div>
    </div>

    <div class="lg:col-span-2">
      <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b bg-gray-50 flex items-center justify-between">
          <h2 class="text-lg font-semibold text-gray-900">Unit Kompetensi</h2>
        </div>
        <div class="divide-y">
          @forelse($skema->kompetensis as $k)
            <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
              <div class="md:col-span-3">
                <span class="inline-flex items-center text-xs md:text-sm font-semibold text-teal-700 bg-teal-50 border border-teal-200 rounded px-2.5 py-1 font-mono">{{ $k->kode_unit }}</span>
              </div>
              <div class="md:col-span-9">
                <div class="text-gray-900 font-medium leading-relaxed md:text-base text-sm">{{ $k->unit_kompetensi }}</div>
              </div>
            </div>
          @empty
            <div class="px-6 py-10 text-center text-gray-500">Belum ada unit kompetensi.</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
