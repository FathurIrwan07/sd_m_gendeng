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
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->id('role_id'); // role_id:int (PK)
                $table->enum('nama_role', ['Admin', 'User'])->unique();
                $table->timestamps();
            });
        }
        
        // 2. USERS Table (Disesuaikan dengan role_id)
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user'); // Mengganti 'id()'
            $table->unsignedBigInteger('role_id'); // role_id:int (FK ke roles)
            
            $table->string('username', 50)->unique(); // Digunakan sebagai login utama
            $table->string('nama_lengkap', 100) ; 
            
            $table->string('email', 100)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            
            $table->string('password', 255); 
            
            $table->rememberToken();
            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade');
        });

        // 3. PASSWORD_RESET_TOKENS Table (Dipertahankan)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 4. SESSIONS Table (Dipertahankan)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index(); // Relasi ke tabel users
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
};