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
        // Tambah kolom pada tabel prestasi
        Schema::table('prestasi', function (Blueprint $table) {
            $table->string('nama_peraih', 150)->after('judul_prestasi');
            $table->enum('tingkat_prestasi', ['Internasional', 'Nasional', 'Provinsi', 'Kabupaten/Kota', 'Kecamatan'])
                  ->after('nama_peraih');
        });

        // Tambah kolom pada tabel tenaga_pendidik
        Schema::table('tenaga_pendidik', function (Blueprint $table) {
            $table->string('lulusan', 200)->nullable()->after('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi', function (Blueprint $table) {
            $table->dropColumn(['nama_peraih', 'tingkat_prestasi']);
        });

        Schema::table('tenaga_pendidik', function (Blueprint $table) {
            $table->dropColumn('lulusan');
        });
    }
};