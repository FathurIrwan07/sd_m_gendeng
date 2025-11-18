<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';

    protected $fillable = [
        'judul_prestasi',
        'nama_peraih',
        'tingkat_prestasi',
        'tanggal',
        'deskripsi',
        'gambar',
        'user_id',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the user who created/updated the achievement (Audit Trail).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    /**
     * Get badge color based on tingkat_prestasi
     */
    public function getTingkatBadgeColorAttribute(): string
    {
        return match($this->tingkat_prestasi) {
            'Internasional' => 'badge-danger',
            'Nasional' => 'badge-primary',
            'Provinsi' => 'badge-info',
            'Kabupaten/Kota' => 'badge-success',
            'Kecamatan' => 'badge-warning',
            default => 'badge-secondary'
        };
    }
}