<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori',
    ];

    public function skemas()
    {
        return $this->hasMany(Skema::class);
    }

    public function subkategoris()
    {
        return $this->hasMany(Subkategori::class);
    }
}
