@extends('layouts.app')

@section('content')
    <!-- Hero Section - Fixed Position -->
    <div class="fixed top-0 left-0 right-0 min-h-screen w-full overflow-hidden">
        @if(isset($slides) && $slides->count())
            <!-- Slideshow Backgrounds -->
            <div id="slidesWrapper" class="absolute inset-0">
                @foreach($slides as $idx => $s)
                    <div class="slide absolute inset-0 transition-opacity duration-700 ease-in-out {{ $idx === 0 ? 'opacity-100' : 'opacity-0' }}"
                        data-headline="{{ 'LSP SMKN 1 PURWOSARI' }}">
                        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                            style="background-image: url('{{ $s->files ? asset('storage/' . $s->files) : asset('image/skema-hero.jpg') }}')">
                            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-[url('{{ asset('image/skema-hero.jpg') }}')]">
                <div class="absolute inset-0 bg-black/20"></div>
                <div
                    class="pointer-events-none absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/60 via-black/20 to-transparent">
                </div>
            </div>
        @endif

        <!-- Hero Content -->
        <div class="absolute inset-0 flex items-center justify-center px-6 md:px-12 z-10">
            <div class="w-full max-w-7xl">
                <!-- Header container -->
                <div class="pt-12">
                    <div class="flex flex-col">
                        <!-- Badge -->
                        <div
                            class="inline-block bg-white bg-opacity-20 text-white text-sm px-4 py-2 rounded-full border border-white border-opacity-40 mb-2 backdrop-blur-sm w-fit">
                            <div class="flex items-center">
                                <!-- <div class="w-[6px] h-[6px] bg-white rounded-full mr-2"></div> -->
                                Terakreditasi BNSP
                            </div>
                        </div>

                        <!-- Headline row: H1 (left) and pager (right) -->
                        <div class="flex items-end justify-between gap-6">
                            <h1 id="slideHeadline"
                                class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight max-w-lg">
                                LSP SMKN 1 PURWOSARI</h1>
                            @if(isset($slides) && $slides->count())
                                <div id="pager"
                                    class="hidden md:block text-white text-opacity-70 text-xl tracking-wider font-bold z-20">
                                    01 / {{ sprintf('%02d', min(3, $slides->count())) }}
                                </div>
                            @endif
                        </div>

                        <p class="text-white text-opacity-90 text-lg mt-2 max-w-sm">Menyelenggarakan sertifikasi kompetensi
                            sesuai standar nasional.</p>
                    </div>
                </div>

                <!-- News Card - Below Description -->
                <div class="mt-12 grid grid-cols-[auto_1fr_auto] items-end">
                    <!-- Sosial Media -->
                    <div class="hidden md:flex items-center gap-3 text-white">
                        <a href="#" aria-label="linkedin"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 border border-white/40 hover:bg-white/25 transition">
                            <img src="{{ asset('image/icon/linkedin.svg') }}" alt="linkedin" class="w-5 h-5">
                        </a>
                        <a href="#" aria-label="facebook"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 border border-white/40 hover:bg-white/25 transition">
                            <img src="{{ asset('image/icon/facebook.svg') }}" alt="facebook" class="w-5 h-5">
                        </a>
                        <a href="#" aria-label="twitter-x"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 border border-white/40 hover:bg-white/25 transition">
                            <img src="{{ asset('image/icon/twitter-x.svg') }}" alt="twitter-x" class="w-4 h-4">
                        </a>
                        <a href="#" aria-label="Instagram"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 border border-white/40 hover:bg-white/25 transition">
                            <img src="{{ asset('image/icon/instagram.svg') }}" alt="Instagram" class="w-5 h-5">
                        </a>
                    </div>

                    <div></div>

                    <!-- News Card -->
                    <div class="relative w-full md:max-w-[340px] lg:max-w-[450px]">
                        <div
                            class="relative bg-white/20 backdrop-blur-xl border border-white/40 ring-1 ring-white/10 rounded-lg shadow-xl py-4 pl-4 pr-10 flex items-stretch gap-4 md:gap-6 text-white hover:bg-white/25 transition duration-300">
                            @if(isset($latestBerita) && $latestBerita)
                                                @if($latestBerita->gambar)
                                                    <img src="{{ asset('storage/' . $latestBerita->gambar) }}" alt="{{ $latestBerita->judul }}"
                                                        class="w-28 h-28 lg:w-32 lg:h-32 object-cover rounded-lg shrink-0">
                                                @endif
                                                <div class="flex-1 flex flex-col justify-between min-w-0 py-1">
                                                    <div class="space-y-2">
                                                        <!-- Judul -->
                                                        <h3 class="font-semibold text-base leading-[26px] line-clamp-2">
                                                            {{ Str::length($latestBerita->judul) > 200
                                ? Str::limit($latestBerita->judul, 200, '...')
                                : $latestBerita->judul }}
                                                        </h3>
                                                        <!-- Tanggal - Penulis -->
                                                        <div class="flex flex-wrap items-center gap-2">
                                                            <div class="flex items-center gap-2 text-xs text-white">
                                                                {{ \Carbon\Carbon::parse($latestBerita->tanggal)->format('d M Y') }}
                                                                <div class="w-[4px] h-[4px] bg-white rounded-full"></div>
                                                                {{ $latestBerita->sumber }}
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Tombol Detail -->
                                                    <div class="flex items-center gap-2">
                                                        <a href="#"
                                                            class="inline-flex items-center gap-2 text-xs text-white font-medium hover:text-white transition">
                                                            Lihat Detail
                                                            <img src="{{ asset('image/icon/arrow-sm.svg') }}" alt="arrow-sm">
                                                        </a>
                                                    </div>

                                                </div>
                            @else
                                <div class="text-white/70 text-sm">Belum ada berita dipublikasikan.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($slides) && $slides->count())
            <!-- Pagination - Bottom Left (hidden, top pager is active) -->
            <div id="pagerBottomHidden"
                class="hidden absolute bottom-6 left-6 lg:left-[80px] text-white text-opacity-70 text-sm tracking-wider font-medium z-20">
                01 / {{ sprintf('%02d', min(3, $slides->count())) }}
            </div>
        @else
            <div class="absolute bottom-6 left-6 text-white text-opacity-70 text-sm tracking-wider font-medium z-20"></div>
        @endif
    </div>

    <!-- Spacer untuk memberikan ruang scroll -->
    <div class="h-screen"></div>

    <!-- About Section -->
    <div
        class="relative bg-white text-gray-900 py-[65px] lg:py-[80px] md:px-12 px-[16px] overflow-hidden rounded-t-[20px] z-50">
        <div class="max-w-7xl mx-auto   ">
            <!-- Heading Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-6">
                <div class="md:col-span-1">
                    <h1 class="text-2xl font-medium tracking-wide text-[#9CA3AF]">Tentang Kami</h1>
                </div>
                <div class="md:col-span-2 space-y-24">
                    <h2 class="text-2xl md:text-[28px] lg:text-[32px] font-medium leading-snug">
                        Dengan pengalaman lebih dari 15 tahun, LSP SMK Negeri 1 Purwosari telah menjadi
                        <span class="text-[#9CA3AF]">lembaga sertifikasi
                            yang dipercaya oleh berbagai mitra</span>
                        sekolah dan dunia kerja, berperan aktif dalam memastikan
                        <span class="text-[#9CA3AF]">lulusan memiliki kompetensi yang teruji serta memenuhi standar
                            kebutuhan industri.</span>
                    </h2>
                    <!-- Data Statistik (DESKTOP SAJA) -->
                    <div class="hidden lg:grid grid-cols-2 sm:grid-cols-4 gap-y-8 gap-x-6 md:gap-x-10 md:gap-x-16">
                        <div class="text-start">
                            <h3 class="text-5xl leading-[58px] tracking-[-0.4px] font-semibold mb-2"><span class="countup"
                                    data-target="27" data-suffix="+">0</span></h3>
                            <p class="count-subject text-base font-medium text-[#9CA3AF]">Skema<br>Sertifikasi</p>
                        </div>
                        <div class="text-start">
                            <h3 class="text-5xl leading-[58px] tracking-[-0.4px] font-semibold mb-2"><span class="countup"
                                    data-target="150" data-suffix="+">0</span></h3>
                            <p class="count-subject text-base font-medium text-[#9CA3AF]">Asesor<br>Kompetensi</p>
                        </div>
                        <div class="text-start">
                            <h3 class="text-5xl leading-[58px] tracking-[-0.4px] font-semibold mb-2"><span class="countup"
                                    data-target="500" data-suffix="+">0</span></h3>
                            <p class="count-subject text-base font-medium text-[#9CA3AF]">Pemegang<br>Sertifikat</p>
                        </div>
                        <div class="text-start">
                            <h3 class="text-5xl leading-[58px] tracking-[-0.4px] font-semibold mb-2"><span class="countup"
                                    data-target="13">0</span></h3>
                            <p class="count-subject text-base font-medium text-[#9CA3AF]">Tempat Uji Kompetensi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DATA STATISTIK (TABLET & MOBILE SAJA) -->
            <div class="w-full overflow-hidden lg:hidden">
                <div class="divide-y divide-gray-200">
                    <div class="flex justify-between items-center py-6">
                        <h2
                            class="text-[40px] leading-[48px] tracking-[-0.3px] md:text-5xl md:leading-[58px] md:tracking-[-0.4px] font-semibold text-black">
                            <span class="countup" data-target="27" data-suffix="+">0</span>
                        </h2>
                        <p class="count-subject text-[20px] md:text-2xl leading-[24px] font-medium text-[#9CA3AF]">Skema
                            Sertifikasi</p>
                    </div>
                    <div class="flex justify-between items-center py-6">
                        <h3
                            class="text-[40px] leading-[48px] tracking-[-0.3px] md:text-5xl md:leading-[58px] md:tracking-[-0.4px] font-semibold text-black">
                            <span class="countup" data-target="150" data-suffix="+">0</span>
                        </h3>
                        <p class="count-subject text-[20px] md:text-2xl leading-[24px] font-medium text-[#9CA3AF]">Asesor
                            Kompetensi</p>
                    </div>
                    <div class="flex justify-between items-center py-6">
                        <h3
                            class="text-[40px] leading-[48px] tracking-[-0.3px] md:text-5xl md:leading-[58px] md:tracking-[-0.4px] font-semibold text-black">
                            <span class="countup" data-target="500" data-suffix="+">0</span>
                        </h3>
                        <p class="count-subject text-[20px] md:text-2xl leading-[24px] font-medium text-[#9CA3AF]">Pemegang
                            Sertifikat</p>
                    </div>
                    <div class="flex justify-between items-center py-6">
                        <h3
                            class="text-[40px] leading-[48px] tracking-[-0.3px] md:text-5xl md:leading-[58px] md:tracking-[-0.4px] font-semibold text-black">
                            <span class="countup" data-target="13" data-suffix="+">0</span>
                        </h3>
                        <p class="count-subject text-[20px] md:text-2xl leading-[24px] font-medium text-[#9CA3AF]">Tempat
                            Uji
                            Kompetensi
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Section Mitra -->
    <section class="bg-white py-10 md:py-12 md:px-12 px-[16px] relative overflow-hidden z-50">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-6 items-center gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-xl md:text-2xl font-medium leading-tight text-[#9CA3AF]">Mitra<br />Sekolah</h3>
                </div>

                <div class="md:col-span-5">
                    <div class="logo-marquee relative">
                        <div class="logo-marquee__mask-left"></div>
                        <div class="logo-marquee__mask-right"></div>

                        <div class="logo-marquee__track" aria-hidden="true">
                            <div class="logo-marquee__row">
                                <img src="{{ asset('image/logo/telkom.svg') }}" class="logo-marquee__item"
                                    alt="Telkom Schools">
                                <img src="{{ asset('image/logo/bsi.svg') }}" class="logo-marquee__item" alt="BSI">
                                <img src="{{ asset('image/logo/google.svg') }}" class="logo-marquee__item" alt="Google">
                                <img src="{{ asset('image/logo/microsoft.svg') }}" class="logo-marquee__item"
                                    alt="Microsoft">
                                <img src="{{ asset('image/logo/sketsu.svg') }}" class="logo-marquee__item"
                                    alt="SMKN 1 Sukorejo">
                                <img src="{{ asset('image/logo/bsj.svg') }}" class="logo-marquee__item" alt="BSJ">
                                <img src="{{ asset('image/logo/astra.svg') }}" class="logo-marquee__item" alt="Astra">
                            </div>
                            <div class="logo-marquee__row" aria-hidden="true">
                                <img src="{{ asset('image/logo/telkom.svg') }}" class="logo-marquee__item"
                                    alt="Telkom Schools">
                                <img src="{{ asset('image/logo/bsi.svg') }}" class="logo-marquee__item" alt="BSI">
                                <img src="{{ asset('image/logo/google.svg') }}" class="logo-marquee__item" alt="Google">
                                <img src="{{ asset('image/logo/microsoft.svg') }}" class="logo-marquee__item"
                                    alt="Microsoft">
                                <img src="{{ asset('image/logo/sketsu.svg') }}" class="logo-marquee__item"
                                    alt="SMKN 1 Sukorejo">
                                <img src="{{ asset('image/logo/bsj.svg') }}" class="logo-marquee__item" alt="BSJ">
                                <img src="{{ asset('image/logo/astra.svg') }}" class="logo-marquee__item" alt="Astra">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Section -->
    <x-berita-section class=" z-50" :featured="$latestBerita" :items="$beritasList" />

    <!-- Team Section  -->
    <section class="bg-white py-6 md:py-16 relative overflow-hidden z-50" id="team-section">
        <!-- Bagian Atas Disembunyikan di tablet & mobile, tampil hanya di desktop -->

        <div class="px-[16px] md:px-[48px]">
            <!-- Header Section -->
            <div class="md:hidden lg:flex hidden flex-col md:flex-row md:items-end md:justify-between lg:flex-col lg:items-center lg:justify-center lg:text-center lg:max-w-3xl lg:mx-auto mb-8 md:mb-12 gap-4">
                <div>
                    <p class="text-gray-400 text-lg md:text-xl mb-2 lg:text-center text-start">Tim LSP</p>
                    <h2 class="text-[26px] md:text-[44px] font-semibold leading-tight">
                        Meet People Behind
                    </h2>
                    <p class="text-gray-500 text-base leading-relaxed mt-3">Kenali tim profesional di balik LSP SMKN 1
                    Purwosari. Kami bekerja bersama untuk menjaga mutu dan kredibilitas sertifikasi.</p>
                </div>
                <div class="lg:mt-2">
                    <button
                    class="rounded-lg flex items-center justify-center gap-2 px-6 py-[13px] w-full bg-[#FFF8E0] text-[#FFC300] font-medium hover:bg-[#FFF9D9] transition">
                    <span class="leading-[150%] text-sm"> Get to know more </span>
                    <img src="{{ asset('image/icon/arrow-right-yellow.svg') }}" alt="next-icons" class="object-contain w-4" />
                </button>
                </div>
            </div>

        <!-- TABLET -->
        <div class="hidden md:flex lg:hidden flex-row items-start mb-12 relative z-20 gap-10 lg:gap-0">
            <!-- Kolom kiri -->
            <div class="flex-1">
                <p class="text-gray-400 text-lg md:text-xl mb-2 lg:text-center text-start">Tim LSP</p>
                    <h2 class="text-[26px] md:text-[44px] font-semibold leading-tight">
                        Meet People Behind
                    </h2>
                <p class="text-gray-500 text-base leading-relaxed mt-3">Kenali tim profesional di balik LSP SMKN 1
                    Purwosari. Kami bekerja bersama untuk menjaga mutu dan kredibilitas sertifikasi.</p>

                <div class="flex flex-col gap-3 mt-8 w-[80%]">
                    <button class="rounded-lg flex items-center justify-center gap-2 px-6 py-[13px] bg-[#FFF8E0] text-[#FFC300] font-medium hover:bg-[#FFF9D9] transition">
                        <span class="leading-[150%] text-sm"> Get to know more </span>
                        <img src="{{ asset('image/icon/arrow-right-yellow.svg') }}" alt="next-icons" class="object-contain w-4" />
                    </button>

                </div>
            </div>

            <!-- Kolom kanan (foto utama) -->
            <div class="flex-1">
                <div class="relative rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ asset('image/team-7.jpg') }}" alt="Raditya Wahyu S."
                        class="w-full h-[480px] object-cover rounded-xl" />
                    <div
                        class="absolute bottom-0 left-0 w-full h-[45%] bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent">
                    </div>
                    <div class="absolute bottom-0 left-0 w-full text-white px-5 pb-6">
                        <h4 class="text-2xl font-semibold mb-1">Raditya Wahyu S.</h4>
                        <p class="text-sm text-gray-200">Ketua LSP</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- MOBILE -->
        <div class="block md:hidden mb-[18px] mt-[24px]">
            <!-- Judul & teks -->
            <div class="text-left space-y-4">
                <p class="text-gray-400 text-lg md:text-xl mb-2 lg:text-center text-start">Tim LSP</p>
                <h2 class="text-[26px] md:text-[44px] font-semibold leading-tight">
                    Meet People Behind
                </h2>
                <p class="text-gray-500 text-base leading-relaxed">Kenali tim profesional di balik LSP SMKN 1 Purwosari.
                    Kami bekerja bersama untuk menjaga mutu dan kredibilitas sertifikasi.</p>
            </div>

            <!-- Tombol -->
            <div class="flex flex-col gap-3 mt-8">
                <button
                    class="rounded-lg flex items-center justify-center gap-2 px-6 py-[13px] w-full bg-[#FFF8E0] text-[#FFC300] font-medium hover:bg-[#FFF9D9] transition">
                    <span class="leading-[150%] text-sm"> Get to know more </span>
                    <img src="{{ asset('image/icon/arrow-right-yellow.svg') }}" alt="next-icons" class="object-contain w-4" />
                </button>
            </div>

            <!-- Foto utama -->
            <div class="relative rounded-xl overflow-hidden shadow-lg mt-10">
                <img src="{{ asset('image/team-7.jpg') }}" alt="Raditya Wahyu S."
                    class="w-full h-[460px] object-cover rounded-xl" />
                <div
                    class="absolute bottom-0 left-0 w-full h-[45%] bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent">
                </div>
                <div class="absolute bottom-0 left-0 w-full text-white px-5 pb-6">
                    <h4 class="text-2xl font-semibold mb-1">Raditya Wahyu S.</h4>
                    <p class="text-sm text-gray-200">Ketua LSP</p>
                </div>
            </div>
        </div>

        <!-- FOTO-FOTO KECIL (DIGABUNG UNTUK MOBILE & TABLET) -->
        <div
            class="lg:hidden grid grid-cols-2 md:grid-cols-3 md:gap-x-[30px] gap-x-[14px] md:gap-y-[14px] gap-y-[16.67px] pb-[6px]">
            <!-- Foto 1 -->
            <div class="relative overflow-hidden rounded-lg">
                <img src="{{ asset('image/team-1.jpg') }}" alt="" class="w-full h-[240px] object-cover rounded-lg" />
                <div
                    class="absolute bottom-0 left-0 w-full h-[50%] bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent">
                </div>
                <div class="absolute bottom-0 left-0 w-full text-white pb-3 px-3">
                    <h4 class="text-sm font-semibold mb-[2px]">Raditya Wahyu S.</h4>
                    <p class="text-xs text-gray-200">Dewan Pengarah</p>
                </div>
            </div>

            <!-- Foto 2 -->
            <div class="relative overflow-hidden rounded-lg">
                <img src="{{ asset('image/team-6.jpg') }}" alt="" class="w-full h-[240px] object-cover rounded-lg" />
                <div
                    class="absolute bottom-0 left-0 w-full h-[50%] bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent">
                </div>
                <div class="absolute bottom-0 left-0 w-full text-white pb-3 px-3">
                    <h4 class="text-sm font-semibold mb-[2px]">Raditya Wahyu S.</h4>
                    <p class="text-xs text-gray-200">Dewan Pengarah</p>
                </div>
            </div>

            <!-- Foto 3 -->
            <div class="relative overflow-hidden rounded-lg">
                <img src="{{ asset('image/team-5.jpg') }}" alt="" class="w-full h-[240px] object-cover rounded-lg" />
                <div
                    class="absolute bottom-0 left-0 w-full h-[50%] bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent">
                </div>
                <div class="absolute bottom-0 left-0 w-full text-white pb-3 px-3">
                    <h4 class="text-sm font-semibold mb-[2px]">Raditya Wahyu S.</h4>
                    <p class="text-xs text-gray-200">Dewan Pengarah</p>
                </div>
            </div>

            <!-- Foto 4 -->
            <div class="relative overflow-hidden rounded-lg">
                <img src="{{ asset('image/team-2.jpg') }}" alt="" class="w-full h-[240px] object-cover rounded-lg" />
                <div
                    class="absolute bottom-0 left-0 w-full h-[50%] bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent">
                </div>
                <div class="absolute bottom-0 left-0 w-full text-white pb-3 px-3">
                    <h4 class="text-sm font-semibold mb-[2px]">Raditya Wahyu S.</h4>
                    <p class="text-xs text-gray-200">Dewan Pengarah</p>
                </div>
            </div>

            <!-- Foto 5 -->
            <div class="relative overflow-hidden rounded-lg">
                <img src="{{ asset('image/team-4.jpg') }}" alt="" class="w-full h-[240px] object-cover rounded-lg" />
                <div
                    class="absolute bottom-0 left-0 w-full h-[50%] bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent">
                </div>
                <div class="absolute bottom-0 left-0 w-full text-white pb-3 px-3">
                    <h4 class="text-sm font-semibold mb-[2px]">Raditya Wahyu S.</h4>
                    <p class="text-xs text-gray-200">Dewan Pengarah</p>
                </div>
            </div>

            <!-- Foto 6 -->
            <div class="relative overflow-hidden rounded-lg">
                <img src="{{ asset('image/team-3.jpg') }}" alt="" class="w-full h-[240px] object-cover rounded-lg" />
                <div
                    class="absolute bottom-0 left-0 w-full h-[50%] bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent">
                </div>
                <div class="absolute bottom-0 left-0 w-full text-white pb-3 px-3">
                    <h4 class="text-sm font-semibold mb-[2px]">Raditya Wahyu S.</h4>
                    <p class="text-xs text-gray-200">Dewan Pengarah</p>
                </div>
            </div>
        </div>

        <!-- TAMPILAN DESKTOP -->
        <div class="hidden lg:flex items-center justify-center relative z-20">
            <!-- Shadow kiri & kanan -->
            <!-- <div id="left-shadow"
                class="absolute left-0 top-0 w-[150px] h-full bg-gradient-to-r from-white via-white/70 to-transparent z-30 transition-opacity duration-300">
            </div>
            <div id="right-shadow"
                class="absolute right-0 top-0 w-[150px] h-full bg-gradient-to-l from-white via-white/70 to-transparent z-30 transition-opacity duration-300">
            </div> -->

            <!-- Kiri paling luar -->
            <div class="relative group flex justify-center items-center overflow-hidden rounded-lg side-left-outer">
                <img src="{{ asset('image/team-3.jpg') }}" alt=""
                    class="w-[200px] h-[230px] rounded-lg object-cover transition duration-300 group-hover:scale-105" />
                <div
                    class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent opacity-0 group-hover:opacity-100 transition">
                </div>
                <div class="absolute bottom-0 left-0 w-full text-white opacity-0 group-hover:opacity-100 transition pb-5">
                    <h4 class="text-base font-semibold mb-2 pl-6">Raditya Wahyu S.</h4>
                    <p class="text-sm pl-6 text-gray-200">Dewan Pengarah</p>
                </div>
            </div>

            <!-- Kiri (2 foto vertikal) -->
            <div class="flex flex-col justify-center items-end gap-4 ml-7">
                <div class="relative group flex justify-center items-center overflow-hidden rounded-lg">
                    <img src="{{ asset('image/team-1.jpg') }}" alt=""
                        class="w-[200px] h-[230px] rounded-lg object-cover transition duration-300 group-hover:scale-105" />
                    <div
                        class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent opacity-0 group-hover:opacity-100 transition">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full text-white opacity-0 group-hover:opacity-100 transition pb-5">
                        <h4 class="text-base font-semibold mb-2 pl-6">Raditya Wahyu S.</h4>
                        <p class="text-sm pl-6 text-gray-200">Dewan Pengarah</p>
                    </div>
                </div>
                <div class="relative group flex justify-center items-center overflow-hidden rounded-lg">
                    <img src="{{ asset('image/team-6.jpg') }}" alt=""
                        class="w-[200px] h-[230px] rounded-lg object-cover transition duration-300 group-hover:scale-105" />
                    <div
                        class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent opacity-0 group-hover:opacity-100 transition">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full text-white opacity-0 group-hover:opacity-100 transition pb-5">
                        <h4 class="text-base font-semibold mb-2 pl-6">Raditya Wahyu S.</h4>
                        <p class="text-sm pl-6 text-gray-200">Dewan Pengarah</p>
                    </div>
                </div>
            </div>

            <!-- Tengah -->
            <div class="relative rounded-xl overflow-hidden mx-[30px] shadow-lg">
                <img src="{{ asset('image/team-7.jpg') }}" alt="Raditya Wahyu S."
                    class="w-[428px] h-[580px] object-cover" />
                <div
                    class="absolute bottom-0 left-0 w-full h-[50%] bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent">
                </div>
                <div class="absolute bottom-0 left-0 w-full text-white">
                    <h4 class="text-lg font-semibold mb-4 pl-6">Raditya Wahyu S.</h4>
                    <p class="text-sm pl-6 text-gray-200 mb-[40px]">Ketua LSP</p>
                </div>
            </div>

            <!-- Kanan -->
            <div class="flex flex-col justify-center items-start gap-4 mr-7">
                <div class="relative group flex justify-center items-center overflow-hidden rounded-lg">
                    <img src="{{ asset('image/team-5.jpg') }}" alt=""
                        class="w-[200px] h-[230px] rounded-lg object-cover transition duration-300 group-hover:scale-105" />
                    <div
                        class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent opacity-0 group-hover:opacity-100 transition">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full text-white opacity-0 group-hover:opacity-100 transition pb-5">
                        <h4 class="text-base font-semibold mb-2 pl-6">Raditya Wahyu S.</h4>
                        <p class="text-sm pl-6 text-gray-200">Dewan Pengarah</p>
                    </div>
                </div>
                <div class="relative group flex justify-center items-center overflow-hidden rounded-lg">
                    <img src="{{ asset('image/team-2.jpg') }}" alt=""
                        class="w-[200px] h-[230px] rounded-lg object-cover transition duration-300 group-hover:scale-105" />
                    <div
                        class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent opacity-0 group-hover:opacity-100 transition">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full text-white opacity-0 group-hover:opacity-100 transition pb-5">
                        <h4 class="text-base font-semibold mb-2 pl-6">Raditya Wahyu S.</h4>
                        <p class="text-sm pl-6 text-gray-200">Dewan Pengarah</p>
                    </div>
                </div>
            </div>

            <!-- Kanan paling luar -->
            <div class="relative group flex justify-center items-center overflow-hidden rounded-lg side-right-outer">
                <img src="{{ asset('image/team-4.jpg') }}" alt=""
                    class="w-[200px] h-[230px] rounded-lg object-cover transition duration-300 group-hover:scale-105" />
                <div
                    class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-blue-950/90 via-blue-950/40 to-transparent opacity-0 group-hover:opacity-100 transition">
                </div>
                <div class="absolute bottom-0 left-0 w-full text-white opacity-0 group-hover:opacity-100 transition pb-5">
                    <h4 class="text-base font-semibold mb-2 pl-6">Raditya Wahyu S.</h4>
                    <p class="text-sm pl-6 text-gray-200">Dewan Pengarah</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="relative bg-white z-50">
      <div class="w-full px-[16px] md:px-[45px] lg:px-[80px] py-16">
        <p class="text-gray-400 text-sm md:text-base mb-6 text-center">FAQ</p>

        <!-- Judul - Centered -->
        <div class="max-w-3xl mx-auto text-center mb-12">
          <h2 class="text-[28px] md:text-[36px] lg:text-[44px] font-bold leading-[120%] text-neutral-900">Jawaban Ringkas untuk Semua Pertanyaan Anda</h2>
        </div>

        <!-- ACCORDION - Centered with max width -->
        <div class="">
          <div class="divide-y divide-gray-200">
            <!-- Item 01 -->
            <div class="py-6">
              <button class="flex items-start justify-between w-full gap-4 faq-btn text-left">
                <div class="flex gap-4 items-start flex-1">
                  <span class="md:w-[40px] lg:w-[120px] text-[#0c0c0c] font-semibold text-base md:text-2xl flex-shrink-0">01</span>
                  <span class="text-base md:text-2xl font-semibold text-[#0c0c0c] flex-1"> Mengapa siswa SMK perlu mengikuti sertifikasi LSP? </span>
                </div>
                <svg class="w-5 h-5 text-gray-400 transition-transform duration-300 flex-shrink-0 mt-1" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                </svg>
              </button>

              <div class="faq-content max-h-0 overflow-hidden transition-all duration-500">
                <div class="mt-3 pl-[calc(2rem)] md:pl-[calc(40px+1rem)] lg:pl-[calc(120px+1rem)]">
                  <p class="opacity-0 transition-opacity duration-300 text-gray-600 text-sm md:text-[20px] font-medium leading-relaxed">
                    Program sertifikasi BNSP melalui LSP SMK/N 1 Purwosari sangat bermanfaat untuk kuliah, khususnya saat mencari asesmen lain. Hal ini membuat saya lebih memahami materi dan langsung terlibat.
                  </p>
                </div>
              </div>
            </div>

            <!-- Item 02 -->
            <div class="py-6">
              <button class="flex items-start justify-between w-full gap-4 faq-btn text-left">
                <div class="flex gap-4 items-start flex-1">
                  <span class="md:w-[40px] lg:w-[120px] text-[#0c0c0c] font-semibold text-base md:text-2xl flex-shrink-0">02</span>
                  <span class="text-base md:text-2xl font-semibold text-[#0c0c0c] flex-1"> Apa saja persyaratan mengikuti asesmen? </span>
                </div>
                <svg class="w-5 h-5 text-gray-400 transition-transform duration-300 flex-shrink-0 mt-1" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                </svg>
              </button>

              <div class="faq-content max-h-0 overflow-hidden transition-all duration-500">
                <div class="mt-3 pl-[calc(2rem)] md:pl-[calc(40px+1rem)] lg:pl-[calc(120px+1rem)]">
                  <p class="opacity-0 transition-opacity duration-300 text-gray-600 text-sm md:text-[20px] text-medium leading-relaxed">
                    Persyaratan umumnya meliputi identitas diri, bukti kompetensi, portofolio, dan administrasi sesuai skema.
                  </p>
                </div>
              </div>
            </div>

            <!-- Item 03 -->
            <div class="py-6">
              <button class="flex items-start justify-between w-full gap-4 faq-btn text-left">
                <div class="flex gap-4 items-start flex-1">
                  <span class="md:w-[40px] lg:w-[120px] text-[#0c0c0c] font-semibold text-base md:text-2xl flex-shrink-0">03</span>
                  <span class="text-base md:text-2xl font-semibold text-[#0c0c0c] flex-1"> Apa perbedaan antara sertifikat training biasa dan sertifikat kompetensi dari LSP? </span>
                </div>
                <svg class="w-5 h-5 text-gray-400 transition-transform duration-300 flex-shrink-0 mt-1" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                </svg>
              </button>

              <div class="faq-content max-h-0 overflow-hidden transition-all duration-500">
                <div class="mt-3 pl-[calc(2rem)] md:pl-[calc(40px+1rem)] lg:pl-[calc(120px+1rem)]">
                  <p class="opacity-0 transition-opacity duration-300 text-gray-600 text-sm md:text-[20px] text-medium leading-relaxed">
                    Sertifikat training hanya menunjukkan mengikuti pelatihan, sedangkan sertifikat kompetensi menandakan seseorang telah dinilai kompeten secara resmi.
                  </p>
                </div>
              </div>
            </div>

            <!-- Item 04 -->
            <div class="py-6">
              <button class="flex items-start justify-between w-full gap-4 faq-btn text-left">
                <div class="flex gap-4 items-start flex-1">
                  <span class="md:w-[40px] lg:w-[120px] text-[#0c0c0c] font-semibold text-base md:text-2xl flex-shrink-0">04</span>
                  <span class="text-base md:text-2xl font-semibold text-[#0c0c0c] flex-1"> Berapa lama sertifikat kompetensi dari LSP berlaku? </span>
                </div>
                <svg class="w-5 h-5 text-gray-400 transition-transform duration-300 flex-shrink-0 mt-1" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                </svg>
              </button>

              <div class="faq-content max-h-0 overflow-hidden transition-all duration-500">
                <div class="mt-3 pl-[calc(2rem)] md:pl-[calc(40px+1rem)] lg:pl-[calc(120px+1rem)]">
                  <p class="opacity-0 transition-opacity duration-300 text-gray-600 text-sm md:text-[20px] text-medium leading-relaxed">Umumnya sertifikat berlaku 2–3 tahun dan bisa diperpanjang jika diperlukan.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimoni Section -->
    <!-- .testimonial-container {
                transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
              }

              .testimonial-card {
                opacity: 0;
                transition: opacity 0.6s ease;
              }

              .testimonial-card.active {
                opacity: 1;
              } -->
    <section class="relative">

        <div class="w-full bg-white shadow-sm pt-[60px] md:pt-[80px] pb-[90px] md:pb-[193px] px-[16px] md:px-[48px]">
            <!-- Header -->
            <div class="text-center mb-16">
                <p class="text-[#9CA3AF] text-[20px] font-medium mb-2 tracking-wider">Testimoni</p>
                <h2 class="text-[30px] md:text-4xl font-bold text-gray-900 leading-tight">Pengalaman Nyata dari Mereka yang
                    Telah <br class="hidden md:block" />Melalui Prosesnya</h2>
            </div>

            <!-- Slider Container -->
            <div class="relative overflow-hidden mb-12">
                <div class="testimonial-container flex" id="testimonialContainer">
                    <!-- Slide 1 -->
                    <div class="testimonial-card active min-w-full grid grid-cols-1 lg:grid-cols-2 gap-6 px-2">
                        <!-- Card 1 -->
                        <div class="flex-1 border border-[#F2F3F6] rounded-xl p-8 transition-all hover:shadow-md">
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-[0c0c0c]">SMKN 1 Tembarak</h3>
                                    <p class="text-sm text-gray-500">Mitra Kerja</p>
                                </div>
                            </div>
                            <p class="text-[0c0c0c] leading-relaxed">
                                Program sertifikasi BNSP melalui LSP SMKN 1 Purwosari sangat bermanfaat untuk kuliah,
                                khususnya saat menjadi asisten lab. Hal ini membuat saya lebih memahami materi dan langsung
                                terlibat.
                            </p>
                        </div>

                        <!-- Card 2 -->
                        <div
                            class="hidden lg:block flex-1 border border-[#F2F3F6] rounded-xl p-8 transition-all hover:shadow-md">
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-[0c0c0c]">Widya D. Safira</h3>
                                    <p class="text-sm text-gray-500">Peserta</p>
                                </div>
                            </div>
                            <p class="text-[0c0c0c] leading-relaxed">
                                Program sertifikasi BNSP melalui LSP SMKN 1 Purwosari sangat bermanfaat untuk kuliah,
                                khususnya saat menjadi asisten lab. Hal ini membuat saya lebih memahami materi dan langsung
                                terlibat.
                            </p>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="testimonial-card active min-w-full grid grid-cols-1 lg:grid-cols-2 gap-6 px-2">
                        <!-- Card 3 -->
                        <div class="flex-1 border border-[#F2F3F6] rounded-xl p-8 transition-all hover:shadow-md">
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-[0c0c0c]">Ahmad Rizki</h3>
                                    <p class="text-sm text-gray-500">Alumni</p>
                                </div>
                            </div>
                            <p class="text-[0c0c0c] leading-relaxed">
                                Sertifikasi ini memberikan nilai tambah yang signifikan dalam karir saya. Materi yang
                                diajarkan sangat aplikatif dan langsung bisa diterapkan di dunia kerja. Terima kasih LSP
                                SMKN 1 Purwosari!
                            </p>
                        </div>

                        <!-- Card 4 -->
                        <div
                            class="hidden lg:block flex-1 border border-[#F2F3F6] rounded-xl p-8 transition-all hover:shadow-md">
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-[0c0c0c]">Siti Nurhaliza</h3>
                                    <p class="text-sm text-gray-500">Peserta</p>
                                </div>
                            </div>
                            <p class="text-[0c0c0c] leading-relaxed">Pengalaman belajar yang luar biasa! Instruktur sangat
                                profesional dan sabar dalam membimbing. Saya merasa lebih percaya diri dengan kompetensi
                                yang saya miliki sekarang.</p>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="testimonial-card active min-w-full grid grid-cols-1 lg:grid-cols-2 gap-6 px-2">
                        <!-- Card 5 -->
                        <div class="flex-1 border border-[#F2F3F6] rounded-xl p-8 transition-all hover:shadow-md">
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-[0c0c0c]">Budi Santoso</h3>
                                    <p class="text-sm text-gray-500">Industri Partner</p>
                                </div>
                            </div>
                            <p class="text-[0c0c0c] leading-relaxed">Lulusan dari program sertifikasi ini menunjukkan
                                kompetensi yang sangat baik. Mereka siap kerja dan memiliki etos yang tinggi. Kami sangat
                                puas dengan kualitas SDM yang dihasilkan.</p>
                        </div>

                        <!-- Card 6 -->
                        <div
                            class="hidden lg:block flex-1 border border-[#F2F3F6] rounded-xl p-8 transition-all hover:shadow-md">
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-[0c0c0c]">Rina Kusuma</h3>
                                    <p class="text-sm text-gray-500">Peserta</p>
                                </div>
                            </div>
                            <p class="text-[0c0c0c] leading-relaxed">
                                Program yang sangat terstruktur dan mudah dipahami. Fasilitas lengkap dan dukungan dari tim
                                LSP sangat membantu proses pembelajaran. Highly recommended untuk yang ingin meningkatkan
                                skill!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dots Navigation -->
            <div class="flex justify-center gap-2" id="sliderDots"></div>
        </div>
    </section>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('mobileMenu');
            var menuIcon = document.getElementById('menuIcon');
            var closeIcon = document.getElementById('closeIcon');

            menu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }
        // Simple auto-rotate slideshow
        (function () {
            const slides = document.querySelectorAll('.slide');
            if (!slides.length) return;
            let current = 0;
            const total = slides.length;
            const pager = document.getElementById('pager');
            const headlineEl = document.getElementById('slideHeadline');
            function show(i) {
                slides.forEach((el, idx) => {
                    el.classList.toggle('opacity-100', idx === i);
                    el.classList.toggle('opacity-0', idx !== i);
                });
                if (pager) pager.textContent = `${String(i + 1).padStart(2, '0')} / ${String(total).padStart(2, '0')}`;
                const active = slides[i];
                if (active && headlineEl) {
                    const h = active.getAttribute('data-headline') || 'LSP SMK NEGERI 1 PURWOSARI';
                    headlineEl.innerHTML = h.replace(/\n/g, '<br>');
                }
            }
            setInterval(() => {
                current = (current + 1) % total;
                show(current);
            }, 5000);
            // initialize to ensure headline matches first slide
            show(0);
        })();



        document.querySelectorAll(".faq-btn").forEach((btn) => {
            btn.addEventListener("click", () => {
                const content = btn.nextElementSibling;
                const icon = btn.querySelector("svg");
                const text = content.querySelector("p");
                const isOpen = content.style.maxHeight;

                // Tutup semua accordion yang terbuka
                document.querySelectorAll(".faq-content").forEach((item) => {
                    item.style.maxHeight = null;
                    item.querySelector("p").style.opacity = 0;
                    item.previousElementSibling.querySelector("svg").style.transform = "rotate(0deg)";
                });

                // Buka accordion yang diklik jika sebelumnya tertutup
                if (!isOpen) {
                    content.style.maxHeight = content.scrollHeight + "px";
                    text.style.opacity = 1;
                    icon.style.transform = "rotate(180deg)";
                }
            });
        });



        // Count-up animation for stats
        const counters = document.querySelectorAll('.countup');
        const duration = 1200; // ms
        const easeOutQuad = (t) => t * (2 - t);

        function animateCount(el) {
            const target = parseInt(el.getAttribute('data-target') || '0', 10);
            const suffix = el.getAttribute('data-suffix') || '';
            const startTime = performance.now();
            function frame(now) {
                const progress = Math.min(1, (now - startTime) / duration);
                const eased = easeOutQuad(progress);
                const value = Math.floor(eased * target);
                el.textContent = suffix ? `${value}${suffix}` : `${value}`;
                if (progress < 1) requestAnimationFrame(frame);
            }
            requestAnimationFrame(frame);
        }

        if ('IntersectionObserver' in window && counters.length) {
            const seen = new WeakSet();
            const io = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting && !seen.has(entry.target)) {
                        seen.add(entry.target);
                        animateCount(entry.target);
                    }
                });
            }, { threshold: 0.3 });
            counters.forEach((el) => io.observe(el));
        } else {
            counters.forEach(animateCount);
        }


    </script>

@endsection
