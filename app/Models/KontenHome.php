<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KontenHome extends Model
{
    use HasFactory;

    protected $table = 'konten_home';
    protected $primaryKey = 'home_id';

    protected $fillable = [
        'tipe_konten',
        'judul_konten',
        'isi_konten',
        'foto_kepsek_url',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}