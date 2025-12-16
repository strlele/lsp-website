<aside class="w-64 bg-white border-r hidden md:flex md:flex-col">
    <div class="h-16 flex items-center px-4 border-b">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('image/logo/logo-2.svg') }}" alt="Logo" class="h-8 w-8">
            <div>
                <div class="font-bold text-sm">CMS LSP</div>
                <div class="text-xs text-gray-500">SMKN NEGERI 1 PURWOSARI</div>
            </div>
        </a>
    </div>

    <nav class="flex-1 p-4 space-y-1">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'font-medium' : 'text-gray-600' }}"
            style="{{ request()->routeIs('admin.dashboard') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}"
            onmouseover="if(!this.classList.contains('font-medium')) { this.style.backgroundColor='#FFFDF4'; this.style.color='#FFD54B'; }"
            onmouseout="if(!this.classList.contains('font-medium')) { this.style.backgroundColor=''; this.style.color=''; }">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6" />
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.slideshow.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.slideshow.*') ? 'font-medium' : 'text-gray-600' }}"
            style="{{ request()->routeIs('admin.slideshow.*') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}"
            onmouseover="if(!this.classList.contains('font-medium')) { this.style.backgroundColor='#FFFDF4'; this.style.color='#FFD54B'; }"
            onmouseout="if(!this.classList.contains('font-medium')) { this.style.backgroundColor=''; this.style.color=''; }">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            <span>Slideshow</span>
        </a>

        <a href="{{ route('admin.berita.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.berita.*') ? 'font-medium' : 'text-gray-600' }}"
            style="{{ request()->routeIs('admin.berita.*') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}"
            onmouseover="if(!this.classList.contains('font-medium')) { this.style.backgroundColor='#FFFDF4'; this.style.color='#FFD54B'; }"
            onmouseout="if(!this.classList.contains('font-medium')) { this.style.backgroundColor=''; this.style.color=''; }">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            <span>Berita</span>
        </a>

        <!-- Skema Dropdown -->
        <div>
            <button onclick="toggleSkemaMenu()" id="skemaBtn"
                class="w-full flex items-center justify-between gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.skema.') || request()->routeIs('admin.kategori.') || request()->routeIs('admin.subkategori.') || request()->routeIs('admin.kompetensi.') ? 'font-medium' : 'text-gray-600' }}"
                style="{{ request()->routeIs('admin.skema.') || request()->routeIs('admin.kategori.') || request()->routeIs('admin.subkategori.') || request()->routeIs('admin.kompetensi.') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}"
                onmouseover="if(!this.classList.contains('font-medium')) { this.style.backgroundColor='#FFFDF4'; this.style.color='#FFD54B'; }"
                onmouseout="if(!this.classList.contains('font-medium')) { this.style.backgroundColor=''; this.style.color=''; }">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Skema</span>
                </div>
                <svg id="skemaIcon" class="h-4 w-4 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div id="skemaMenu" class="hidden ml-4 mt-1 space-y-1">
                <a href="{{ route('admin.kategori.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('admin.kategori.*') ? 'font-medium' : 'text-gray-500' }}"
                    style="{{ request()->routeIs('admin.kategori.*') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}"
                    onmouseover="if(!this.classList.contains('font-medium')) { this.style.backgroundColor='#FFFDF4'; this.style.color='#FFD54B'; }"
                    onmouseout="if(!this.classList.contains('font-medium')) { this.style.backgroundColor=''; this.style.color=''; }">
                    <span>Kategori Skema</span>
                </a>
                <a href="{{ route('admin.skema.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('admin.skema.*') ? 'font-medium' : 'text-gray-500' }}"
                    style="{{ request()->routeIs('admin.skema.*') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}"
                    onmouseover="if(!this.classList.contains('font-medium')) { this.style.backgroundColor='#FFFDF4'; this.style.color='#FFD54B'; }"
                    onmouseout="if(!this.classList.contains('font-medium')) { this.style.backgroundColor=''; this.style.color=''; }">
                    <span>Skema</span>
                </a>
                <a href="{{ route('admin.kompetensi.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('admin.kompetensi.*') ? 'font-medium' : 'text-gray-500' }}"
                    style="{{ request()->routeIs('admin.kompetensi.*') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}"
                    onmouseover="if(!this.classList.contains('font-medium')) { this.style.backgroundColor='#FFFDF4'; this.style.color='#FFD54B'; }"
                    onmouseout="if(!this.classList.contains('font-medium')) { this.style.backgroundColor=''; this.style.color=''; }">
                    <span>Kompetensi</span>
                </a>
                <a href="{{ route('admin.subkategori.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('admin.subkategori.*') ? 'font-medium' : 'text-gray-500' }}"
                    style="{{ request()->routeIs('admin.subkategori.*') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}"
                    onmouseover="if(!this.classList.contains('font-medium')) { this.style.backgroundColor='#FFFDF4'; this.style.color='#FFD54B'; }"
                    onmouseout="if(!this.classList.contains('font-medium')) { this.style.backgroundColor=''; this.style.color=''; }">
                    <span>Subkategori</span>
                </a>
            </div>
        </div>

        <a href="{{ route('admin.pendaftaran.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.pendaftaran.*') ? 'font-medium' : 'text-gray-600' }}"
            style="{{ request()->routeIs('admin.pendaftaran.*') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}"
            onmouseover="if(!this.classList.contains('font-medium')) { this.style.backgroundColor='#FFFDF4'; this.style.color='#FFD54B'; }"
            onmouseout="if(!this.classList.contains('font-medium')) { this.style.backgroundColor=''; this.style.color=''; }">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span>Pendaftar</span>
        </a>
    </nav>

    <div class="p-4 border-t">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button
                class="w-full px-4 py-2.5 font-medium rounded-lg
         bg-[#FFC300] text-black
         hover:bg-[#e6b800] transition-colors
         flex items-center justify-center gap-2">
                <span>Logout</span>
            </button>

        </form>
    </div>
</aside>

<!-- Mobile topbar with menu button -->
<div class="md:hidden w-full bg-white border-b sticky top-0 z-20">
    <div class="h-16 flex items-center justify-between px-4">
        <div class="flex items-center gap-2">
            <img src="{{ asset('image/logo/logo.svg') }}" class="h-8 w-8" alt="Logo">
            <div>
                <div class="font-bold text-sm">CMS LSP</div>
                <div class="text-xs text-gray-500">SMK NEGERI 11 MALANG</div>
            </div>
        </div>
        <button id="mobileMenuBtn" class="p-2 rounded-md border">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    <div id="mobileMenu" class="hidden border-t">
        <nav class="p-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'font-medium' : '' }}" style="{{ request()->routeIs('admin.dashboard') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}">Dashboard</a>
            <a href="{{ route('admin.slideshow.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.slideshow.') ? 'font-medium' : '' }}" style="{{ request()->routeIs('admin.slideshow.') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}">Slideshow</a>
            <a href="{{ route('admin.berita.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.berita.') ? 'font-medium' : '' }}" style="{{ request()->routeIs('admin.berita.') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}">Berita</a>
            <a href="{{ route('admin.kategori.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.kategori.') ? 'font-medium' : '' }}" style="{{ request()->routeIs('admin.kategori.') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}">Kategori Skema</a>
            <a href="{{ route('admin.skema.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.skema.') ? 'font-medium' : '' }}" style="{{ request()->routeIs('admin.skema.') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}">Skema</a>
            <a href="{{ route('admin.kompetensi.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.kompetensi.') ? 'font-medium' : '' }}" style="{{ request()->routeIs('admin.kompetensi.') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}">Kompetensi</a>
            <a href="{{ route('admin.subkategori.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.subkategori.') ? 'font-medium' : '' }}" style="{{ request()->routeIs('admin.subkategori.') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}">Subkategori</a>
            <a href="{{ route('admin.pendaftaran.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.pendaftaran.') ? 'font-medium' : '' }}" style="{{ request()->routeIs('admin.pendaftaran.') ? 'background-color: #FFF8E0; color: #FFC300;' : '' }}">Pendaftar</a>
            <form action="{{ route('logout') }}" method="POST" class="px-3 py-2">
                @csrf
                <button class="w-full px-3 py-2 font-medium rounded-lg transition-colors"
                    style="background-color: #FFC300; color: #000;"
                    onmouseover="this.style.backgroundColor='#FFC300'; this.style.color='#000';"
                    onmouseout="this.style.backgroundColor='#FFC300'; this.style.color='#000';">
                    Logout
                </button>


            </form>
        </nav>
    </div>
</div>

@push('scripts')
<script>
    // Mobile menu toggle
    const btn = document.getElementById('mobileMenuBtn');
    const menu = document.getElementById('mobileMenu');
    if (btn && menu) {
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    }

    // Skema dropdown toggle dengan state persistence
    function toggleSkemaMenu() {
        const skemaMenu = document.getElementById('skemaMenu');
        const skemaIcon = document.getElementById('skemaIcon');
        const isOpen = !skemaMenu.classList.contains('hidden');

        if (isOpen) {
            skemaMenu.classList.add('hidden');
            skemaIcon.classList.remove('rotate-180');
            sessionStorage.setItem('skemaMenuOpen', 'false');
        } else {
            skemaMenu.classList.remove('hidden');
            skemaIcon.classList.add('rotate-180');
            sessionStorage.setItem('skemaMenuOpen', 'true');
        }
    }

    // Restore skema menu state on page load
    document.addEventListener('DOMContentLoaded', function() {
        const skemaMenu = document.getElementById('skemaMenu');
        const skemaIcon = document.getElementById('skemaIcon');
        const skemaBtn = document.getElementById('skemaBtn');

        // Check if user manually opened/closed the menu
        const menuState = sessionStorage.getItem('skemaMenuOpen');

        // Check if currently on skema related page
        const isSkemaPage = skemaBtn && skemaBtn.classList.contains('font-medium');

        // Open menu if: 1) user manually opened it, OR 2) on skema page and not manually closed
        if (menuState === 'true' || (isSkemaPage && menuState !== 'false')) {
            skemaMenu.classList.remove('hidden');
            skemaIcon.classList.add('rotate-180');
            sessionStorage.setItem('skemaMenuOpen', 'true');
        }
    });
</script>
@endpush
