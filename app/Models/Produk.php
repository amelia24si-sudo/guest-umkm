<?php
namespace App\Models;

use App\Models\Media;
use App\Models\UlasanProduk;
use App\Models\Umkm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table      = 'produk';
    protected $primaryKey = 'produk_id';
    protected $fillable   = ['umkm_id', 'nama_produk', 'deskripsi', 'harga', 'stok', 'status'];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'umkm_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'produk_id')
            ->where('ref_table', 'produk')
            ->orderBy('sort_order', 'asc');
    }

    public function ulasan()
    {
        return $this->hasMany(UlasanProduk::class, 'produk_id', 'produk_id');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'produk_id', 'produk_id');
    }

    /**
     * Relasi ke Pesanan melalui Detail Pesanan (BARU)
     */
    public function pesanan()
    {
        return $this->belongsToMany(Pesanan::class, 'detail_pesanan', 'produk_id', 'pesanan_id')
            ->withPivot('qty', 'harga_satuan', 'subtotal')
            ->withTimestamps()
            ->using(DetailPesanan::class);
    }

    public function getAverageRatingAttribute()
    {
        if ($this->ulasan->count() > 0) {
            return round($this->ulasan->avg('rating'), 1);
        }
        return 0;
    }

    public function getTotalUlasanAttribute()
    {
        return $this->ulasan->count();
    }

    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getStatusBadgeAttribute()
    {
        return $this->status == 'aktif' ? 'success' : 'danger';
    }

    public function getStatusTextAttribute()
    {
        return $this->status == 'aktif' ? 'Aktif' : 'Nonaktif';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk search (optional, bisa digunakan di controller)
    public function scopeSearch($query, $keyword)
    {
        if (! $keyword) {
            return $query;
        }

        return $query->where(function ($q) use ($keyword) {
            $q->where('nama_produk', 'like', '%' . $keyword . '%')
                ->orWhere('deskripsi', 'like', '%' . $keyword . '%');
        });
    }

    // Scope untuk filter status (optional)
    public function scopeByStatus($query, $status)
    {
        if (! $status) {
            return $query;
        }

        return $query->where('status', $status);
    }

    // Scope untuk sorting (optional)
    public function scopeSortBy($query, $sortBy)
    {
        switch ($sortBy) {
            case 'oldest':
                return $query->orderBy('created_at', 'asc');
            case 'name_asc':
                return $query->orderBy('nama_produk', 'asc');
            case 'name_desc':
                return $query->orderBy('nama_produk', 'desc');
            case 'price_low':
                return $query->orderBy('harga', 'asc');
            case 'price_high':
                return $query->orderBy('harga', 'desc');
            case 'newest':
            default:
                return $query->orderBy('created_at', 'desc');
        }
    }
}
