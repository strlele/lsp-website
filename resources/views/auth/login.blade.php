@extends('layouts.app')

@section('no-navbar')@endsection
@section('no-footer')@endsection

@section('title', 'Login | LSP SMKN 1 Purwosari')

@section('content')
    <div class="relative min-h-screen flex items-center justify-center px-4 py-10 overflow-hidden">
        <!-- Background image + gradient overlay -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('image/hero.webp') }}')"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-black/40 via-black/30 to-black/50"></div>
            <!-- Accent blobs -->
            <div class="absolute -top-24 -left-24 w-[360px] h-[360px] bg-yellow-400/30 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-[320px] h-[320px] bg-amber-500/20 rounded-full blur-3xl"></div>
        </div>

        <!-- Card -->
        <div class="relative w-full max-w-xl">
            <div class="rounded-3xl p-[1px] bg-gradient-to-r from-yellow-400 via-amber-400 to-orange-500 shadow-2xl">
                <div class="rounded-[22px] bg-white/95 backdrop-blur-xl p-6 sm:p-8">
                    <!-- Logo & Heading -->
                    <div class="flex flex-col items-center mb-6">
                        <img src="{{ asset('image/logo/logo-2.svg') }}" class="h-14 mb-3" alt="Logo">
                        <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-neutral-900">Selamat Datang</h1>
                        <p class="text-neutral-600 text-sm mt-1">Silakan login untuk melanjutkan</p>
                    </div>

                    <form action="{{ route('login') }}" method="POST" class="space-y-5" novalidate>
                    @csrf

                    @if(session('throttle'))
                        <div class="bg-yellow-50 text-yellow-800 rounded-lg p-3" role="alert" aria-live="polite">{{ session('throttle') }}</div>
                    @endif

                    <div>
                        <label for="username" class="block text-sm text-neutral-800 mb-1">Username</label>
                        <input id="username" name="username" type="text" autocomplete="username" value="{{ old('username') }}"
                            placeholder="Masukkan username"
                            class="w-full rounded-xl bg-neutral-100 border border-neutral-200 px-4 py-3 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition @error('username') border-red-400/70 focus:ring-red-300 @enderror"
                            required autofocus>
                        @error('username')
                            <p class="mt-1 text-sm text-red-600" role="alert" aria-live="polite">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm text-neutral-800 mb-1">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan password"
                                class="w-full rounded-xl bg-neutral-100 border border-neutral-200 px-4 py-3 pr-12 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition @error('password') border-red-400/70 focus:ring-red-300 @enderror"
                                required>
                            <button type="button" onclick="togglePwd()"
                                class="absolute inset-y-0 right-0 px-3 flex items-center text-neutral-500 hover:text-neutral-700">
                                <svg id="eye-off" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4.5-9-7 0-1.03.52-2.25 1.45-3.5M6.1 6.1C7.83 4.82 9.84 4 12 4c5 0 9 4.5 9 7 0 1.086-.468 2.347-1.318 3.6M15 12a3 3 0 11-6 0 3 3 0 016 0zM3 3l18 18" />
                                </svg>
                                <svg id="eye-on" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600" role="alert" aria-live="polite">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full rounded-xl py-[13px] font-semibold text-white bg-gradient-to-r from-yellow-400 via-amber-400 to-orange-500 shadow-lg hover:opacity-95 active:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">Masuk</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function togglePwd() {
            const input = document.getElementById('password');
            const on = document.getElementById('eye-on');
            const off = document.getElementById('eye-off');
            const isPwd = input.type === 'password';
            input.type = isPwd ? 'text' : 'password';
            on.classList.toggle('hidden', !isPwd);
            off.classList.toggle('hidden', isPwd);
        }
    </script>
@endpush
