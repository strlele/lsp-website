<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkategori extends Model
{
    use HasFactory;

    protected $table = 'subkategoris';

    protected $fillable = [
        'kategori_id',
        'nama_subkategori',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
