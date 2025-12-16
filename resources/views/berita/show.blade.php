@extends('layouts.app')

@section('no-navbar')@endsection
@section('title', 'Berita | LSP SMKN 1 Purwosari')

@section('content')
    <div class="pt-12">
      <!-- Gambar -->
      <div class="px-4 md:px-[48px]">
        <a href="{{ route('berita.index') }}"  class="inline-flex items-center gap-4 px-3 py-3 bg-[#F6F7F4] rounded-[16px] mb-[30px]">
            <img src="{{ asset('image/icon/arrow-left.svg') }}" class="w-6 h-6" />
            <span class="text-[14px] font-medium text-[#022512]">Kembali</span>
        </a>

        <img src="{{ $berita->gambar ? asset('storage/'.$berita->gambar) : asset('img/berita-detail.jpg') }}" alt="{{ $berita->judul }}" class="w-full max-h-[600px] rounded-[12px] mb-[40px] object-cover" />
      </div>

      <!-- Konten -->
      <div class="w-full">
        <div class="px-4 md:px-[48px] mx-auto max-w-[898px] mb-[50px] md:mb-[100px]">
          <!-- Judul -->
          <h1 class="text-[28px] md:text-[36px] lg:text-[48px] leading-[120%] font-bold mb-[24px]">{{ $berita->judul }}</h1>

          <!-- Admin + Tanggal -->
          <div class="flex items-center gap-3 text-[14px] md:text-[16px] lg:text-[18px] font-medium leading-[150%] text-[#272727] mb-[24px]">
            <span>{{ $berita->sumber }}</span>
            <div class="rounded-full bg-[#272727] h-1 w-1"></div>
              <span>{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</span>
          </div>

          <!-- Paragraf Berita -->
          <div class="text-[16px] md:text-[18px] lg:text-[20px] leading-[150%] text-black space-y-[24px] mb-[24px]">
            {!! $berita->isi !!}
          </div>

          <!-- Bagikan -->
          <div class="mt-[24px] flex justify-end">
            <div>
              <p class="text-[14px] font-medium leading-[150%] mb-[8px] text-right">Bagikan ini:</p>

              <div class="flex items-center gap-[8px] justify-end">
                <button class="w-[32px] h-[32px] flex items-center justify-center rounded-full border border-[#272727] text-white">
                  <img src="{{asset('image/icon/facebook-black.svg')}}" class="w-[13.71px] h-[13.71px]" />
                </button>

                <button class="w-[32px] h-[32px] flex items-center justify-center rounded-full border border-[#272727] text-white">
                  <img src="{{asset('image/icon/instagram-black.svg')}}" class="w-[13.71px] h-[13.71px]" />
                </button>

                <button class="w-[32px] h-[32px] flex items-center justify-center rounded-full border border-[#272727] text-white">
                  <img src="{{asset('image/icon/whatsapp-black.svg')}}" class="w-[13.71px] h-[13.71px]" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
