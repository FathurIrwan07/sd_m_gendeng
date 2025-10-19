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
        // 8. FASILITAS Table
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id('id_fasilitas'); // id_fasilitas:int (PK)
            $table->string('nama_fasilitas', 150);
            $table->text('deskripsi');
            $table->string('gambar', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // FK to users (Audit Trail)

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('set null');
            $table->timestamps();
        });

        // 9. TENAGA PENDIDIK Table
        Schema::create('tenaga_pendidik', function (Blueprint $table) {
            $table->id('id_tenaga_pendidik'); // id_tenaga_pendidik:int (PK)
            $table->string('nama_lengkap', 150);
            $table->string('jabatan', 100);
            $table->string('foto_tenaga_pendidik', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // FK to users (Audit Trail)

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_pendidik');
        Schema::dropIfExists('fasilitas');
    }
};