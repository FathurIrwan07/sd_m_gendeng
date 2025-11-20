<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tahapan_ppdb', function (Blueprint $table) {

            // Hapus foreign key dan kolom lama
            $table->dropForeign(['id_info_ppdb']);
            $table->dropColumn('id_info_ppdb');

            // Tambahkan kolom baru
            $table->unsignedBigInteger('id_gelombang');

            // Tambahkan foreign key baru
            $table->foreign('id_gelombang')
                ->references('id_gelombang')
                ->on('gelombang_ppdb')
                ->onDelete('cascade');

            // Tambahkan index tambahan
            $table->index(['id_gelombang', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::table('tahapan_ppdb', function (Blueprint $table) {

            // Rollback perubahan

            $table->dropForeign(['id_gelombang']);
            $table->dropIndex(['id_gelombang', 'urutan']);
            $table->dropColumn('id_gelombang');

            $table->unsignedBigInteger('id_info_ppdb');
            $table->foreign('id_info_ppdb')
                ->references('id_info_ppdb')
                ->on('info_ppdb')
                ->onDelete('cascade');
        });
    }
};
