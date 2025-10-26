<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InfoPpdb extends Model
{
    use HasFactory;

    protected $table = 'info_ppdb';
    protected $primaryKey = 'id_info_ppdb';

    protected $fillable = [
        'syarat_pendaftaran',
        'gambar_brosur',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}