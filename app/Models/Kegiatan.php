<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';

    protected $fillable = [
        'id_kategori',
        'user_id',
        'nama_program',
        'deskripsi',
        'foto_program',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriKegiatan::class, 'id_kategori', 'id_kategori');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}