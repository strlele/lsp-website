@extends('layouts.vers2')

@section('content')
    <div>
        <x-hero-title :src="asset('image/skema-hero.jpg')" alt="Profile Image" :title="'Skema'" />
        <div class="bg-white px-[16px] md:px-[48px] py-10 md:py-14 lg:py-16">
            <!-- Header Section -->
            <div class="max-w-7xl mx-auto mb-8 lg:mb-12">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <!-- Category Buttons with Subcategory Dropdowns -->
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('skema.index', array_filter(['q' => request('q')])) }}"
                            class="flex items-center gap-2 px-4 py-3 rounded-lg text-base font-medium whitespace-nowrap {{ request('kategori') ? 'bg-white border border-gray-200 text-gray-500 hover:bg-gray-50' : 'bg-[#FFF8E0] text-[#FFC300]' }}">
                            Semua
                        </a>
                        @isset($kategoris)
                            @foreach($kategoris as $kat)
                                @php
                                    $isActive = (string) request('kategori') === (string) $kat->id && !request('subkategori');
                                    $hasSubs = isset($kat->subkategoris) && $kat->subkategoris->count();
                                @endphp
                                <div class="relative" data-dropdown-wrapper>
                                    <a href="{{ route('skema.index', array_filter(['kategori' => $kat->id, 'q' => request('q')])) }}"
                                        class="flex items-center gap-2 px-4 py-3 pr-9 rounded-lg text-base whitespace-nowrap {{ $isActive ? 'bg-[#FFF8E0] text-[#FFC300]' : 'bg-white border border-gray-200 text-[#949393] hover:bg-gray-50' }}"
                                        data-category-link>
                                        {{ $kat->nama_kategori }}
                                        @if($hasSubs)
                                            <span class="absolute right-2 inset-y-0 flex items-center cursor-pointer"
                                                data-dropdown-toggle aria-label="Toggle subkategori">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </span>
                                        @endif
                                    </a>

                                    @if($hasSubs)
                                        <div class="absolute z-20 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow hidden"
                                            data-dropdown-menu>
                                            <div class="py-1 max-h-80 overflow-auto">
                                                <a href="{{ route('skema.index', array_filter(['kategori' => $kat->id, 'q' => request('q')])) }}"
                                                    class="block px-3 py-2 text-sm {{ request('kategori') == $kat->id && !request('subkategori') ? 'bg-gray-50 text-gray-900' : 'text-gray-700 hover:bg-gray-50' }}">
                                                    Semua di {{ $kat->nama_kategori }}
                                                </a>
                                                @foreach($kat->subkategoris as $s)
                                                    <a href="{{ route('skema.index', array_filter(['kategori' => $kat->id, 'subkategori' => $s->id, 'q' => request('q')])) }}"
                                                        class="block px-3 py-2 text-sm {{ (string) request('subkategori') === (string) $s->id ? 'bg-gray-50 text-gray-900' : 'text-gray-700 hover:bg-gray-50' }}">
                                                        {{ $s->nama_subkategori }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endisset
                    </div>

                    <!-- Search Box + Subkategori -->
                    <form action="{{ route('skema.index') }}" method="GET"
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
                {{-- Dropdown per kategori sudah tersedia pada tombol. Bagian select ini tidak diperlukan lagi. --}}
            </div>

            <!-- Cards Grid -->
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($skemas as $skema)
                        <div
                            class="flex flex-col justify-between h-[226px] bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition-shadow">
                            <div class="space-y-4">
                                <p class="text-gray-500 text-sm leading-[17px]">
                                    {{ optional($skema->subkategori)->nama_subkategori ?? 'Tanpa Subkategori' }}</p>
                                <h3 class="text-2xl font-semibold leading-[29px]">{{ $skema->nama_skema }}</h3>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="bg-gray-100 text-[#272727] text-sm px-2 py-2 rounded-sm leading-[17px]">{{ $skema->kompetensis_count ?? 0 }}
                                        Unit Kompetensi</span>
                                </div>
                            </div>

                            <a href="{{ route('skema.show', $skema) }}"
                                class="flex gap-6 justify-center items-center w-full bg-black text-white p-3 rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium">
                                Lihat Detail
                                <img src="{{ asset('image/icon/arrow-right-white.svg') }}" alt="">
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="rounded-xl border border-gray-200 p-8 text-center text-gray-500">Belum ada skema
                                tersedia.</div>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ method_exists($skemas, 'links') ? $skemas->links() : '' }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            const wrappers = document.querySelectorAll('[data-dropdown-wrapper]');
            function closeAll(except) {
                wrappers.forEach(w => {
                    if (w !== except) {
                        const menu = w.querySelector('[data-dropdown-menu]');
                        menu && menu.classList.add('hidden');
                    }
                });
            }
            wrappers.forEach(w => {
                const toggle = w.querySelector('[data-dropdown-toggle]');
                const menu = w.querySelector('[data-dropdown-menu]');
                if (!toggle || !menu) return;
                toggle.addEventListener('click', function (ev) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    const isHidden = menu.classList.contains('hidden');
                    closeAll(w);
                    if (isHidden) menu.classList.remove('hidden'); else menu.classList.add('hidden');
                });
            });
            document.addEventListener('click', function () { closeAll(null); });
            window.addEventListener('resize', function () { closeAll(null); });
            window.addEventListener('scroll', function () { closeAll(null); }, true);
        })();
    </script>
@endpush
