@extends('layouts.vers2')

@section('no-navbar')@endsection
@section('no-footer')@endsection

@section('content')
<div class="mb-12">

  <div class="mx-[16px] md:mx-[45px] lg:mx-[80px] md:mt-[78px] md:mb-[88px]">
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
      $canGoStep3 = session()->has('pendaftaran') && (
        session('pendaftaran.dok_ktp_kartu_pelajar_path') ||
        session('pendaftaran.dok_rapor_path') ||
        session('pendaftaran.dok_kartu_keluarga_path')
      );
    @endphp
    <div class="flex flex-col md:flex-row justify-center items-start md:items-center gap-[24px]">
       <a href="{{ route('pendaftaran.step1') }}" class="flex items-center gap-[16px] mb-[44px] sm:mb-0 opacity-60">
        <div class="w-[40px] h-[40px] rounded-full bg-[#FFF8E0] flex items-center justify-center text-[#FFC300] text-base font-bold">1</div>
        <p class="text-base font-semibold text-black">Profil Peserta</p>
      </a>

      <div class="hidden md:block w-[150px] h-[1px] bg-[#CCCCCC]"></div>

      <div class="flex items-center gap-[16px]">
        <div class="w-[40px] h-[40px] rounded-full bg-[#FFC300] flex items-center justify-center text-white text-base font-bold">2</div>
        <p class="text-base font-semibold text-black">Dokumen Portofolio</p>
      </div>

      <div class="hidden md:block w-[150px] h-[1px] bg-[#CCCCCC]"></div>

      @if($canGoStep3)
        <a href="{{ route('pendaftaran.step3') }}" class="flex items-center gap-[16px] mb-[44px] sm:mb-0 opacity-60">
          <div class="w-[40px] h-[40px] rounded-full bg-[#FFF8E0] flex items-center justify-center text-[#FFC300] text-base font-bold">3</div>
          <p class="text-base font-semibold text-black">Asesmen Mandiri</p>
        </a>
      @else
        <div class="flex items-center gap-[16px] mb-[44px] sm:mb-0 opacity-60 cursor-not-allowed" aria-disabled="true" title="Unggah minimal 1 dokumen untuk lanjut">
          <div class="w-[40px] h-[40px] rounded-full bg-[#FFF8E0] flex items-center justify-center text-[#FFC300] text-base font-bold">3</div>
          <p class="text-base font-semibold text-black">Asesmen Mandiri</p>
        </div>
      @endif
    </div>
  </div>

    <div class="mx-[16px] md:mx-[45px] lg:mx-[80px] bg-white rounded-[20px] border border-[#C0C0C0] shadow-sm px-[20px] md:px-[30px] lg:px-[40px] py-[28px] md:py-[38px] lg:py-[48px]">
        <h3 class="text-lg font-semibold">Data Siswa / Calon Peserta</h3>
        <p class="text-sm text-gray-600 mb-6">Silakan isi data diri dengan lengkap dan benar.</p>

        <form action="{{ route('pendaftaran.step2.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="rounded-xl border border-gray-200 p-4">
                    <div class="flex items-start justify-between">
                        <label class="block text-sm font-medium">Unggah Foto KTP/Kartu Pelajar</label>
                        <span class="text-[#FF5A5A]">*</span>
                    </div>
                    <div class="mt-3">
                        <div class="w-full h-[220px] rounded-lg border-2 border-dashed border-gray-200 bg-white relative overflow-hidden p-2 select-none">
                            <img id="preview-ktp" alt="preview ktp"
                                 src="{{ isset($data->dok_ktp_kartu_pelajar) ? asset('storage/'.$data->dok_ktp_kartu_pelajar) : '' }}"
                                 class="absolute inset-0 w-full h-full object-contain p-4 {{ isset($data->dok_ktp_kartu_pelajar) ? '' : 'hidden' }}" />
                            <div id="ph-ktp" class="absolute inset-0 flex flex-col items-center justify-center text-center px-6 {{ isset($data->dok_ktp_kartu_pelajar) ? 'hidden' : '' }}">
                                <p class="text-sm font-medium">Unggah gambar, atau <span>telusuri</span></p>
                                <p class="text-[12px] text-gray-500 mt-2">Ukuran max 2MB. Format: PNG/JPG/JPEG.</p>
                            </div>
                        </div>
                        <input id="file-ktp" type="file" name="dok_ktp_kartu_pelajar" accept="image/*" class="hidden" data-preview="#preview-ktp" data-placeholder="#ph-ktp" />
                        @error('dok_ktp_kartu_pelajar')<div class="text-sm text-red-600 mt-2">{{ $message }}</div>@enderror
                        <button type="button" data-target="#file-ktp" class="mt-4 w-full bg-black text-white py-2 rounded-lg">Tambahkan Gambar</button>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 p-4">
                    <div class="flex items-start justify-between">
                        <label class="block text-sm font-medium">Unggah Report Siswa</label>
                        <span class="text-[#FF5A5A]">*</span>
                    </div>
                    <div class="mt-3">
                        <div class="w-full h-[220px] rounded-lg border-2 border-dashed border-gray-200 bg-white relative overflow-hidden p-2 select-none">
                            <img id="preview-rapor" alt="preview rapor"
                                 src="{{ isset($data->dok_rapor) ? asset('storage/'.$data->dok_rapor) : '' }}"
                                 class="absolute inset-0 w-full h-full object-contain p-4 {{ isset($data->dok_rapor) ? '' : 'hidden' }}" />
                            <div id="ph-rapor" class="absolute inset-0 flex flex-col items-center justify-center text-center px-6 {{ isset($data->dok_rapor) ? 'hidden' : '' }}">
                                <p class="text-sm font-medium">Unggah gambar, atau <span>telusuri</span></p>
                                <p class="text-[12px] text-gray-500 mt-2">Ukuran max 2MB. Format: PNG/JPG/JPEG.</p>
                            </div>
                        </div>
                        <input id="file-rapor" type="file" name="dok_rapor" accept="image/*" class="hidden" data-preview="#preview-rapor" data-placeholder="#ph-rapor" />
                        @error('dok_rapor')<div class="text-sm text-red-600 mt-2">{{ $message }}</div>@enderror
                        <button type="button" data-target="#file-rapor" class="mt-4 w-full bg-black text-white py-2 rounded-lg">Tambahkan Gambar</button>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 p-4 md:col-span-2 md:max-w-[520px]">
                    <div class="flex items-start justify-between">
                        <label class="block text-sm font-medium">Unggah Foto Kartu Keluarga</label>
                        <span class="text-[#FF5A5A]">*</span>
                    </div>
                    <div class="mt-3">
                        <div class="w-full h-[220px] rounded-lg border-2 border-dashed border-gray-200 bg-white relative overflow-hidden p-2 select-none">
                            <img id="preview-kk" alt="preview kk"
                                 src="{{ isset($data->dok_kartu_keluarga) ? asset('storage/'.$data->dok_kartu_keluarga) : '' }}"
                                 class="absolute inset-0 w-full h-full object-contain p-4 {{ isset($data->dok_kartu_keluarga) ? '' : 'hidden' }}" />
                            <div id="ph-kk" class="absolute inset-0 flex flex-col items-center justify-center text-center px-6 {{ isset($data->dok_kartu_keluarga) ? 'hidden' : '' }}">
                                <p class="text-sm font-medium">Unggah gambar, atau <span>telusuri</span></p>
                                <p class="text-[12px] text-gray-500 mt-2">Ukuran max 2MB. Format: PNG/JPG/JPEG.</p>
                            </div>
                        </div>
                        <input id="file-kk" type="file" name="dok_kartu_keluarga" accept="image/*" class="hidden" data-preview="#preview-kk" data-placeholder="#ph-kk" />
                        @error('dok_kartu_keluarga')<div class="text-sm text-red-600 mt-2">{{ $message }}</div>@enderror
                        <button type="button" data-target="#file-kk" class="mt-4 w-full bg-black text-white py-2 rounded-lg">Tambahkan Gambar</button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-10">
                <a href="{{ route('pendaftaran.step1') }}" class="px-6 py-2 border rounded-lg">Kembali</a>
                <button class="px-6 py-2 bg-black text-white rounded-lg">Selanjutnya</button>
            </div>
        </form>
    </div>
</div>
<script>
  document.addEventListener('click', function(e){
    var btn = e.target.closest('[data-target]');
    if(!btn) return;
    var sel = btn.getAttribute('data-target');
    var input = document.querySelector(sel);
    if(input){ input.click(); }
  });
  document.addEventListener('change', function(e){
    var input = e.target;
    if(input && input.matches('input[type="file"][data-preview]') && input.files && input.files[0]){
      var previewSel = input.getAttribute('data-preview');
      var placeholderSel = input.getAttribute('data-placeholder');
      var img = document.querySelector(previewSel);
      var ph = document.querySelector(placeholderSel);
      var file = input.files[0];
      var reader = new FileReader();
      reader.onload = function(ev){
        if(img){ img.src = ev.target.result; img.classList.remove('hidden'); }
        if(ph){ ph.classList.add('hidden'); }
      };
      reader.readAsDataURL(file);
    }
  });
</script>
@endsection

