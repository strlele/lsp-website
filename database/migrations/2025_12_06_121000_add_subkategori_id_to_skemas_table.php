<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skemas', function (Blueprint $table) {
            $table->foreignId('subkategori_id')
                ->nullable()
                ->after('kategori_id')
                ->constrained('subkategoris')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('skemas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('subkategori_id');
        });
    }
};
