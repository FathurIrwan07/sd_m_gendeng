<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TanggapanPengaduan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan_pengaduan';
    protected $primaryKey = 'id_tanggapan';

    protected $fillable = [
        'id_pengaduan',
        'user_id',
        'isi_tanggapan',
        'tanggal_tanggapan',
    ];

    protected $casts = [
        'tanggal_tanggapan' => 'date',
    ];

    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function penanggap(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}