@extends('layouts.app')

@section('no-navbar')@endsection
@section('no-footer')@endsection

@section('title', 'Login | LSP SMKN 1 Purwosari')

@section('content')
<div class="mb-12">
    <!-- HEADER TITLE + STEPPER -->
    <div class="mx-[16px] md:mx-[45px] lg:mx-[80px] md:mt-[78px] md:mb-[80px]">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center gap-4 px-3 py-3 bg-[#F6F7F4] rounded-[16px] mb-[40px]">
            <img src="{{ asset('image/icon/arrow-left.svg') }}" class="w-6 h-6" />
            <span class="text-[14px] font-medium text-[#022512]">Kembali</span>
        </a>


        <p class="text-center text-base text-[#C0C0C0] leading-[40px] mb-2">Lembaga Sertifikasi Profesi</p>

        <h1 class="text-[28px] leading-[40px] font-bold text-center mb-[44px] md:mb-[64px]">
            Formulir Resmi Calon Peserta Uji Kompetensi
        </h1>

        <!-- Stepper -->
        @php
            $canGoStep2 = session()->has('pendaftaran') && session('pendaftaran.skema_id') && session('pendaftaran.nama_lengkap');
        @endphp
        <div class="flex flex-col md:flex-row justify-center items-start md:items-center gap-[24px]">
            <div class="flex items-center gap-[16px]">
                <div
                    class="w-[40px] h-[40px] rounded-full bg-[#FFC300] flex items-center justify-center text-white text-base font-bold">
                    1</div>
                <p class="text-base font-semibold text-black">Profil Peserta</p>
            </div>

            <div class="hidden md:block w-[150px] h-[1px] bg-[#CCCCCC]"></div>

            @if($canGoStep2)
                <a href="{{ route('pendaftaran.step2') }}" class="flex items-center gap-[16px] opacity-60">
                    <div class="w-[40px] h-[40px] rounded-full bg-[#FFF8E0] flex items-center justify-center text-[#FFC300] text-base font-bold">2</div>
                    <p class="text-base font-semibold text-black">Dokumen Portofolio</p>
                </a>
            @else
                <div class="flex items-center gap-[16px] opacity-60 cursor-not-allowed" aria-disabled="true" title="Lengkapi data terlebih dahulu">
                    <div class="w-[40px] h-[40px] rounded-full bg-[#FFF8E0] flex items-center justify-center text-[#FFC300] text-base font-bold">2</div>
                    <p class="text-base font-semibold text-black">Dokumen Portofolio</p>
                </div>
            @endif

            <div class="hidden md:block w-[150px] h-[1px] bg-[#CCCCCC]"></div>

            <div class="flex items-center gap-[16px] mb-[44px] sm:mb-0 opacity-60">
                <div
                    class="w-[40px] h-[40px] rounded-full bg-[#FFF8E0] flex items-center justify-center text-[#FFC300] text-base font-bold">
                    3</div>
                <p class="text-base font-semibold text-black">Asesmen Mandiri</p>
            </div>
        </div>
    </div>

    <!-- CARD FORM -->
    <div class="mx-[16px] md:mx-[45px] lg:mx-[80px] bg-white rounded-[20px] border border-[#C0C0C0] shadow-sm px-[20px] md:px-[30px] lg:px-[40px] py-[28px] md:py-[38px] lg:py-[48px]">

        <h2 class="text-[26px] md:text-[28px] font-bold mb-4">Data Siswa / Calon Peserta</h2>
        <p class="text-base text-black mb-[43px] md:mb-[53px]">Silakan isi data diri dengan lengkap dan benar.</p>

        <form action="{{ route('pendaftaran.step1.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">

                <!-- LEFT SIDE -->
                <div class="flex flex-col gap-[40px]">

                    {{-- Skema --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">
                            Pilih Skema <span class="text-red-500">*</span>
                        </label>

                        <select name="skema_id" class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3">

                            <option value="" disabled {{ old('skema_id', $data['skema_id'] ?? request('skema')) ? '' : 'selected' }}>
                                Pilih skema
                            </option>

                            @foreach($skemas as $s)
                                <option value="{{ $s->id }}" {{ (string) old('skema_id', $data['skema_id'] ?? request('skema')) === (string) $s->id ? 'selected' : '' }}>
                                    {{ $s->nama_skema }} ({{ optional($s->kategori)->nama_kategori ?? '-' }})
                                </option>
                            @endforeach
                        </select>

                        @error('skema_id')
                            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NIS --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">NIS <span class="text-red-500">*</span></label>
                        <input name="nis" value="{{ old('nis', $data['nis'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3"
                            placeholder="Masukkan Nomor Identitas Siswa">
                        @error('nis') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                    </div>

                    {{-- NIK --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">NIK <span class="text-red-500">*</span></label>
                        <input name="nik" value="{{ old('nik', $data['nik'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3"
                            placeholder="Masukkan Nomor Induk Kependudukan">
                    </div>

                    {{-- Nama lengkap --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Nama Lengkap <span
                                class="text-red-500">*</span></label>
                        <input name="nama_lengkap" value="{{ old('nama_lengkap', $data['nama_lengkap'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3"
                            placeholder="Masukkan Nama Lengkap">
                    </div>

                    {{-- Nama sekolah --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Nama Sekolah <span
                                class="text-red-500">*</span></label>
                        <input name="nama_sekolah" value="{{ old('nama_sekolah', $data['nama_sekolah'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3"
                            placeholder="Masukkan Nama Sekolah">
                    </div>

                    {{-- Jurusan --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Jurusan <span class="text-red-500">*</span></label>
                        <input name="jurusan" value="{{ old('jurusan', $data['jurusan'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3" placeholder="Jurusan">
                    </div>

                    {{-- Kelas --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Kelas <span class="text-red-500">*</span></label>
                        <input name="kelas" value="{{ old('kelas', $data['kelas'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3" placeholder="Kelas">
                    </div>

                    {{-- Jadwal uji --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Jadwal Uji Kompetensi <span
                                class="text-red-500">*</span></label>
                        <input name="jadwal_uji_kompetensi" value="{{ old('jadwal_uji_kompetensi', $data['jadwal_uji_kompetensi'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3"
                            placeholder="Jadwal Uji Kompetensi">
                    </div>

                    {{-- Tempat lahir --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Tempat Lahir <span
                                class="text-red-500">*</span></label>
                        <input name="tempat_lahir" value="{{ old('tempat_lahir', $data['tempat_lahir'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3"
                            placeholder="Masukkan Tempat Lahir">
                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="flex flex-col gap-[40px]">

                    {{-- Tanggal lahir --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Tanggal Lahir <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $data['tanggal_lahir'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3">
                    </div>

                    {{-- Jenis kelamin --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Jenis Kelamin <span
                                class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin', $data['jenis_kelamin'] ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $data['jenis_kelamin'] ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- Provinsi --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Provinsi <span class="text-red-500">*</span></label>
                        <select name="provinsi" id="provinsi" data-old="{{ old('provinsi', $data['provinsi'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3">
                        </select>
                    </div>

                    {{-- Kabupaten --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Kabupaten <span class="text-red-500">*</span></label>
                        <select name="kabupaten" id="kabupaten" data-old="{{ old('kabupaten', $data['kabupaten'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3">
                        </select>
                    </div>

                    {{-- Kecamatan --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Kecamatan <span class="text-red-500">*</span></label>
                        <select name="kecamatan" id="kecamatan" data-old="{{ old('kecamatan', $data['kecamatan'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3">
                        </select>
                    </div>

                    {{-- Alamat --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Alamat <span class="text-red-500">*</span></label>
                        <textarea name="alamat" class="w-full h-24 bg-[#F5F6FA] border border-gray-300 rounded-lg p-3"
                            placeholder="Masukkan Alamat Lengkap">{{ old('alamat', $data['alamat'] ?? '') }}</textarea>
                    </div>

                    {{-- No telp --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">No Telp <span class="text-red-500">*</span></label>
                        <input name="no_telp" value="{{ old('no_telp', $data['no_telp'] ?? '') }}"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3"
                            placeholder="Masukkan Nomor Telepon">
                    </div>

                    {{-- Email --}}
                    <div class="relative">
                        <label class="block text-sm font-medium mb-2">Email <span class="text-red-500">*</span></label>
                        <input name="email" value="{{ old('email', $data['email'] ?? '') }}" type="email"
                            class="w-full bg-[#F5F6FA] border border-gray-300 rounded-lg p-3" placeholder="Masukkan Email">
                    </div>

                </div>

            </div>

            <div class="flex justify-end gap-4 mt-10">
                <a href="{{ route('home') }}" class="px-6 py-2 border rounded-lg">Batal</a>
                <button class="px-6 py-2 bg-black text-white rounded-lg">Selanjutnya</button>
            </div>
        </form>
    </div>
</div>

        {{-- API wilayah Indonesia --}}
        <script>
            (function() {
                const provinsiSelect = document.getElementById('provinsi');
                const kabupatenSelect = document.getElementById('kabupaten');
                const kecamatanSelect = document.getElementById('kecamatan');

                const oldProv = provinsiSelect?.getAttribute('data-old') || '';
                const oldKab = kabupatenSelect?.getAttribute('data-old') || '';
                const oldKec = kecamatanSelect?.getAttribute('data-old') || '';

                const setOptions = (el, options, placeholder = 'Pilih') => {
                    if (!el) return;
                    el.innerHTML = '';
                    const ph = document.createElement('option');
                    ph.value = '';
                    ph.textContent = placeholder;
                    el.appendChild(ph);
                    options.forEach(({ id, name, selected }) => {
                        const opt = document.createElement('option');
                        opt.value = id;
                        opt.textContent = name;
                        if (selected) opt.selected = true;
                        el.appendChild(opt);
                    });
                };

                const onError = (el, message) => {
                    if (!el) return;
                    setOptions(el, []);
                    const opt = document.createElement('option');
                    opt.value = '';
                    opt.textContent = message;
                    el.appendChild(opt);
                    el.disabled = false;
                };

                async function loadProvinsi() {
                    try {
                        provinsiSelect.disabled = true;
                        setOptions(provinsiSelect, [], 'Memuat provinsi...');
                        const res = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                        const data = await res.json();
                        const options = data.map(p => ({ id: String(p.id), name: p.name, selected: String(p.id) === String(oldProv) }));
                        setOptions(provinsiSelect, options, 'Pilih Provinsi');
                        provinsiSelect.disabled = false;
                        if (oldProv) {
                            await loadKabupaten(oldProv);
                            if (oldKab) {
                                await loadKecamatan(oldKab);
                            }
                        }
                    } catch (e) {
                        onError(provinsiSelect, 'Gagal memuat provinsi');
                    }
                }

                async function loadKabupaten(provId) {
                    try {
                        kabupatenSelect.disabled = true;
                        setOptions(kabupatenSelect, [], 'Memuat kabupaten...');
                        setOptions(kecamatanSelect, [], 'Pilih Kecamatan');
                        const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`);
                        const data = await res.json();
                        const options = data.map(k => ({ id: String(k.id), name: k.name, selected: String(k.id) === String(oldKab) }));
                        setOptions(kabupatenSelect, options, 'Pilih Kabupaten');
                        kabupatenSelect.disabled = false;
                    } catch (e) {
                        onError(kabupatenSelect, 'Gagal memuat kabupaten');
                    }
                }

                async function loadKecamatan(kabId) {
                    try {
                        kecamatanSelect.disabled = true;
                        setOptions(kecamatanSelect, [], 'Memuat kecamatan...');
                        const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`);
                        const data = await res.json();
                        const options = data.map(c => ({ id: String(c.id), name: c.name, selected: String(c.id) === String(oldKec) }));
                        setOptions(kecamatanSelect, options, 'Pilih Kecamatan');
                        kecamatanSelect.disabled = false;
                    } catch (e) {
                        onError(kecamatanSelect, 'Gagal memuat kecamatan');
                    }
                }

                provinsiSelect.addEventListener('change', async () => {
                    const id = provinsiSelect.value;
                    if (!id) {
                        setOptions(kabupatenSelect, [], 'Pilih Kabupaten');
                        setOptions(kecamatanSelect, [], 'Pilih Kecamatan');
                        return;
                    }
                    await loadKabupaten(id);
                });

                kabupatenSelect.addEventListener('change', async () => {
                    const id = kabupatenSelect.value;
                    if (!id) {
                        setOptions(kecamatanSelect, [], 'Pilih Kecamatan');
                        return;
                    }
                    await loadKecamatan(id);
                });

                loadProvinsi();
            })();
        </script>
@endsection
