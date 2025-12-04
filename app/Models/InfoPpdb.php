<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPpdb extends Model
{
    use HasFactory;

    protected $table = 'info_ppdb';
    protected $primaryKey = 'id_info_ppdb';

    protected $fillable = [
        'tahun_ajaran',
        'syarat_pendaftaran',
        'biaya_pendaftaran',
        'keterangan_biaya',
        'gambar_brosur',
        'telepon',
        'email',
        'alamat',
        'lokasi_kantor',
        'link_pendaftaran',
        'user_id'
    ];


    /**
     * Relasi ke tabel gelombang_ppdb
     */
    public function gelombang()
    {
        return $this->hasMany(GelombangPpdb::class, 'id_info_ppdb', 'id_info_ppdb')
            ->orderBy('nomor_gelombang');
    }

    /**
     * Relasi ke tabel tahapan_ppdb melalui gelombang
     */
    public function tahapan()
    {
        return $this->hasManyThrough(
            TahapanPpdb::class,
            GelombangPpdb::class,
            'id_info_ppdb',
            'id_gelombang',
            'id_info_ppdb',
            'id_gelombang'
        )->orderBy('urutan');
    }

    /**
     * Relasi ke tabel users
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    /**
     * Accessor untuk format tanggal Indonesia
     */
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    /**
     * Get total gelombang
     */
    public function getTotalGelombangAttribute()
    {
        return $this->gelombang()->count();
    }

    /**
     * Scope untuk filter berdasarkan tahun ajaran
     */
    public function scopeTahunAjaran($query, $tahun)
    {
        return $query->where('tahun_ajaran', $tahun);
    }

}