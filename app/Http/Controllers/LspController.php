<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slideshow;
use App\Models\Berita;

class LspController extends Controller
{
    public function index()
    {
        $slides = Slideshow::take(3)->get();
        $latestBerita = Berita::where('status', 'publish')->orderByDesc('tanggal')->orderByDesc('id')->first();
        $beritasLatest = Berita::where('status', 'publish')
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->take(7)
            ->get();
        $beritasList = Berita::where('status', 'publish')
            ->when($latestBerita, fn($q) => $q->where('id', '!=', $latestBerita->id))
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->take(6)
            ->get();
        return view('index', compact('slides', 'latestBerita', 'beritasLatest', 'beritasList'));
    }
}
