@extends('layouts.vers2')
@section('content')
    <!-- Header -->
     <x-hero-title :src="asset('image/skema-hero.jpg')" alt="Profile Image" :title="'Profile Singkat<br />Kami'" />

    <div class="bg-white rounded-2xl sticky mt-6 mx-4 md:mx-12 z-10">
        <div class="flex flex-col justify-center w-full px-4 sm:px-6 lg:px-8 py-4">
            <a href="{{ route('skema.index') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-[#F6F7F4] rounded-[12px] mb-3 w-max text-[#022512]">
                <img src="{{ asset('image/icon/arrow-left.svg') }}" class="w-5 h-5" alt="back" />
                <span class="text-[14px] font-medium">Kembali</span>
            </a>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">{{ $skema->nama_skema }}</h1>
                <div class="flex items-center gap-3">

                    <a href="{{ route('pendaftaran.step1', ['skema' => $skema->id]) }}" class="whitespace-nowrap bg-black text-white px-4 md:px-6 py-2 rounded-lg hover:bg-gray-800 transition-colors text-sm md:text-base">
                        Daftar Uji Kompetensi
                    </a>
                </div>
            </div>

            <!-- Table Container -->
            <main class="w-full mx-auto py-4">
                <div class="bg-white rounded-lg overflow-hidden">
                    <!-- Table Header -->
                    <div class="grid grid-cols-2 lg:grid-cols-[300px_1fr] bg-white border-b border-[#D6D6D6]">
                        <div class="px-4 md:px-6 py-4 text-left text-sm font-semibold text-black">
                            Kode Unit
                        </div>
                        <div class="px-4 md:px-6 py-4 text-left text-sm font-semibold text-black">
                            Unit Kompetensi
                        </div>
                    </div>

                    <!-- Table Body -->
                    <div class="divide-y divide-[#D6D6D6] divide-[0.5px]">
                        @forelse($skema->kompetensis as $k)
                            <div class="grid grid-cols-2 lg:grid-cols-[300px_1fr] hover:bg-gray-50 transition-colors">
                                <div class="px-4 md:px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $k->kode_unit }}</div>
                                </div>
                                <div class="px-4 md:px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $k->unit_kompetensi }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="px-4 md:px-6 py-8 text-sm text-gray-500">Belum ada unit kompetensi pada skema ini.</div>
                        @endforelse
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

