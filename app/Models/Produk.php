<?php
namespace App\Models;

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
        return $this->morphMany(Media::class, 'ref', 'ref_table', 'ref_id');
    }

    // Accessor untuk format harga
    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        return $this->status == 'aktif' ? 'success' : 'danger';
    }

    // Accessor untuk status text
    public function getStatusTextAttribute()
    {
        return $this->status == 'aktif' ? 'Aktif' : 'Nonaktif';
    }

    // Scope untuk produk aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }
}
