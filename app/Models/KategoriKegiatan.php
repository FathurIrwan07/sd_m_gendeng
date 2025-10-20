<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriKegiatan extends Model
{
    use HasFactory;

    protected $table = 'kategori_kegiatan';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori'];

    public function kegiatan(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'id_kategori', 'id_kategori');
    }
}