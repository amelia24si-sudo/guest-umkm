<?php

namespace App\Models;

use App\Models\Warga;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UlasanProduk extends Model
{
    use HasFactory;

    protected $table      = 'ulasan_produk';
    protected $primaryKey = 'ulasan_id';
    protected $fillable   = ['produk_id', 'warga_id', 'rating', 'komentar'];

    /**
     * Relasi ke model Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }

    /**
     * Relasi ke model Warga (asumsi model Warga sudah ada)
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    /**
     * Accessor untuk rating bintang
     */
    public function getRatingBintangAttribute()
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    /**
     * Scope untuk mendapatkan ulasan terbaru
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope untuk produk tertentu
     */
    public function scopeForProduk($query, $produkId)
    {
        return $query->where('produk_id', $produkId);
    }

    /**
     * Validasi rating
     */
    public static function validateRating($rating)
    {
        return $rating >= 1 && $rating <= 5;
    }
}
