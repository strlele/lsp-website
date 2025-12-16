<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nik',
        'sertifikasi',
        'pengalaman_kerja',
        'dokumen_path',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
