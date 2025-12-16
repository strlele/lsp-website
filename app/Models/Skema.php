<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    use HasFactory;

    public function kompetensis()
    {
        return $this->hasMany(Kompetensi::class);
    }

    protected $table = 'skemas';
    protected $fillable = [
        'kode_skema',
        'nama_skema',
        'kategori_id',
        'subkategori_id',
    ];

    public function kategori() { return $this->belongsTo(\App\Models\Kategori::class); }
    public function subkategori() { return $this->belongsTo(\App\Models\Subkategori::class); }
}
