@extends('layouts.vers2')
@section('content')
    <section class="w-full">
        <!-- Hero Image + Title -->
        <x-hero-title :src="asset('image/skema-hero.jpg')" alt="Profile Image" :title="'Lensa Berita<br />LSP SMK Negeri 1 Purwosari'" />

        <!-- Content Section -->
        <div class="px-4 sm:px-6 md:px-[48px] pt-[40px] sm:pt-[60px] md:pt-[78px] pb-[30px] sm:pb-[45px] md:pb-[57px]">
            <!-- Wrapper untuk mobile stacking -->
            <div class="flex flex-col gap-4 pb-[30px] md:flex-row md:items-center md:justify-between">
                <!-- Tabs -->
                <div class="flex gap-2 sm:gap-3 overflow-x-auto whitespace-nowrap pr-1 scrollbar-hide"
                    style="scrollbar-width: none; /* Firefox / -ms-overflow-style: none; / IE/Edge */"
                    onscroll="this.querySelector('.custom-scrollbar')?.remove();">
                    <!-- Active Tab -->
                    <button
                        class="px-3 py-1.5 sm:px-4 sm:py-2 bg-[#FFF9D7] text-[#FBC900] text-sm sm:text-[16px] font-medium leading-[20px] rounded-lg">Informasi
                        Umum</button>

                    <button
                        class="px-3 py-1.5 sm:px-4 sm:py-2 border border-[#949393] text-[#949393] text-sm sm:text-[16px] font-medium leading-[20px] rounded-lg">Pelaksanaan
                        LSP</button>

                    <button
                        class="px-3 py-1.5 sm:px-4 sm:py-2 border border-[#949393] text-[#949393] text-sm sm:text-[16px] font-medium leading-[20px] rounded-lg">Jadwal
                        LSP</button>

                    <button
                        class="px-3 py-1.5 sm:px-4 sm:py-2 border border-[#949393] text-[#949393] text-sm sm:text-[16px] font-medium leading-[20px] rounded-lg">Mitra
                        Kerja</button>
                </div>

                <!-- Search (selalu tampil, mobile berada di bawah tabs) -->
                <!-- <div class="relative w-full sm:w-auto md:w-auto">
                <input type="text" placeholder="Search..." class="rounded-lg bg-neutral-50 text-[#6B7280] pl-10 pr-3 py-2 w-full sm:w-48 md:w-60 text-xs sm:text-sm" />
                <img src="img/icons/search.svg" class="absolute left-3 top-1/2 -translate-y-1/2 opacity-60 w-4 h-4" />
              </div> -->
                <form action="{{ route('berita.index') }}" method="GET"
                    class="flex items-center gap-2 md:w-[314px] h-[52px] bg-gray-50 rounded-lg px-4 flex-shrink-0">
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    <input type="hidden" name="subkategori" value="{{ request('subkategori') }}">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input name="q" value="{{ request('q') }}" placeholder="Search..."
                        class="flex-1 bg-transparent outline-none text-sm text-gray-700" />
                </form>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($beritas as $b)
                    <a href="{{ route('berita.show', $b) }}" class="overflow-hidden transition block group">
                        <div class="relative rounded-[16px] w-full h-[218px] overflow-hidden">
                            <img src="{{ $b->gambar ? asset('storage/' . $b->gambar) : asset('image/placeholder.webp') }}"
                                class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform" />
                        </div>
                        <div class="pt-[16px] pb-[24px]">
                            <h3 class="font-medium leading-[30px] text-xl mb-[12px] line-clamp-2">{{ $b->judul }}</h3>
                            <div class="flex items-center gap-2 text-[#272727] text-sm">
                                {{ $b->sumber ?? 'Admin' }}
                                <div class="rounded-full h-[4px] w-[4px] bg-[#272727]"></div>
                                {{ \Carbon\Carbon::parse($b->tanggal)->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full">
                        <div class="rounded-xl border border-gray-200 p-8 text-center text-gray-500">Belum ada berita.</div>
                    </div>
                @endforelse
            </div>
        </div>



        <div class="max-w-7xl mx-auto px-[16px] md:px-[48px] mb-12">
            {{ method_exists($beritas, 'links') ? $beritas->links() : '' }}
        </div>
    </section>

    <script>
        const hiddenCards = document.querySelectorAll(".hidden-card");
        const loadMoreBtn = document.getElementById("loadMoreBtn");
        let currentIndex = 0;

        function getLoadCount() {
            const width = window.innerWidth;

            if (width >= 1024) return 3; // Desktop
            if (width >= 640) return 2; // Tablet
            return 1; // Mobile
        }

        loadMoreBtn.addEventListener("click", () => {
            const loadCount = getLoadCount();

            for (let i = 0; i < loadCount; i++) {
                if (currentIndex >= hiddenCards.length) break;

                hiddenCards[currentIndex].classList.remove("hidden");
                hiddenCards[currentIndex].classList.add("fade-in");
                currentIndex++;
            }

            // Jika sudah tidak ada card tersisa → sembunyikan tombol
            if (currentIndex >= hiddenCards.length) {
                loadMoreBtn.style.display = "none";
            }
        });
    </script>
@endsection
