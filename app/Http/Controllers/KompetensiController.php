<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use App\Models\Skema;
use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kompetensis = Kompetensi::with('skema')->get();
        $view = request()->routeIs('admin.*') ? 'admin.kompetensi.index' : 'kompetensi.index';
        return view($view, compact('kompetensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skemas = Skema::all();
        $view = request()->routeIs('admin.*') ? 'admin.kompetensi.create' : 'kompetensi.create';
        return view($view, compact('skemas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'skema_id' => 'required|exists:skemas,id',
            'kode_unit' => 'required',
            'unit_kompetensi' => 'required',
        ]);

        Kompetensi::create($request->only(['skema_id','kode_unit','unit_kompetensi']));
        $target = request()->routeIs('admin.*') ? 'admin.kompetensi.index' : 'kompetensi.index';
        return redirect()->route($target)->with('success', 'Kompetensi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kompetensi $kompetensi)
    {
        $kompetensi->load('skema');
        $view = request()->routeIs('admin.*') ? 'admin.kompetensi.show' : 'kompetensi.show';
        return view($view, compact('kompetensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kompetensi $kompetensi)
    {
        $kompetensi->load('skema');
        $skemas = Skema::all();
        $view = request()->routeIs('admin.*') ? 'admin.kompetensi.edit' : 'kompetensi.edit';
        return view($view, compact('kompetensi','skemas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kompetensi $kompetensi)
    {
        $request->validate([
            'skema_id' => 'required|exists:skemas,id',
            'kode_unit' => 'required',
            'unit_kompetensi' => 'required',
        ]);

        $kompetensi->update($request->only(['skema_id','kode_unit','unit_kompetensi']));
        $target = request()->routeIs('admin.*') ? 'admin.kompetensi.index' : 'kompetensi.index';
        return redirect()->route($target)->with('success', 'Kompetensi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kompetensi $kompetensi)
    {
        $kompetensi->delete();
        $target = request()->routeIs('admin.*') ? 'admin.kompetensi.index' : 'kompetensi.index';
        return redirect()->route($target)->with('success', 'Kompetensi berhasil dihapus');
    }
}
