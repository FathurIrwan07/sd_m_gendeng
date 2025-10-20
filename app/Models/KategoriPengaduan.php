<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPengaduan extends Model
{
    use HasFactory;

    protected $table = 'kategori_pengaduan';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
    ];

    /**
     * Get the complaints associated with this category.
     */
    public function pengaduan(): HasMany
    {
        return $this->hasMany(Pengaduan::class, 'id_kategori', 'id_kategori');
    }
}