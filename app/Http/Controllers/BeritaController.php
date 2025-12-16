<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'nullable|string|max:255|unique:beritas,slug',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'sumber' => 'required|string|max:255',
            'gambar' => 'required|image|max:4096',
            'tanggal' => 'required|date|before_or_equal:today',
            'status' => 'required|in:draft,publish',
        ]);

        // Generate slug if empty
        if (empty($data['slug'])) {
            $base = Str::slug($data['judul']);
            $slug = $base;
            $i = 1;
            while (Berita::where('slug', $slug)->exists()) {
                $slug = $base.'-'.$i++;
            }
            $data['slug'] = $slug;
        }

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('beritas', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        return view('admin.berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        $data = $request->validate([
            'slug' => 'nullable|string|max:255|unique:beritas,slug,'.$berita->id,
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'sumber' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:4096',
            'tanggal' => 'required|date|before_or_equal:today',
            'status' => 'required|in:draft,publish',
        ]);

        if (empty($data['slug'])) {
            $base = Str::slug($data['judul']);
            $slug = $base;
            $i = 1;
            while (Berita::where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
                $slug = $base.'-'.$i++;
            }
            $data['slug'] = $slug;
        }

        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('beritas', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
