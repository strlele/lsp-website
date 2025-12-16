<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subkategoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoris')->cascadeOnDelete();
            $table->string('nama_subkategori');
            $table->timestamps();
            $table->unique(['kategori_id', 'nama_subkategori'], 'subkat_unique_per_kategori');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subkategoris');
    }
};
