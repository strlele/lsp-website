<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'skema_id','nis','nik','nama_lengkap','nama_sekolah','jurusan','kelas','jadwal_uji_kompetensi','tempat_lahir','tanggal_lahir','jenis_kelamin','provinsi','kabupaten','kecamatan','alamat','no_telp','email','dok_ktp_kartu_pelajar_path','dok_rapor_path','dok_kartu_keluarga_path'
    ];

    public function skema() { return $this->belongsTo(Skema::class); }
    public function asesmens() { return $this->hasMany(PendaftaranAsesmen::class); }
}
