<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('info_ppdb', function (Blueprint $table) {
            $table->id('id_info_ppdb');
            
            // Informasi Umum
            $table->string('tahun_ajaran', 20); // "2025/2026"
            
            // Persyaratan & Biaya
            $table->text('syarat_pendaftaran');
            $table->string('biaya_pendaftaran', 50)->default('Gratis');
            $table->text('keterangan_biaya')->nullable();
            
            // Media
            $table->string('gambar_brosur', 255)->nullable();
            
            // Kontak
            $table->string('telepon', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('lokasi_kantor', 255)->nullable(); // URL Google Maps
            
            // URL
            $table->string('link_pendaftaran', 255)->nullable();
            
            // Audit Trail
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_ppdb');
    }
};