<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');       // ID warga
            $table->string('prefix_surat');              // Kode jenis surat: SKTM, SKD, SKCK, SKBM, SKU
            $table->integer('nomor_surat_angka')->nullable(); // Nomor urut per jenis surat
            $table->string('nomor_surat')->nullable();   // Nomor surat lengkap, misal 003/SKTM/DS-ML/XII/2025
            $table->timestamp('cetak_at')->nullable();   // Waktu cetak surat
            $table->timestamps();

            // Optional: foreign key ke tabel users (warga)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Index untuk mempercepat pencarian terakhir per jenis surat
            $table->index(['prefix_surat', 'cetak_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
