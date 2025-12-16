<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skema_id')->nullable()->constrained('skemas')->nullOnDelete();
            // Profil Peserta
            $table->string('nis')->nullable();
            $table->string('nik')->nullable();
            $table->string('nama_lengkap');
            $table->string('nama_sekolah')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('kelas')->nullable();
            $table->string('jadwal_uji_kompetensi')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            // Dokumen Portofolio (paths)
            $table->string('dok_ktp_kartu_pelajar_path')->nullable();
            $table->string('dok_rapor_path')->nullable();
            $table->string('dok_kartu_keluarga_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
