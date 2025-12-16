@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto lg:px-[40px] md:px-[24px] px-[16px] py-8">
  <div class="mb-6">
    <h1 class="text-2xl font-semibold">Tambah Skema</h1>
    <p class="text-sm text-gray-600">Isi form berikut untuk menambah skema baru.</p>
  </div>

  @if ($errors->any())
    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 text-rose-800 px-4 py-3">
      <ul class="list-disc list-inside text-sm">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.skema.store') }}" method="POST" class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-5">
    @csrf

    <div>
      <label class="block text-sm font-medium text-gray-700">Kode Skema</label>
      <input type="text" name="kode_skema" value="{{ old('kode_skema') }}" class="mt-1 w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500" placeholder="contoh: SKM-001">
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Nama Skema</label>
      <input type="text" name="nama_skema" value="{{ old('nama_skema') }}" class="mt-1 w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500" placeholder="contoh: Pemrogram Mobile Pratama">
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Kategori</label>
      <select name="kategori_id" class="mt-1 w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500" required>
        <option value="" disabled {{ old('kategori_id') ? '' : 'selected' }}>Pilih Kategori</option>
        @foreach($kategoris as $k)
          <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
        @endforeach
      </select>
      @error('kategori_id')
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Subkategori (opsional)</label>
      <select name="subkategori_id" id="subkategori_id" class="mt-1 w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
        <option value="">— Pilih Subkategori —</option>
      </select>
      @error('subkategori_id')
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
      @enderror
      <p class="text-xs text-gray-500 mt-1">Subkategori akan muncul setelah memilih kategori.</p>
    </div>

    <div class="flex items-center justify-end gap-2">
      <a href="{{ route('admin.skema.index') }}" class="inline-flex px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50">Batal</a>
      <button type="submit" class="inline-flex px-4 py-2 rounded-lg bg-teal-600 text-white hover:bg-teal-700">Simpan</button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
  (function(){
    const kategoriSelect = document.querySelector('select[name="kategori_id"]');
    const subSelect = document.getElementById('subkategori_id');

    async function loadSubkategori(kategoriId, preselected) {
      subSelect.innerHTML = '<option value="">— Pilih Subkategori —</option>';
      if (!kategoriId) return;
      try {
        const res = await fetch(`/api/kategoris/${kategoriId}/subkategoris`);
        const data = await res.json();
        data.forEach(it => {
          const opt = document.createElement('option');
          opt.value = it.id;
          opt.textContent = it.nama_subkategori;
          if (preselected && String(preselected) === String(it.id)) opt.selected = true;
          subSelect.appendChild(opt);
        });
      } catch(e) { /* ignore */ }
    }

    kategoriSelect?.addEventListener('change', (e) => {
      loadSubkategori(e.target.value, null);
    });

    // initial
    const initialKategori = kategoriSelect?.value;
    const initialSub = '{{ old('subkategori_id') }}';
    if (initialKategori) loadSubkategori(initialKategori, initialSub);
  })();
</script>
@endpush
