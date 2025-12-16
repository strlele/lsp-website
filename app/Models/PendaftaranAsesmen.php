<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranAsesmen extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendaftaran_id',
        'kompetensi_id',
        'is_kompeten',
    ];

    public function pendaftaran() { return $this->belongsTo(Pendaftaran::class); }
    public function kompetensi() { return $this->belongsTo(Kompetensi::class); }
}
