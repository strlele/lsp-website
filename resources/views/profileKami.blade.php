@extends('layouts.vers2')
@section('content')
<div class="w-full">
      <!-- Hero Image + Title -->
      <x-hero-title
        :src="asset('image/skema-hero.jpg')"
        alt="Profile Image"
        :title="'Profile Singkat<br />Kami'"
      />

      <!-- Content Section -->
      <div class="px-[16px] md:px-[48px]">
        <!-- Tentang Kami -->
        <div class="grid md:grid-cols-4 gap-[24px] md:gap-10 pt-[24px] md:pt-[40px] pb-[40px]">
          <h2 class="text-xl md:text-2xl font-medium leading-[120%] md:col-span-1">Tentang Kami</h2>
          <p class="text-base md:text-[22px] leading-[32px] md:leading-[40px] md:col-span-3">
            Lembaga Sertifikasi Profesi SMK Negeri 1 Purwosari merupakan lembaga pendukung BNSP yang bertugas melaksanakan sertifikasi kompetensi. LSP SMK Negeri 1 Purwosari berwenang mengadakan uji kompetensi, menerbitkan sertifikat, serta
            melakukan verifikasi tempat uji.<br />
            Pelaksanaan seluruh tugas mengacu pada pedoman BNSP untuk memastikan proses sertifikasi berjalan konsisten, profesional, dan diakui secara nasional demi peningkatan kualitas serta perlindungan tenaga kerja.
          </p>
        </div>

        <!-- Visi Kami -->
        <div class="grid md:grid-cols-4 gap-[24px] md:gap-10 pt-[24px] md:pt-[20px] pb-[40px]">
          <h2 class="text-xl md:text-2xl font-medium leading-[120%] md:col-span-1">Visi Kami</h2>
          <p class="text-base md:text-[22px] leading-[32px] md:leading-[40px] md:col-span-3">
            Menjadi Lembaga Sertifikasi Profesi yang terpercaya, profesional, dan berstandar nasional dalam menghasilkan tenaga kerja kompeten yang siap bersaing di dunia usaha dan dunia industri.
          </p>
        </div>

        <!-- Misi Kami -->
        <div class="grid md:grid-cols-3 gap-[30px] md:gap-10 md:py-[40px]">
          <!-- Kolom 1: Judul -->
          <div>
            <h2 class="text-xl md:text-2xl font-medium leading-[120%]">Misi Kami</h2>
          </div>

          <!-- Kolom 2–3: Isi Misi 1 & 2 -->
          <div class="md:col-span-2 grid sm:grid-cols-2 gap-[30px] md:gap-8">
            <div>
              <h3 class="font-medium text-base md:text-lg mb-6 md:mb-8">1</h3>
              <p class="text-sm md:text-base text-[#636363] md:pb-[40px]">Menyelenggarakan sertifikasi kompetensi secara objektif, independen, dan sesuai standar Badan Nasional Sertifikasi Profesi (BNSP).</p>
            </div>

            <div>
              <h3 class="font-medium text-base md:text-lg mb-6 md:mb-8">2</h3>
              <p class="text-sm md:text-base text-[#636363] md:pb-[40px]">Menyelenggarakan sertifikasi kompetensi secara objektif, independen, dan sesuai standar Badan Nasional Sertifikasi Profesi (BNSP).</p>
            </div>
          </div>

          <!-- Isi Misi 3, 4, 5 (Tetap dalam 3 kolom) -->
          <div class="md:col-span-3 grid md:grid-cols-3 gap-[30px] md:gap-10">
            <div>
              <h3 class="font-semibold text-base md:text-lg mb-6 md:mb-8">3</h3>
              <p class="text-sm md:text-base text-[#636363] md:pb-[40px]">Menyelenggarakan sertifikasi kompetensi secara objektif, independen, dan sesuai standar Badan Nasional Sertifikasi Profesi (BNSP).</p>
            </div>

            <div>
              <h3 class="font-semibold text-base md:text-lg mb-6 md:mb-8">4</h3>
              <p class="text-sm md:text-base text-[#636363] md:pb-[40px]">Menyelenggarakan sertifikasi kompetensi secara objektif, independen, dan sesuai standar Badan Nasional Sertifikasi Profesi (BNSP).</p>
            </div>

            <div>
              <h3 class="font-semibold text-base md:text-lg mb-6 md:mb-8">5</h3>
              <p class="text-sm md:text-base text-[#636363] md:pb-[40px]">Menyelenggarakan sertifikasi kompetensi secara objektif, independen, dan sesuai standar Badan Nasional Sertifikasi Profesi (BNSP).</p>
            </div>
          </div>
        </div>

        <!-- Struktur Organisasi -->
        <div class="my-[40px]">
          <h2 class="text-xl md:text-2xl text-neutral-900 font-bold pt-[40px] md:pt-[20px] lg:pt-[40px] pb-[40px] md:pb-[40px] lg:pb-[60px]">Struktur Organisasi</h2>

          <div class="w-full flex justify-center">
            <img src="{{ asset('image/struktur-organisasi.webp')}}" alt="Struktur Organisasi" class="w-full max-w-[1400px] object-contain" />
          </div>
        </div>
      </div>
    </div>
@endsection
