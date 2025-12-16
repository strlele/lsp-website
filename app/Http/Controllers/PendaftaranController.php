<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use App\Models\Pendaftaran;
use App\Models\PendaftaranAsesmen;
use App\Models\Skema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function step1()
    {
        $skemas = Skema::with('kategori')->orderBy('nama_skema')->get();
        $data = session('pendaftaran', []);
        return view('pendaftaran.step1', compact('skemas', 'data'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'skema_id' => 'required|exists:skemas,id',
            'nis' => 'nullable|string|max:191',
            'nik' => 'nullable|string|max:191',
            'nama_lengkap' => 'required|string|max:255',
            'nama_sekolah' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'kelas' => 'nullable|string|max:255',
            'jadwal_uji_kompetensi' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'provinsi' => 'nullable|string|max:191',
            'kabupaten' => 'nullable|string|max:191',
            'kecamatan' => 'nullable|string|max:191',
            'alamat' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:50',
            'email' => 'nullable|email',
        ]);

        $data = session('pendaftaran', []);
        $data = array_merge($data, $validated);
        session(['pendaftaran' => $data]);
        return redirect()->route('pendaftaran.step2');
    }

    public function step2()
    {
        $data = session('pendaftaran');
        if (!$data) { return redirect()->route('pendaftaran.step1'); }

        // Normalize to object so Blade property access works
        if (is_array($data)) {
            $obj = (object) $data;
            // Map stored paths to preview-friendly properties expected by the Blade
            if (!empty($data['dok_ktp_kartu_pelajar_path'])) {
                $obj->dok_ktp_kartu_pelajar = $data['dok_ktp_kartu_pelajar_path'];
            }
            if (!empty($data['dok_rapor_path'])) {
                $obj->dok_rapor = $data['dok_rapor_path'];
            }
            if (!empty($data['dok_kartu_keluarga_path'])) {
                $obj->dok_kartu_keluarga = $data['dok_kartu_keluarga_path'];
            }
            $data = $obj;
        }

        return view('pendaftaran.step2', compact('data'));
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'dok_ktp_kartu_pelajar' => 'nullable|image|max:2048',
            'dok_rapor' => 'nullable|image|max:4096',
            'dok_kartu_keluarga' => 'nullable|image|max:4096',
        ]);

        $data = session('pendaftaran');
        if (!$data) { return redirect()->route('pendaftaran.step1'); }

        $dir = 'pendaftaran';
        if ($request->hasFile('dok_ktp_kartu_pelajar')) {
            $path = $request->file('dok_ktp_kartu_pelajar')->store($dir, 'public');
            $data['dok_ktp_kartu_pelajar_path'] = $path;
            $data['dok_ktp_kartu_pelajar'] = $path; // for Blade preview
        }
        if ($request->hasFile('dok_rapor')) {
            $path = $request->file('dok_rapor')->store($dir, 'public');
            $data['dok_rapor_path'] = $path;
            $data['dok_rapor'] = $path; // for Blade preview
        }
        if ($request->hasFile('dok_kartu_keluarga')) {
            $path = $request->file('dok_kartu_keluarga')->store($dir, 'public');
            $data['dok_kartu_keluarga_path'] = $path;
            $data['dok_kartu_keluarga'] = $path; // for Blade preview
        }

        session(['pendaftaran' => $data]);
        return redirect()->route('pendaftaran.step3');
    }

    public function step3()
    {
        $data = session('pendaftaran');
        if (!$data) { return redirect()->route('pendaftaran.step1'); }
        $kompetensis = Kompetensi::where('skema_id', $data['skema_id'] ?? 0)->orderBy('kode_unit')->get();
        return view('pendaftaran.step3', compact('data', 'kompetensis'));
    }

    public function submit(Request $request)
    {
        $data = session('pendaftaran');
        if (!$data) { return redirect()->route('pendaftaran.step1'); }

        $asesmen = $request->input('asesmen', []); // [kompetensi_id => 'K'|'BK']

        // Persist
        $pendaftaran = Pendaftaran::create($data);
        foreach ($asesmen as $kompetensiId => $value) {
            if (!in_array($value, ['K', 'BK'], true)) { continue; }
            PendaftaranAsesmen::create([
                'pendaftaran_id' => $pendaftaran->id,
                'kompetensi_id' => $kompetensiId,
                'is_kompeten' => $value === 'K',
            ]);
        }

        // clear session
        $request->session()->forget('pendaftaran');

        return redirect()->route('skema.index')->with('success', 'Pendaftaran berhasil dikirim.');
    }
}
