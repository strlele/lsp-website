<?php

namespace App\Http\Controllers;

use App\Models\Subkategori;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SubKategoriController extends Controller
{
    public function index()
    {
        $subkategoris = Subkategori::with('kategori')->orderBy('nama_subkategori')->paginate(10);
        return view('admin.subkategori.index', compact('subkategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.subkategori.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_subkategori' => 'required|string|max:255',
        ]);

        // enforce unique per kategori
        if (Subkategori::where('kategori_id', $validated['kategori_id'])->where('nama_subkategori', $validated['nama_subkategori'])->exists()) {
            return back()->withErrors(['nama_subkategori' => 'Subkategori sudah ada pada kategori tersebut'])->withInput();
        }

        Subkategori::create($validated);
        return redirect()->route('admin.subkategori.index')->with('success', 'Subkategori berhasil dibuat');
    }

    public function edit(Subkategori $subkategori)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.subkategori.edit', compact('subkategori', 'kategoris'));
    }

    public function update(Request $request, Subkategori $subkategori)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_subkategori' => 'required|string|max:255',
        ]);

        // enforce unique per kategori (exclude current)
        if (Subkategori::where('kategori_id', $validated['kategori_id'])
            ->where('nama_subkategori', $validated['nama_subkategori'])
            ->where('id', '!=', $subkategori->id)
            ->exists()) {
            return back()->withErrors(['nama_subkategori' => 'Subkategori sudah ada pada kategori tersebut'])->withInput();
        }

        $subkategori->update($validated);
        return redirect()->route('admin.subkategori.index')->with('success', 'Subkategori berhasil diperbarui');
    }

    public function destroy(Subkategori $subkategori)
    {
        $subkategori->delete();
        return redirect()->route('admin.subkategori.index')->with('success', 'Subkategori berhasil dihapus');
    }

    // API endpoint: ambil subkategori berdasarkan kategori
    public function getByKategori(Kategori $kategori)
    {
        $items = Subkategori::where('kategori_id', $kategori->id)
            ->orderBy('nama_subkategori')
            ->get(['id', 'nama_subkategori']);
        return response()->json($items);
    }
}
