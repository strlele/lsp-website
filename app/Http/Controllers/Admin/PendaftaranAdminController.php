<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranAdminController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q'));
        $query = Pendaftaran::with(['skema.kategori'])->latest('id');
        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('nama_lengkap', 'like', "%{$q}%")
                  ->orWhere('nis', 'like', "%{$q}%")
                  ->orWhere('nik', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%");
            });
        }
        $pendaftarans = $query->paginate(15)->appends($request->query());
        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['skema.kategori', 'asesmens.kompetensi']);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }
}
