<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LSP Website') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:...&family=Manrope:...&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    @hasSection('no-navbar')
    @else
        @include('partials.vers2.navbar')
    @endif

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @hasSection('no-footer')
    @else
        @include('partials.footer')
    @endif

    @if(session('success'))
        <div id="global-success-modal" class="fixed inset-0 z-[1000] flex items-center justify-center bg-black/40">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-[90%] p-6 text-center">
                <div class="mx-auto mb-3 w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
                </div>
                <h3 class="text-lg font-semibold mb-1">Berhasil</h3>
                <p class="text-gray-600">{{ session('success') }}</p>
                <div class="mt-5 flex items-center justify-center gap-2">
                    <button id="success-ok" class="px-4 py-2 rounded-lg bg-black text-white">Oke</button>
                </div>
            </div>
        </div>
        <script>
            (function(){
                const modal = document.getElementById('global-success-modal');
                const ok = document.getElementById('success-ok');
                function close(){ if(modal){ modal.remove(); } }
                ok && ok.addEventListener('click', close);
                modal && modal.addEventListener('click', function(e){ if(e.target === modal) close(); });
                setTimeout(close, 4000);
            })();
        </script>
    @endif

    @stack('scripts')
</body>
</html>
