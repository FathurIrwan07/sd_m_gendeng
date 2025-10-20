<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user'; 
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'role_id',
        'username',
        'nama_lengkap',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }


    public function kegiatan(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'user_id', 'id_user');
    }

    public function kontenHome(): HasMany
    {
        return $this->hasMany(KontenHome::class, 'user_id', 'id_user');
    }

    public function prestasi(): HasMany
    {
        return $this->hasMany(Prestasi::class, 'user_id', 'id_user');
    }

    public function infoPpdb(): HasMany
    {
        return $this->hasMany(InfoPpdb::class, 'user_id', 'id_user');
    }

    public function fasilitas(): HasMany
    {
        return $this->hasMany(Fasilitas::class, 'user_id', 'id_user');
    }

    public function tenagaPendidik(): HasMany
    {
        return $this->hasMany(TenagaPendidik::class, 'user_id', 'id_user');
    }

    public function pengaduanDibuat(): HasMany
    {
        return $this->hasMany(Pengaduan::class, 'user_id', 'id_user');
    }

    public function tanggapanDibuat(): HasMany
    {
        return $this->hasMany(TanggapanPengaduan::class, 'user_id', 'id_user');
    }

   public function hasRole(string $roleName): bool
    {
        if ($this->role === $roleName) {
             return true;
        }

        return optional($this->role)->nama_role === $roleName;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('Admin');
    }

    public function isRegularUser(): bool
    {
        return $this->hasRole('User');
    }
}