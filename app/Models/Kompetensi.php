<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    use HasFactory;

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    protected $table = 'kompetensis';
    protected $fillable = [
        'skema_id',
        'kode_unit',
        'unit_kompetensi',
    ];
}
