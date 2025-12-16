<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LSP SMKN 1 Purwosari')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:...&family=Manrope:...&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @if (trim($__env->yieldContent('no-navbar', '0')) === '0')
        @include('partials.navbar')
    @endif

    <main>
        @yield('content')
    </main>

    @if (trim($__env->yieldContent('no-footer', '0')) === '0')
        @include('partials.footer')
    @endif

    @stack('scripts')
</body>
</html>
