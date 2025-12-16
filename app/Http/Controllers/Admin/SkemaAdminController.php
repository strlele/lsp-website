<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Skema::query()->withCount('kompetensis');

        if ($search = $request->string('q')->trim()) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_skema', 'like', "%{$search}%")
                  ->orWhere('nama_skema', 'like', "%{$search}%")
                  ->orWhere('unit', 'like', "%{$search}%");
            });
        }

        $skemas = $query->latest('id')->paginate(12);
        $skemas->appends($request->query());
        return view('admin.skema.index', compact('skemas'));
    }

    public function create()
    {
        return view('admin.skema.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_skema' => ['required', 'string', 'max:191', 'unique:skemas,kode_skema'],
            'nama_skema' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:255'],
        ]);

        Skema::create($validated);
        return redirect()->route('admin.skema.index')->with('success', 'Skema berhasil ditambahkan.');
    }

    public function show(Skema $skema)
    {
        $skema->load('kompetensis');
        return view('admin.skema.show', compact('skema'));
    }

    public function edit(Skema $skema)
    {
        return view('admin.skema.edit', compact('skema'));
    }

    public function update(Request $request, Skema $skema)
    {
        $validated = $request->validate([
            'kode_skema' => ['required', 'string', 'max:191', 'unique:skemas,kode_skema,' . $skema->id],
            'nama_skema' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:255'],
        ]);

        $skema->update($validated);
        return redirect()->route('admin.skema.index')->with('success', 'Skema berhasil diupdate.');
    }

    public function destroy(Skema $skema)
    {
        $skema->delete();
        return redirect()->route('admin.skema.index')->with('success', 'Skema berhasil dihapus.');
    }
}
