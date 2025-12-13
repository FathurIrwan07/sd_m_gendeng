<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'user_id', // Nullable (Anonymous)
        'id_kategori',
        'deskripsi',
        'foto',
        'status_pengaduan',
        'tanggal_pengaduan',
    ];

    public function chats(): HasMany
    {
        return $this->hasMany(ChatPengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function unreadChatsForAdmin(): int
    {
        return $this->chats()
            ->where('is_admin', false)
            ->where('is_read', false)
            ->count();
    }

    public function unreadChatsForUser(): int
    {
        return $this->chats()
            ->where('is_admin', true)
            ->where('is_read', false)
            ->count();
    }

    protected $casts = [
        'tanggal_pengaduan' => 'date',
    ];

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriPengaduan::class, 'id_kategori', 'id_kategori');
    }

    public function tanggapan(): HasOne
    {
        return $this->hasOne(TanggapanPengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }
}