<!-- Navbar -->
<nav id="mainNavbar" class="fixed top-0 w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex shrink-0">
                <img class="h-10 md:h-14 w-auto" src="{{ asset('image/logo/new-logo.svg') }}" alt="Logo">
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex lg:items-center">
                <a href="{{ route('home') }}"
                    class="text-white/90 hover:text-white px-4 py-2 text-sm  rounded-md hover:bg-white/10 transition-colors">Beranda</a>
                <a href="{{ route('profile') }}"
                    class="text-white/90 hover:text-white px-4 py-2 text-sm rounded-md hover:bg-white/10 transition-colors">Profile
                    Kami</a>
                <a href="{{ route('skema.index') }}"
                    class="text-white/90 hover:text-white px-4 py-2 text-sm rounded-md hover:bg-white/10 transition-colors">Skema</a>
                <a href="{{ route('berita.index') }}"
                    class="text-white/90 hover:text-white px-4 py-2 text-sm rounded-md hover:bg-white/10 transition-colors">Berita</a>
                <a href="{{ route('kontak.kami') }}"
                    class="text-white/90 hover:text-white px-4 py-2 text-sm rounded-md hover:bg-white/10 transition-colors">Kontak
                    Kami</a>
            </div>

            <div class="hidden lg:flex">

                <a href="{{ route('pendaftaran.step1') }}"
                    class="ml-4 text-white bg-white/10 hover:bg-white/20 border border-white/20 px-6 py-2 rounded-full text-sm hover:shadow-md transition">
                    Daftar
                </a>

                <!-- Auth Dropdown -->
                <div class="hidden lg:flex relative group ml-4">
                    @auth
                        <button
                            class="flex items-center gap-2 text-white bg-white/10 hover:bg-white/20 border border-white/20 px-6 py-2 rounded-full text-sm hover:shadow-md transition">
                            <span class="text-sm text-white/90 max-w-[150px] max-w-[150px] truncate">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div
                            class="absolute right-0 mt-12 w-48 bg-white/10 border border-white/20 rounded-xl shadow-2xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                            <div class="px-4 py-3 border-b border-white/20 mb-1">
                                <p class="text-xs pb-4 text-white uppercase tracking-wider font-semibold">Akun</p>
                                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 text-sm text-white rounded-md hover:bg-white/10 transition-colors">Dashboard
                                Admin</a>
                            <form action="{{ route('logout') }}" method="POST" class="mt-1">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-white rounded-md hover:bg-white/10 transition-colors">Logout</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login.admin') }}"
                            class="text-white bg-white/10 hover:bg-white/20 border border-white/20 px-6 py-2 rounded-full text-sm hover:shadow-md transition">Masuk</a>
                    @endauth
                </div>

            </div>
            <!-- Mobile menu button -->
            <div class="lg:hidden flex items-center">
                <button onclick="toggleMenu()" class="text-white p-2 rounded-md hover:bg-white/10 transition">
                    <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile off-canvas menu -->
    <div id="mobileMenu" class="lg:hidden hidden fixed inset-0 z-50">
        <!-- Panel full-screen -->
        <div id="mobilePanel" class="absolute left-0 right-0 top-0 h-full w-full bg-black/95 border-b border-white/10 shadow-2xl transform -translate-y-full transition-transform duration-300 ease-out overflow-y-auto z-60">
            <div class="relative px-4 py-6">
                <button onclick="toggleMenu()" aria-label="Tutup menu"
                    class="absolute top-4 right-4 text-white p-2 rounded-full bg-white/10 hover:bg-white/20 border border-white/20 shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div class="pt-10 pb-4">
                    <div class="flex items-center gap-3 px-4">
                        <img class="h-10 w-auto" src="{{ asset('image/logo/new-logo.svg') }}" alt="Logo">
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <a href="{{ route('home') }}" onclick="toggleMenu()" class="w-full text-left px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg text-base transition">Beranda</a>
                    <a href="{{ route('profile') }}" onclick="toggleMenu()" class="w-full text-left px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg text-base transition">Profile Kami</a>
                    <a href="{{ route('skema.index') }}" onclick="toggleMenu()" class="w-full text-left px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg text-base transition">Skema</a>
                    <a href="{{ route('berita.index') }}" onclick="toggleMenu()" class="w-full text-left px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg text-base transition">Berita</a>
                    <a href="{{ route('kontak.kami') }}" onclick="toggleMenu()" class="w-full text-left px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg text-base transition">Kontak Kami</a>
                    <div class="mt-4 px-4">
                        <a href="{{ route('pendaftaran.step1') }}" onclick="toggleMenu()" class="w-full block text-center text-white bg-white/10 hover:bg-white/20 border border-white/20 px-5 py-3 rounded-full text-base shadow-md hover:shadow-lg transition">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    function toggleMenu() {
        var menu = document.getElementById('mobileMenu');
        var panel = document.getElementById('mobilePanel');
        var menuIcon = document.getElementById('menuIcon');
        var closeIcon = document.getElementById('closeIcon');

        var isHidden = menu.classList.contains('hidden');
        if (isHidden) {
            menu.classList.remove('hidden');
            requestAnimationFrame(function () {
                panel.classList.remove('-translate-y-full');
            });
            document.body.classList.add('overflow-hidden');
        } else {
            panel.classList.add('-translate-y-full');
            setTimeout(function () {
                menu.classList.add('hidden');
            }, 300);
            document.body.classList.remove('overflow-hidden');
        }

        if (menuIcon && closeIcon) {
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }
    }

    // Close when pressing ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var menu = document.getElementById('mobileMenu');
            if (menu && !menu.classList.contains('hidden')) toggleMenu();
        }
    });

    // Glass/blur background on scroll for navbar
    (function() {
        const navbar = document.getElementById('mainNavbar');
        if (!navbar) return;

        const applyScrollStyle = () => {
            if (window.scrollY > 10) {
                navbar.classList.add('backdrop-blur-lg', 'bg-black/20', 'shadow-lg');
            } else {
                navbar.classList.remove('backdrop-blur-lg', 'bg-black/20', 'shadow-lg');
            }
        };

        applyScrollStyle();
        window.addEventListener('scroll', applyScrollStyle, { passive: true });
    })();
</script>
@endpush
