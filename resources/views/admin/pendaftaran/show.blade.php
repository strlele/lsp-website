@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto lg:px-[40px] md:px-[24px] px-[16px] py-8">
  <div class="mb-6">
    <h1 class="text-2xl font-semibold">Detail Pendaftar #{{ $pendaftaran->id }}</h1>
    <p class="text-sm text-gray-600">Informasi lengkap pendaftar dan hasil asesmen mandiri.</p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="rounded-xl border border-gray-200 bg-white p-6">
      <h2 class="text-lg font-semibold mb-4">Profil Peserta</h2>
      <div class="space-y-2 text-sm">
        <div><span class="text-gray-500">Nama:</span> {{ $pendaftaran->nama_lengkap }}</div>
        <div><span class="text-gray-500">NIS:</span> {{ $pendaftaran->nis ?? '-' }}</div>
        <div><span class="text-gray-500">NIK:</span> {{ $pendaftaran->nik ?? '-' }}</div>
        <div><span class="text-gray-500">JK:</span> {{ $pendaftaran->jenis_kelamin ?? '-' }}</div>
        <div><span class="text-gray-500">TTL:</span> {{ $pendaftaran->tempat_lahir ?? '-' }}, {{ $pendaftaran->tanggal_lahir ?? '-' }}</div>
        <div><span class="text-gray-500">Alamat:</span> {{ $pendaftaran->alamat ?? '-' }}</div>
        <div><span class="text-gray-500">No Telp:</span> {{ $pendaftaran->no_telp ?? '-' }}</div>
        <div><span class="text-gray-500">Email:</span> {{ $pendaftaran->email ?? '-' }}</div>
      </div>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-6">
      <h2 class="text-lg font-semibold mb-4">Skema</h2>
      <div class="text-sm">
        <div><span class="text-gray-500">Skema:</span> {{ optional($pendaftaran->skema)->nama_skema ?? '-' }}</div>
        <div><span class="text-gray-500">Kategori:</span> {{ optional(optional($pendaftaran->skema)->kategori)->nama_kategori ?? '-' }}</div>
      </div>
      <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-3">
        @if($pendaftaran->dok_ktp_kartu_pelajar_path)
          <a href="{{ Storage::url($pendaftaran->dok_ktp_kartu_pelajar_path) }}" target="_blank" class="text-blue-600 text-sm">KTP/Kartu Pelajar</a>
        @endif
        @if($pendaftaran->dok_rapor_path)
          <a href="{{ Storage::url($pendaftaran->dok_rapor_path) }}" target="_blank" class="text-blue-600 text-sm">Rapor</a>
        @endif
        @if($pendaftaran->dok_kartu_keluarga_path)
          <a href="{{ Storage::url($pendaftaran->dok_kartu_keluarga_path) }}" target="_blank" class="text-blue-600 text-sm">Kartu Keluarga</a>
        @endif
      </div>
    </div>
  </div>

  <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white">
    <div class="px-6 py-4 border-b">
      <h2 class="text-lg font-semibold">Asesmen Mandiri</h2>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">No</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Kode Unit</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Judul Unit</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">K/BK</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @foreach($pendaftaran->asesmens as $i => $a)
          <tr>
            <td class="px-4 py-3 text-sm text-gray-700">{{ $i+1 }}</td>
            <td class="px-4 py-3 font-mono text-sm text-gray-700">{{ optional($a->kompetensi)->kode_unit }}</td>
            <td class="px-4 py-3 text-sm text-gray-900">{{ optional($a->kompetensi)->unit_kompetensi }}</td>
            <td class="px-4 py-3 text-sm">{{ $a->is_kompeten === null ? '-' : ($a->is_kompeten ? 'K' : 'BK') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
