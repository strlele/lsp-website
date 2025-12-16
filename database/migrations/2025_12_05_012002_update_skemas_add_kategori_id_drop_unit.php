<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skemas', function (Blueprint $table) {
            if (!Schema::hasColumn('skemas', 'kategori_id')) {
                $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->nullOnDelete()->after('nama_skema');
            }
        });

        if (Schema::hasColumn('skemas', 'unit')) {
            Schema::table('skemas', function (Blueprint $table) {
                $table->dropColumn('unit');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('skemas', 'unit')) {
            Schema::table('skemas', function (Blueprint $table) {
                $table->string('unit')->nullable()->after('nama_skema');
            });
        }

        if (Schema::hasColumn('skemas', 'kategori_id')) {
            Schema::table('skemas', function (Blueprint $table) {
                $table->dropConstrainedForeignId('kategori_id');
            });
        }
    }
};
