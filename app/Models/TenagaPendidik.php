<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenagaPendidik extends Model
{
    use HasFactory;

    protected $table = 'tenaga_pendidik';
    protected $primaryKey = 'id_tenaga_pendidik';

    protected $fillable = [
        'nama_lengkap',
        'jabatan',
        'foto_tenaga_pendidik',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}