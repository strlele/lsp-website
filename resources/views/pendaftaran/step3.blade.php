@extends('layouts.vers2')

@section('no-navbar')@endsection
@section('no-footer')@endsection

@section('content')

<body class="bg-[#FFFF]">

  <!-- HEADER TITLE + STEPPER -->
  <div class="mx-[16px] md:mx-[45px] lg:mx-[80px] md:mt-[78px] md:mb-[88px]">

    <a href="{{ url()->previous() }}"
      class="inline-flex items-center gap-4 px-3 py-3 bg-[#F6F7F4] rounded-[16px] mb-[40px]">
      <img src="{{ asset('image/icon/arrow-left.svg') }}" class="w-6 h-6" />
      <span class="text-[14px] font-medium text-[#022512]">Kembali</span>
    </a>

    <p class="text-center text-base text-[#C0C0C0] leading-[40px] mb-2">
      Lembaga Sertifikasi Profesi
    </p>

    <h1 class="text-[28px] leading-[40px] font-bold text-center mb-[44px] md:mb-[64px]">
      Formulir Resmi Calon Peserta Uji Kompetensi
    </h1>

    <!-- STEPPER -->
    <div class="flex flex-col md:flex-row justify-center items-start md:items-center gap-[24px]">

      <!-- STEP 1 (clickable back) -->
      <a href="{{ route('pendaftaran.step1') }}" class="flex items-center gap-[16px]">
        <div class="w-[40px] h-[40px] rounded-full bg-[#FFF8E0] flex items-center justify-center text-[#FFC300] text-base font-bold">1</div>
        <p class="text-base font-semibold">Profil Peserta</p>
      </a>

      <div class="hidden md:block w-[150px] h-[1px] bg-[#CCCCCC]"></div>

      <!-- STEP 2 (clickable back) -->
      <a href="{{ route('pendaftaran.step2') }}" class="flex items-center gap-[16px]">
        <div class="w-[40px] h-[40px] rounded-full bg-[#FFF8E0] flex items-center justify-center text-[#FFC300] text-base font-bold">2</div>
        <p class="text-base font-semibold">Dokumen Portofolio</p>
      </a>

      <div class="hidden md:block w-[150px] h-[1px] bg-[#CCCCCC]"></div>

      <!-- STEP 3 (active) -->
      <div class="flex items-center gap-[16px] mb-[44px] sm:mb-0">
        <div class="w-[40px] h-[40px] rounded-full bg-[#FFC300] flex items-center justify-center text-white text-base font-bold">3</div>
        <p class="text-base font-semibold">Asesmen Mandiri</p>
      </div>
    </div>
  </div>

  <!-- CARD WRAPPER -->
  <div
    class="mx-[16px] md:mx-[45px] lg:mx-[80px] bg-white rounded-[20px] border border-[#C0C0C0] shadow-sm px-[20px] md:px-[30px] lg:px-[40px] py-[28px] md:py-[38px] lg:py-[48px]">

    <h2 class="text-[26px] md:text-[28px] font-bold mb-4">Asesmen Mandiri</h2>
    <p class="text-base mb-[43px] md:mb-[53px] text-black">
      Silakan isi penilaian kompetensi sesuai kemampuan Anda.
    </p>

    <form action="{{ route('pendaftaran.submit') }}" method="POST">
      @csrf

      <div class="overflow-hidden rounded-xl border border-[#C0C0C0]">
        <table class="min-w-full">
          <thead class="bg-[#F5F6FA]">
            <tr>
              <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">No</th>
              <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Kode Unit</th>
              <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Judul Unit Kompetensi</th>
              <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600">K</th>
              <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600">BK</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200">
            @foreach($kompetensis as $i => $k)
            <tr>
              <td class="px-4 py-3 text-sm text-gray-700">{{ $i+1 }}</td>
              <td class="px-4 py-3 font-mono text-sm text-gray-700">{{ $k->kode_unit }}</td>
              <td class="px-4 py-3 text-sm text-gray-900">{{ $k->unit_kompetensi }}</td>

              <td class="px-4 py-3 text-center">
                <input type="radio"
                       name="asesmen[{{ $k->id }}]"
                       value="K"
                       class="h-4 w-4 text-black focus:ring-black">
              </td>

              <td class="px-4 py-3 text-center">
                <input type="radio"
                       name="asesmen[{{ $k->id }}]"
                       value="BK"
                       class="h-4 w-4 text-black focus:ring-black">
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="text-sm text-gray-600 mt-3">
        Keterangan: <b>K</b> = Kompeten, <b>BK</b> = Belum Kompeten
      </div>

      <div class="flex justify-end gap-4 mt-10">
        <a href="{{ route('pendaftaran.step2') }}" class="px-6 py-2 border rounded-lg">Kembali</a>
        <button class="px-6 py-2 bg-black text-white rounded-lg">Kirim</button>
      </div>
    </form>
  </div>

  <br><br>
@endsection
