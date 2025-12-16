@extends('layouts.app')

@section('no-navbar')@endsection
@section('no-footer')@endsection

@section('title', 'Login | LSP SMKN 1 Purwosari')

@section('content')
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center px-4"
        style="background-image: url('{{ asset('image/hero.webp') }}')">
        <div class="w-full max-w-xl bg-white rounded-3xl shadow-xl">
            <div class="p-6 sm:p-8">
                <div class="flex items-start gap-4 mb-6">
                    <img src="{{ asset('image/logo/logo.svg') }}" alt="Logo" class="h-10 w-10 object-contain">
                    <div class="leading-tight">
                        <div class="text-lg font-semibold"><span class="text-[#1FA1FF]">LSP</span> SMKN 1</div>
                        <div class="text-gray-600 text-sm">Purwosari</div>
                    </div>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    @if(session('throttle'))
                        <div class="bg-yellow-50 text-yellow-800 rounded-lg p-3">{{ session('throttle') }}</div>
                    @endif

                    <div>
                        <label for="username" class="block text-sm text-gray-800 mb-1">Username</label>
                        <input id="username" name="username" type="text" value="{{ old('username') }}"
                            placeholder="Masukkan username"
                            class="w-full rounded-lg bg-gray-100 border border-gray-200 px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none"
                            required autofocus>
                        @error('username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm text-gray-800 mb-1">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" placeholder="Masukkan password"
                                class="w-full rounded-lg bg-gray-100 border border-gray-200 px-4 py-3 pr-12 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none"
                                required>
                            <button type="button" onclick="togglePwd()"
                                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700">
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
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-semibold rounded-lg py-3 transition-colors">Masuk</button>
                </form>
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
