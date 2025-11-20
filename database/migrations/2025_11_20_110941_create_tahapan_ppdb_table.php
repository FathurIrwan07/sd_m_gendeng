<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tahapan_ppdb', function (Blueprint $table) {
            $table->id('id_tahapan');
            $table->unsignedBigInteger('id_gelombang'); // ✅ UBAH: ke id_gelombang
            
            // Detail Tahapan
            $table->integer('urutan')->default(1);
            $table->string('nama_tahapan', 100);
            $table->text('deskripsi')->nullable();
            
            // Jadwal
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            
            // Foreign Key
            $table->foreign('id_gelombang') 
                  ->references('id_gelombang')
                  ->on('gelombang_ppdb')
                  ->onDelete('cascade');
            
            $table->timestamps();
            
            // Index
            $table->index(['id_gelombang', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tahapan_ppdb');
    }
};

