<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TahapanPpdb extends Model
{
    use HasFactory;

    protected $table = 'tahapan_ppdb';
    protected $primaryKey = 'id_tahapan';

    protected $fillable = [
        'id_gelombang',
        'urutan',
        'nama_tahapan',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Relasi ke tabel gelombang_ppdb
     */
    public function gelombang()
    {
        return $this->belongsTo(GelombangPpdb::class, 'id_gelombang', 'id_gelombang');
    }

    /**
     * Relasi ke info PPDB melalui gelombang
     */
    public function infoPpdb()
    {
        return $this->belongsThrough(InfoPpdb::class, GelombangPpdb::class, 
            'id_gelombang', 'id_info_ppdb');
    }

    /**
     * Accessor untuk format tanggal mulai Indonesia
     */
    public function getTanggalMulaiFormattedAttribute()
    {
        return Carbon::parse($this->tanggal_mulai)->isoFormat('D MMMM YYYY');
    }

    /**
     * Accessor untuk format tanggal selesai Indonesia
     */
    public function getTanggalSelesaiFormattedAttribute()
    {
        return Carbon::parse($this->tanggal_selesai)->isoFormat('D MMMM YYYY');
    }

    /**
     * Accessor untuk rentang tanggal
     */
    public function getRentangTanggalAttribute()
    {
        $mulai = Carbon::parse($this->tanggal_mulai);
        $selesai = Carbon::parse($this->tanggal_selesai);
        
        return $mulai->isoFormat('D MMMM') . ' - ' . $selesai->isoFormat('D MMMM YYYY');
    }

    /**
     * Accessor untuk status tahapan
     */
    public function getStatusTahapanAttribute()
    {
        if ($this->isBerlangsung()) {
            return 'berlangsung';
        } elseif ($this->isSelesai()) {
            return 'selesai';
        } else {
            return 'belum_mulai';
        }
    }

    /**
     * Check apakah tahapan sedang berlangsung
     */
    public function isBerlangsung()
    {
        $now = Carbon::now();
        return $now->between($this->tanggal_mulai, $this->tanggal_selesai);
    }

    /**
     * Check apakah tahapan sudah selesai
     */
    public function isSelesai()
    {
        return Carbon::now()->greaterThan($this->tanggal_selesai);
    }

    /**
     * Check apakah tahapan belum dimulai
     */
    public function isBelumMulai()
    {
        return Carbon::now()->lessThan($this->tanggal_mulai);
    }

    /**
     * Scope untuk filter tahapan yang sedang berlangsung
     */
    public function scopeBerlangsung($query)
    {
        $now = Carbon::now();
        return $query->whereBetween('tanggal_mulai', [$now, $now])
                     ->whereBetween('tanggal_selesai', [$now, $now]);
    }

    /**
     * Scope untuk filter berdasarkan gelombang
     */
    public function scopeByGelombang($query, $id)
    {
        return $query->where('id_gelombang', $id);
    }
}