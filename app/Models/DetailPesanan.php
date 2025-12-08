<?php
// app/Models/DetailPesanan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'qty',
        'harga_satuan',
        'subtotal'
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relasi ke Pesanan
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'pesanan_id');
    }

    /**
     * Relasi ke Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }

    /**
     * Accessor untuk format harga satuan
     */
    public function getHargaSatuanFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga_satuan, 0, ',', '.');
    }

    /**
     * Accessor untuk format subtotal
     */
    public function getSubtotalFormattedAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    /**
     * Hook untuk menghitung subtotal otomatis
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($detail) {
            $detail->hitungSubtotal();
        });

        static::updating(function ($detail) {
            $detail->hitungSubtotal();
        });
    }

    /**
     * Hitung subtotal dari qty dan harga satuan
     */
    public function hitungSubtotal()
    {
        $this->subtotal = $this->qty * $this->harga_satuan;
    }
}
