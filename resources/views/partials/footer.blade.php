<footer class="relative z-10 bg-black text-gray-300">
    <div class="pt-10 px-[16px] md:px-12">
        <div class="max-w-7xl mx-auto">
            <!-- ATAS : LSP + POLICY -->
            <div
                class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 lg:gap-8 mb-[48px] lg:mb-[64px]">
                <div>
                    <h2 class="text-white text-[32px] font-bold">LSP</h2>
                    <p class="text-xs font-medium text-white tracking-wide">SMK NEGERI 1 PURWOSARI</p>
                </div>
                <div
                    class="flex flex-col sm:flex-row flex-wrap items-start sm:items-center gap-4 sm:gap-6 text-base mt-2 text-[#C0C0C0]">
                    <a href="#" class="hover:text-white transition mr-[20px]">Terms & Conditions</a>
                    <span class="hidden lg:flex text-gray-600 mr-[20px]">|</span>
                    <a href="#" class="hover:text-white transition mr-[20px]">Privacy Policy</a>
                    <span class="hidden lg:flex text-gray-600 mr-[20px]">|</span>
                    <a href="#" class="hover:text-white transition">Disclosures</a>
                </div>
            </div>

            <!-- BAWAH : KONTAK -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 mb-12">
                <!-- KOLOM 1: INFO KONTAK + TOMBOL KONTAK (untuk tablet) -->
                <div class="grid grid-cols-1 gap-8 text-base lg:col-span-6">
                    <div class="space-y-6 text-base">
                        <!-- Alamat -->
                        <div class="grid grid-cols-3">
                            <p class="col-span-1 text-[#C0C0C0]">Alamat</p>
                            <p class="col-span-2 text-white leading-relaxed">
                                Jl. Raya Purwosari No. 1, Kec Purwosari,<br />
                                Kab Pasuruan, Jawa Timur 67162
                            </p>
                        </div>

                        <!-- Email -->
                        <div class="grid grid-cols-3">
                            <p class="col-span-1 text-[#C0C0C0] max-w-[100px] shrink-0">Email</p>
                            <p class="col-span-2 text-white min-w-0 break-words">informasi@smkn1purwosari.sch.id</p>
                        </div>

                        <!-- Telepon -->
                        <div class="grid grid-cols-3">
                            <p class="col-span-1 text-[#C0C0C0] max-w-[100px] shrink-0">Telepon</p>
                            <p class="col-span-2 text-white">(0343) 613747</p>
                        </div>
                    </div>

                    <!-- TOMBOL KONTAK (muncul di kolom 1 untuk tablet, kolom 2 untuk desktop) -->
                    <div class="relative flex flex-col items-start lg:hidden text-base mt-4">
                        <p class="text-[#C0C0C0] mb-4">Kontak Kami</p>
                        <a href="#"
                            class="w-full inline-flex items-center justify-center gap-2 bg-white text-black px-8 py-3 rounded-lg font-medium hover:bg-gray-200 transition">
                            <img src="{{ asset('image/icon/whatsapp.svg') }}" alt="whatsapp icon">
                            Kontak Kami
                        </a>
                    </div>
                </div>

                <!-- TOMBOL KONTAK (hanya muncul di desktop) -->
                <div class="hidden lg:flex relative flex-col items-start h-full text-base lg:col-span-3">
                    <p class="text-[#C0C0C0] mb-4">Kontak Kami</p>
                    <a href="#"
                        class="mt-auto w-full inline-flex items-center justify-center gap-2 bg-white text-black px-8 py-3 rounded-lg font-medium hover:bg-gray-200 transition">
                        <img src="{{ asset('image/icon/whatsapp.svg') }}" alt="whatsapp icon">
                        Kontak Kami
                    </a>
                </div>

                <!-- KOLOM 2: SOSIAL MEDIA -->
                <div class="flex flex-col items-start lg:items-end h-full lg:col-span-3">
                    <p class="text-base text-gray-400 lg:mt-0 md:mt-auto mb-4">Sosial Media</p>
                    <div class="flex gap-3 lg:mt-auto md:mt-0">
                        <a href="#"
                            class="w-10 h-10 border border-white rounded-full flex items-center justify-center hover:bg-white hover:text-black transition">
                            <img src="{{ asset('image/icon/linkedin.svg') }}" alt="LinkedIn" class="w-5 h-5">
                        </a>
                        <a href="#"
                            class="w-10 h-10 border border-white rounded-full flex items-center justify-center hover:bg-white hover:text-black transition">
                            <img src="{{ asset('image/icon/facebook.svg') }}" alt="Facebook">
                        </a>
                        <a href="#"
                            class="w-10 h-10 border border-white rounded-full flex items-center justify-center hover:bg-white hover:text-black transition">
                            <img src="{{ asset('image/icon/instagram.svg') }}" alt="Instagram">
                        </a>
                        <a href="#"
                            class="w-10 h-10 border border-white rounded-full flex items-center justify-center hover:bg-white hover:text-black transition">
                            <img src="{{ asset('image/icon/youtube.svg') }}" alt="YouTube">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- COPYRIGHT -->
        <div class="border-t border-[#C0C0C0] text-center py-5 text-base text-gray-200 px-[16px] md:px-12">
            <div class="max-w-7xl mx-auto">© 2025 LSP SMK Negeri 1 Purwosari. All rights reserved.</div>
        </div>
</footer>
