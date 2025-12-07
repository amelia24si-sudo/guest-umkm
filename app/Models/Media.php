<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_nama',
        'caption',
        'mime_type',
        'sort_order'
    ];

    /**
     * Mendapatkan model terkait berdasarkan ref_table dan ref_id
     */
    public function ref()
    {
        return match($this->ref_table) {
            'umkm' => $this->belongsTo(Umkm::class, 'ref_id', 'umkm_id'),
            'produk' => $this->belongsTo(Produk::class, 'ref_id', 'produk_id'),
            'pesanan' => $this->belongsTo(Pesanan::class, 'ref_id', 'pesanan_id'),
            default => null,
        };
    }

    /**
     * Scope untuk mendapatkan media berdasarkan tabel referensi
     */
    public function scopeByRef($query, $refTable, $refId)
    {
        return $query->where('ref_table', $refTable)
                     ->where('ref_id', $refId)
                     ->orderBy('sort_order', 'asc');
    }

    /**
     * Scope untuk mendapatkan media dengan tipe tertentu
     */
    public function scopeByMimeType($query, $type)
    {
        return $query->where('mime_type', 'like', $type . '%');
    }

    /**
     * Aksesor untuk URL lengkap
     */
    public function getFullUrlAttribute()
    {
        return asset('storage/' . $this->file_url);
    }

    /**
     * Aksesor untuk menentukan apakah file adalah gambar
     */
    public function getIsImageAttribute()
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    /**
     * Aksesor untuk mendapatkan nama file
     */
    public function getFileNameAttribute()
    {
        return basename($this->file_url);
    }
}
