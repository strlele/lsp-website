<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua kategori beserta subkategori untuk dropdown per kategori
        $kategoris = Kategori::with('subkategoris')->orderBy('nama_kategori')->get();
        $query = Skema::with(['kompetensis', 'kategori', 'subkategori'])->withCount('kompetensis');

        if ($q = trim((string) $request->get('q'))) {
            $query->where(function ($sub) use ($q) {
                $sub->where('kode_skema', 'like', "%{$q}%")
                    ->orWhere('nama_skema', 'like', "%{$q}%");
            });
        }

        if ($subId = $request->get('subkategori')) {
            $query->where('subkategori_id', $subId);
        } elseif ($kategoriId = $request->get('kategori')) {
            $query->where('kategori_id', $kategoriId);
        }

        $subkategoris = null;
        if ($request->filled('kategori')) {
            $selectedForSubs = Kategori::with('subkategoris')->find($request->get('kategori'));
            if ($selectedForSubs) {
                $subkategoris = $selectedForSubs->subkategoris()->orderBy('nama_subkategori')->get(['id','nama_subkategori']);
            }
        }

        $skemas = $query->latest('id')->paginate(12)->appends($request->query());
        return view('skema.index', compact('skemas', 'kategoris', 'subkategoris'));
    }
    public function adminIndex()
    {
        $skemas = Skema::with(['kompetensis', 'kategori', 'subkategori'])->withCount('kompetensis')->get();
        return view('admin.skema.index', compact('skemas'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skemas = Skema::all();
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.skema.create', compact('skemas', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_skema' => 'required',
            'nama_skema' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'subkategori_id' => 'nullable|exists:subkategoris,id',
        ]);

        if ($request->filled('subkategori_id')) {
            $ok = \App\Models\Subkategori::where('id', $request->input('subkategori_id'))
                ->where('kategori_id', $validated['kategori_id'])
                ->exists();
            if (!$ok) {
                return back()->withErrors(['subkategori_id' => 'Subkategori tidak sesuai dengan kategori yang dipilih'])->withInput();
            }
        }

        $skema = new Skema();
        $skema->kode_skema = $validated['kode_skema'];
        $skema->nama_skema = $validated['nama_skema'];
        $skema->kategori_id = $validated['kategori_id'];
        $skema->subkategori_id = $request->input('subkategori_id');
        $skema->save();
        $target = request()->routeIs('admin.*') ? 'admin.skema.index' : 'skema.index';
        return redirect()->route($target)->with('success', 'Skema berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skema $skema)
    {
        $skema->load('kompetensis');
        $view = request()->routeIs('admin.*') ? 'admin.skema.show' : 'skema.show';
        return view($view, compact('skema'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skema $skema)
    {
        $skema = Skema::findOrFail($skema->id);
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.skema.edit', compact('skema', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skema $skema)
    {
        $validated = $request->validate([
            'kode_skema' => 'required',
            'nama_skema' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'subkategori_id' => 'nullable|exists:subkategoris,id',
        ]);

        if ($request->filled('subkategori_id')) {
            $ok = \App\Models\Subkategori::where('id', $request->input('subkategori_id'))
                ->where('kategori_id', $validated['kategori_id'])
                ->exists();
            if (!$ok) {
                return back()->withErrors(['subkategori_id' => 'Subkategori tidak sesuai dengan kategori yang dipilih'])->withInput();
            }
        }

        $skema->kode_skema = $validated['kode_skema'];
        $skema->nama_skema = $validated['nama_skema'];
        $skema->kategori_id = $validated['kategori_id'];
        $skema->subkategori_id = $request->input('subkategori_id');
        $skema->save();
        $target = request()->routeIs('admin.*') ? 'admin.skema.index' : 'skema.index';
        return redirect()->route($target)->with('success', 'Skema berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skema $skema)
    {
        $skema->delete();
        $target = request()->routeIs('admin.*') ? 'admin.skema.index' : 'skema.index';
        return redirect()->route($target)->with('success', 'Skema berhasil dihapus');
    }
}
