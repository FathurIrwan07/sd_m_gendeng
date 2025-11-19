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
        /**
     * Get icon emoji based on tingkat_prestasi
     */
    public function getIconAttribute(): string
    {
        return match($this->tingkat_prestasi) {
            'Internasional' => '🌍',
            'Nasional' => '🏆',
            'Provinsi' => '🥇',
            'Kabupaten/Kota' => '🥈',
            'Kecamatan' => '🎖️',
            default => '🏅'
        };
    }

    /**
     * Get color class based on tingkat_prestasi
     */
    public function getColorClassAttribute(): string
    {
        return match($this->tingkat_prestasi) {
            'Internasional' => 'bg-gradient-to-br from-yellow-400 to-yellow-600',
            'Nasional' => 'bg-gradient-to-br from-blue-500 to-blue-700',
            'Provinsi' => 'bg-gradient-to-br from-green-500 to-green-700',
            'Kabupaten/Kota' => 'bg-gradient-to-br from-purple-500 to-purple-700',
            'Kecamatan' => 'bg-gradient-to-br from-orange-500 to-orange-700',
            default => 'bg-gradient-to-br from-gray-500 to-gray-700'
        };
    }
}