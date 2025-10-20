<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'user_id', // Nullable (Anonymous)
        'id_kategori',
        'deskripsi',
        'status_pengaduan',
        'tanggal_pengaduan',
    ];

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