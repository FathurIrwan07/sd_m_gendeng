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
        // 5. KONTEN HOME Table
        Schema::create('konten_home', function (Blueprint $table) {
            $table->id('home_id'); // home_id:int (PK)
            $table->enum('tipe_konten', ['Sambutan', 'Visi', 'Misi'])->unique();
            $table->string('judul_konten', 50)->nullable();
            $table->text('isi_konten');
            $table->string('foto_kepsek_url', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // FK to users (Audit Trail)

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('set null');
            $table->timestamps();
        });

        // 6. PRESTASI Table
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id('id_prestasi'); // id_prestasi:int (PK)
            $table->string('judul_prestasi', 255);
            $table->date('tanggal')->nullable();
            $table->text('deskripsi');
            $table->string('gambar', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // FK to users (Audit Trail)

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('set null');
            $table->timestamps();
        });

        // 7. INFO PPDB Table
        // Schema::create('info_ppdb', function (Blueprint $table) {
        //     $table->id('id_info_ppdb'); // id_info_ppdb:int (PK)
        //     $table->text('syarat_pendaftaran');
        //     $table->string('gambar_brosur', 255)->nullable();
        //     $table->unsignedBigInteger('user_id')->nullable(); // FK to users (Audit Trail)

        //     $table->foreign('user_id')->references('id_user')->on('users')->onDelete('set null');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('info_ppdb');
        Schema::dropIfExists('prestasi');
        Schema::dropIfExists('konten_home');
    }
};