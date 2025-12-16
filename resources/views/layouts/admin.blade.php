<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard | LSP')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen flex">
        @include('partials.admin.sidebar')
        <main class="flex-1 min-w-0">
            <header class="sticky top-0 z-10 bg-white border-b">
                <div class="max-w-7xl mx-auto px-4 py-[18px]">
                    <h1 class="text-lg font-semibold text-gray-800">@yield('page_title', 'Dashboard')</h1>
                </div>
            </header>
            <section class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8">
                @yield('content')
            </section>
        </main>
    </div>
    @if (session('success'))
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2 pointer-events-none">
        <div id="toast-success" class="pointer-events-auto relative flex w-80 max-w-[90vw] items-start gap-3 rounded-xl border border-emerald-200 bg-white/95 backdrop-blur-sm p-4 shadow-lg ring-1 ring-emerald-50 opacity-0 translate-y-2 transition-all duration-300">
            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-2.59a.75.75 0 10-1.22-.86l-3.284 4.66-1.6-1.6a.75.75 0 10-1.06 1.06l2.25 2.25a.75.75 0 001.155-.095l3.76-5.315z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="flex-1 pr-6">
                <div class="text-sm font-semibold text-emerald-700">Berhasil</div>
                <div class="mt-0.5 text-sm text-gray-700">{{ session('success') }}</div>
            </div>
            <button type="button" aria-label="Close" class="absolute right-2 top-2 rounded p-1 text-gray-400 hover:bg-gray-100 hover:text-gray-600" onclick="(function(){var t=document.getElementById('toast-success'); if(t){ clearTimeout(window.__toastTimer); t.style.opacity='0'; t.style.transform='translateY(8px)'; setTimeout(function(){ t.remove(); }, 300); }})();">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
    <script>
        (function(){
            var t = document.getElementById('toast-success');
            if(!t) return;
            requestAnimationFrame(function(){
                t.style.opacity = '1';
                t.style.transform = 'translateY(0)';
            });
            window.__toastTimer = setTimeout(function(){
                if(t){
                    t.style.opacity = '0';
                    t.style.transform = 'translateY(8px)';
                    setTimeout(function(){ if(t && t.parentNode){ t.parentNode.removeChild(t); } }, 300);
                }
            }, 5000);
        })();
    </script>
    @endif

    @stack('scripts')
</body>
</html>
