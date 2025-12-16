@props(['featured' => null, 'items' => collect()])
<section class="relative bg-white px-[16px] md:px-[48px] py-16 z-50">
  <div class="mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-8 gap-4">
      <div>
        <p class="text-gray-400 text-lg md:text-xl mb-2 text-start">Berita</p>
        <h2 class="text-[26px] md:text-[44px] font-semibold leading-tight">
          Langkah Nyata <br>Menuju Dunia Kerja
        </h2>
      </div>
      <div>
        <a href="#" class="inline-flex items-center gap-3 pl-5 pr-3 py-2 rounded-lg bg-[#FFF8E0] text-[#FFC300] font-medium hover:bg-[#FFF9D9] transition">
        Selengkapnya
        <span class="inline-flex w-7 h-7 items-center justify-center">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </span>
      </a>
      </div>

    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-4 items-start">
      <!-- Featured Article - Left Side (2 columns) -->
      <div class="lg:col-span-2">
        @if($featured)
          <a href="{{ route('berita.show', $featured) }}" class="block group relative rounded-2xl overflow-hidden h-[260px] md:h-[420px] lg:h-[500px]">
            @if($featured->gambar)
              <img src="{{ asset('storage/'.$featured->gambar) }}" alt="{{ $featured->judul }}" class="w-full h-full object-cover" />
            @else
              <div class="w-full h-full bg-gray-200"></div>
            @endif
            <div class="absolute inset-x-0 bottom-0 h-36 md:h-44 lg:h-48 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
              <h3 class="text-white text-2xl md:text-3xl font-semibold leading-snug line-clamp-3 group-hover:opacity-90 transition mb-2">
                {{ \Illuminate\Support\Str::limit($featured->judul, 90) }}
              </h3>
              <div class="h-1.5 md:h-2 w-24 md:w-36 bg-gradient-to-r from-white/90 via-white/50 to-transparent rounded-full mb-3"></div>
              <div class="text-gray-200 text-sm">
                {{ \Illuminate\Support\Carbon::parse($featured->tanggal)->translatedFormat('d F, Y') }} ·
                {{ $featured->sumber }}
              </div>
            </div>
          </a>
        @else
          <div class="rounded-2xl border border-gray-200 p-10 text-gray-500 h-[500px] flex items-center justify-center">
            Belum ada berita ditampilkan.
          </div>
        @endif
      </div>

      <!-- Side Articles - Right Side -->
      <div class="flex flex-col gap-4 md:grid md:grid-cols-2 md:gap-4 md:h-auto lg:flex lg:flex-col lg:justify-between lg:h-[500px]">
        @forelse($items->take(4) as $i)
          <a href="{{ route('berita.show', $i) }}" class="flex items-start gap-6 md:gap-4 group">
            @if($i->gambar)
              <img src="{{ asset('storage/'.$i->gambar) }}" alt="{{ $i->judul }}" class="w-24 h-24 md:w-24 md:h-24 lg:w-28 lg:h-28 object-cover rounded-lg flex-shrink-0" />
            @else
              <div class="w-24 h-24 md:w-24 md:h-24 lg:w-28 lg:h-28 bg-gray-200 rounded-lg flex-shrink-0"></div>
            @endif
            <div class="flex-1 min-w-0 flex flex-col justify-between h-24 md:h-24 lg:h-28">
                <div class="text-xs text-gray-500">
                {{ $i->sumber }} ·
                {{ \Illuminate\Support\Carbon::parse($i->tanggal)->translatedFormat('d F, Y') }}
              </div>
              <h4 class="font-semibold text-gray-900 text-base lg:text-lg leading-snug line-clamp-3 mb-1">
                {{ \Illuminate\Support\Str::limit($i->judul, 80) }}
              </h4>
            </div>
          </a>
        @empty
          <div class="rounded-xl border border-gray-200 p-6 text-gray-500 text-center h-full flex items-center justify-center">
            Tidak ada item lain
          </div>
        @endforelse
      </div>
    </div>
  </div>
</section>
