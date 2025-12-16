@extends('layouts.admin')

@section('title', 'Dashboard | LSP CMS')
@section('page_title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl shadow border p-5">
        <div class="text-sm text-gray-500">Total Berita</div>
        <div class="mt-2 text-3xl font-semibold">{{ \App\Models\Berita::count() }}</div>
    </div>
    <div class="bg-white rounded-xl shadow border p-5">
        <div class="text-sm text-gray-500">Total Slideshow</div>
        <div class="mt-2 text-3xl font-semibold">{{ \App\Models\Slideshow::count() }}</div>
    </div>
    <div class="bg-white rounded-xl shadow border p-5">
        <div class="text-sm text-gray-500">Terakhir Login</div>
        <div class="mt-2 text-3xl font-semibold">{{ optional(auth()->user())->username ?? '-' }}</div>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow border p-5">
        <div class="font-semibold mb-4">Ringkasan Berita</div>
        <p class="text-gray-600 text-sm">Kelola berita terbaru Anda dari menu di samping.</p>
        <a href="{{ route('admin.berita.index') }}" class="inline-block mt-4 px-4 py-2 bg-gray-900 text-white rounded-lg">Kelola Berita</a>
    </div>
    <div class="bg-white rounded-xl shadow border p-5">
        <div class="font-semibold mb-4">Ringkasan Slideshow</div>
        <p class="text-gray-600 text-sm">Atur gambar dan teks slideshow beranda.</p>
        <a href="{{ route('admin.slideshow.index') }}" class="inline-block mt-4 px-4 py-2 bg-gray-900 text-white rounded-lg">Kelola Slideshow</a>
    </div>
</div>
@endsection
