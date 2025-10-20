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
        // 3. KATEGORI KEGIATAN Table
        Schema::create('kategori_kegiatan', function (Blueprint $table) {
            $table->id('id_kategori'); // id_kategori:int (PK)
            $table->string('nama_kategori', 50); // 'Ekstrakurikuler', 'Rutin', 'Unggulan'
            $table->timestamps();
        });

        // 4. KEGIATAN Table
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id('id_kegiatan'); // id_kegiatan:int (PK)
            $table->unsignedBigInteger('id_kategori'); // id_kategori:int (FK)
            $table->unsignedBigInteger('user_id')->nullable(); // FK to users (Audit Trail)
            
            $table->string('nama_program', 255);
            $table->text('deskripsi'); 
            $table->string('foto_program', 255)->nullable();

            // FOREIGN KEYS
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_kegiatan')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
        Schema::dropIfExists('kategori_kegiatan');
    }
};