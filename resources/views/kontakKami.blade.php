@extends('layouts.vers2')

@section('content')
    <div class="w-full">
        <x-hero-title :src="asset('image/skema-hero.jpg')" alt="Profile Image" :title="'Kontak <br />Kami'" />

        <div class="px-[16px] md:px-[48px] py-10 md:py-14 lg:py-16">
            <p class="text-gray-400 text-sm md:text-base">Kontak Kami</p>
            <div class="grid lg:grid-cols-6 md:grid-cols-2 grid-cols-1 gap-10 lg:gap-16">

                <!-- Left: Headline + Info -->
                <div class="lg:col-span-3 space-y-10">
                    <div class="space-y-4">

                        <h1 class="text-[32px] md:text-[44px] lg:text-[52px] leading-[120%] font-bold text-neutral-900">
                            Ada pertanyaan?<br />
                            Kami di sini untuk<br />
                            Anda.
                        </h1>
                        <p class="text-gray-600 text-base md:text-lg max-w-2xl">
                            Tim kami selalu siap menjawab pertanyaan Anda dan membantu menemukan solusi terbaik. Jangan ragu
                            untuk menghubungi kami kapan saja.
                        </p>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-10">
                        <div class="space-y-6">
                            <div class="flex flex-col gap-2">
                                <h3 class="font-semibold text-gray-900">Email</h3>
                                <a href="mailto:informasi@smkn1purwosari.sch.id"
                                    class="block text-gray-500 break-words">informasi@smkn1purwosari.sch.id</a>
                            </div>
                            <!-- Lokasi -->
                            <div class="flex flex-col gap-2">
                                <h3 class="font-semibold text-gray-900">Lokasi</h3>
                                <p class="text-gray-500">Jl. Raya Purwosari No. 1, Kec Purwosari,<br />Kab Pasuruan, Jawa
                                    Timur 67162</p>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <!-- Telepon -->
                            <div class="flex flex-col gap-2">
                                <h3 class="font-semibold text-gray-900">Telepon</h3>
                                <a href="tel:034361374" class="block text-gray-500">(0343) 613747</a>
                            </div>
                            <!-- Sosial Media -->
                            <div class="flex flex-col gap-2">
                                <h3 class="font-semibold text-gray-900">Social Media</h3>
                                <div class="flex items-center gap-4 text-gray-900">
                                    <a href="#" aria-label="Instagram" class="inline-flex">
                                        <img src="{{ asset('image/icon/Instagram-Negative.svg') }}" alt="">
                                    </a>
                                    <a href="#" aria-label="Facebook" class="inline-flex">
                                        <img src="{{ asset('image/icon/Facebook-Negative.svg') }}" alt="">
                                    </a>
                                    <a href="#" aria-label="YouTube" class="inline-flex">
                                        <img src="{{ asset('image/icon/Youtube-Negative.svg') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Form -->
                <div class="lg:col-span-3">
                    <form id="contactForm" class="grid grid-cols-1 gap-5" novalidate>
                        <div>
                            <label for="fullName" class="block text-sm font-medium text-gray-900 mb-2">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input id="fullName" type="text" name="fullName" placeholder="Masukkan Nama Lengkap Anda"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300" />
                            <p class="error-message hidden text-red-500 text-sm mt-1"></p>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email <span
                                    class="text-red-500">*</span></label>
                            <input id="email" type="email" name="email" placeholder="Masukkan Email Anda"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300" />
                            <p class="error-message hidden text-red-500 text-sm mt-1"></p>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-900 mb-2">Subjek <span
                                    class="text-red-500">*</span></label>
                            <input id="subject" type="text" name="subject" placeholder="Masukkan Subjek Pesan"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300" />
                            <p class="error-message hidden text-red-500 text-sm mt-1"></p>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-900 mb-2">Pesan <span
                                    class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="6" placeholder="Tulis Pesan Anda"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 resize-none"></textarea>
                            <p class="error-message hidden text-red-500 text-sm mt-1"></p>
                        </div>
                        <div class="flex justify-end pt-2">
                            <button id="submitBtn" type="submit"
                                class="inline-flex items-center px-6 py-3 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800">Kirim</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            const form = document.getElementById('contactForm');
            if (!form) return;
            const fields = {
                fullName: { el: document.getElementById('fullName'), min: 3, required: true },
                email: { el: document.getElementById('email'), required: true, email: true },
                subject: { el: document.getElementById('subject'), min: 5, required: true },
                message: { el: document.getElementById('message'), min: 10, required: true },
            };

            function showError(input, msg) {
                const p = input.parentElement.querySelector('.error-message');
                if (p) { p.textContent = msg; p.classList.remove('hidden'); }
                input.classList.remove('border-gray-200');
                input.classList.add('border-red-500');
            }

            function clearError(input) {
                const p = input.parentElement.querySelector('.error-message');
                if (p) { p.textContent = ''; p.classList.add('hidden'); }
                input.classList.remove('border-red-500');
                input.classList.add('border-gray-200');
            }

            function validate() {
                let ok = true;
                const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                for (const key in fields) {
                    const cfg = fields[key];
                    const el = cfg.el;
                    const val = (el.value || '').trim();
                    clearError(el);
                    if (cfg.required && !val) { showError(el, 'Wajib diisi'); ok = false; continue; }
                    if (cfg.min && val.length < cfg.min) { showError(el, `Minimal ${cfg.min} karakter`); ok = false; continue; }
                    if (cfg.email && val && !emailRe.test(val)) { showError(el, 'Format email tidak valid'); ok = false; continue; }
                }
                return ok;
            }

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                if (validate()) {
                    alert('Form valid. Implementasi submit server-side bisa ditambahkan.');
                    form.reset();
                    for (const k in fields) { clearError(fields[k].el); }
                }
            });

            Object.values(fields).forEach(({ el }) => {
                el.addEventListener('blur', () => validate());
                el.addEventListener('input', () => clearError(el));
            });
        })();
    </script>
@endpush
