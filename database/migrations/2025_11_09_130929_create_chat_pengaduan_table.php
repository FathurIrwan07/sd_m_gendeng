<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_pengaduan', function (Blueprint $table) {
            $table->id('id_chat');
            $table->unsignedBigInteger('id_pengaduan');
            $table->unsignedBigInteger('user_id'); // Pengirim (bisa admin atau user)
            $table->text('pesan');
            $table->boolean('is_admin')->default(false); // true jika dikirim admin
            $table->boolean('is_read')->default(false); // Status baca
            $table->timestamps();

            $table->foreign('id_pengaduan')->references('id_pengaduan')->on('pengaduan')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_pengaduan');
    }
};