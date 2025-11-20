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
        Schema::create('gelombang_ppdb', function (Blueprint $table) {
            $table->id('id_gelombang');
            $table->unsignedBigInteger('id_info_ppdb');
            
            // Informasi Gelombang
            $table->string('nama_gelombang', 50); // "Gelombang 1", "Gelombang 2"
            $table->integer('nomor_gelombang'); // 1, 2, 3, dst
            
            // Jadwal Gelombang
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['belum_mulai', 'berlangsung', 'selesai'])->default('belum_mulai');
            
            // Keterangan
            $table->text('keterangan')->nullable();
            
            // Foreign Key
            $table->foreign('id_info_ppdb')
                  ->references('id_info_ppdb')
                  ->on('info_ppdb')
                  ->onDelete('cascade');
            
            $table->timestamps();
            
            // Index untuk performa
            $table->index(['id_info_ppdb', 'nomor_gelombang']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gelombang_ppdb');
    }
};