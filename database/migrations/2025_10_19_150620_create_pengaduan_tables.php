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
        // 10. KATEGORI PENGADUAN Table
        Schema::create('kategori_pengaduan', function (Blueprint $table) {
            $table->id('id_kategori'); // id_kategori:int (PK)
            $table->string('nama_kategori', 100);
            $table->timestamps();
        });

        // 11. PENGADUAN Table
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('id_pengaduan'); 
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('id_kategori');

            $table->text('deskripsi');

            // ➕ Tambahkan kolom ini
            $table->string('foto')->nullable();

            $table->enum('status_pengaduan', ['Menunggu Konfirmasi', 'Diproses', 'Selesai', 'Ditolak'])
                ->default('Menunggu Konfirmasi');

            $table->date('tanggal_pengaduan');

            // FOREIGN KEYS
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('set null');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_pengaduan')->onDelete('cascade');

            $table->timestamps();
        });


        // 12. TANGGAPAN PENGADUAN Table
        Schema::create('tanggapan_pengaduan', function (Blueprint $table) {
            $table->id('id_tanggapan'); // id_tanggapan:int (PK)
            $table->unsignedBigInteger('id_pengaduan'); // id_pengaduan:int (FK)
            $table->unsignedBigInteger('user_id'); // FK to users (Admin yang menanggapi)
            
            $table->text('isi_tanggapan');
            $table->date('tanggal_tanggapan');
            
            // FOREIGN KEYS
            $table->foreign('id_pengaduan')->references('id_pengaduan')->on('pengaduan')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('restrict');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapan_pengaduan');
        Schema::dropIfExists('pengaduan');
        Schema::dropIfExists('kategori_pengaduan');
    }
};