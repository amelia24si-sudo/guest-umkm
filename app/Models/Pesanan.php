<?php
// app/Models/Pesanan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table      = 'pesanan';
    protected $primaryKey = 'pesanan_id';
    protected $fillable   = [
        'nomor_pesanan',
        'warga_id',
        'total',
        'status',
        'alamat_kirim',
        'rt',
        'rw',
        'metode_bayar',
    ];

    protected $casts = [
        'total'      => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke Warga
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    /**
     * Relasi ke Media (Bukti Bayar/Resi)
     */
    public function buktiBayar()
    {
        return $this->hasOne(Media::class, 'ref_id', 'pesanan_id')
            ->where('ref_table', 'pesanan')
            ->orderBy('sort_order', 'asc');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id', 'pesanan_id');
    }
    /**
     * Relasi ke semua Media terkait pesanan
     */
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'pesanan_id')
            ->where('ref_table', 'pesanan')
            ->orderBy('sort_order', 'asc');
    }
    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'detail_pesanan', 'pesanan_id', 'produk_id')
            ->withPivot('qty', 'harga_satuan', 'subtotal')
            ->withTimestamps()
            ->using(DetailPesanan::class);
    }
    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus(Builder $query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Scope untuk filter berdasarkan warga
     */
    public function scopeByWarga(Builder $query, $wargaId)
    {
        if ($wargaId) {
            return $query->where('warga_id', $wargaId);
        }
        return $query;
    }

    /**
     * Scope untuk filter berdasarkan metode bayar
     */
    public function scopeByMetodeBayar(Builder $query, $metode)
    {
        if ($metode) {
            return $query->where('metode_bayar', $metode);
        }
        return $query;
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeByDateRange(Builder $query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        } elseif ($startDate) {
            return $query->where('created_at', '>=', $startDate . ' 00:00:00');
        } elseif ($endDate) {
            return $query->where('created_at', '<=', $endDate . ' 23:59:59');
        }
        return $query;
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch(Builder $query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('nomor_pesanan', 'like', "%{$search}%")
                    ->orWhere('alamat_kirim', 'like', "%{$search}%")
                    ->orWhere('rt', 'like', "%{$search}%")
                    ->orWhere('rw', 'like', "%{$search}%")
                    ->orWhereHas('warga', function ($q2) use ($search) {
                        $q2->where('nama', 'like', "%{$search}%")
                            ->orWhere('no_ktp', 'like', "%{$search}%")
                            ->orWhere('telp', 'like', "%{$search}%");
                    });
            });
        }
        return $query;
    }

    /**
     * Scope untuk sorting
     */
    public function scopeSort($query, $sortBy, $sortOrder = 'desc')
    {
        switch ($sortBy) {
            case 'nomor':
                return $query->orderBy('nomor_pesanan', $sortOrder);
            case 'warga':
                return $query->join('warga', 'pesanan.warga_id', '=', 'warga.warga_id')
                    ->orderBy('warga.nama', $sortOrder)
                    ->select('pesanan.*');
            case 'total':
                return $query->orderBy('total', $sortOrder);
            case 'tanggal':
                return $query->orderBy('created_at', $sortOrder);
            case 'status':
                return $query->orderBy('status', $sortOrder);
            default:
                return $query->orderBy('created_at', 'desc');
        }
    }

    /**
     * Scope untuk filter berdasarkan range total
     */
    public function scopeByTotalRange($query, $minTotal, $maxTotal)
    {
        if ($minTotal) {
            $query->where('total', '>=', $minTotal);
        }
        if ($maxTotal) {
            $query->where('total', '<=', $maxTotal);
        }
        return $query;
    }

    /**
     * Accessor untuk status lengkap
     */
    public function getStatusLengkapAttribute()
    {
        $statuses = [
            'pending'    => 'Menunggu Pembayaran',
            'diproses'   => 'Sedang Diproses',
            'dikirim'    => 'Sedang Dikirim',
            'selesai'    => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    /**
     * Accessor untuk status badge color
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending'    => 'warning',
            'diproses'   => 'info',
            'dikirim'    => 'primary',
            'selesai'    => 'success',
            'dibatalkan' => 'danger',
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    /**
     * Accessor untuk metode bayar lengkap
     */
    public function getMetodeBayarLengkapAttribute()
    {
        $metodes = [
            'transfer' => 'Transfer Bank',
            'cod'      => 'Cash on Delivery (COD)',
            'tunai'    => 'Tunai',
        ];

        return $metodes[$this->metode_bayar] ?? $this->metode_bayar;
    }

    /**
     * Accessor untuk metode bayar badge color
     */
    public function getMetodeBayarBadgeAttribute()
    {
        $badges = [
            'transfer' => 'info',
            'cod'      => 'success',
            'tunai'    => 'primary',
        ];

        return $badges[$this->metode_bayar] ?? 'secondary';
    }

    /**
     * Accessor untuk alamat lengkap
     */
    public function getAlamatLengkapAttribute()
    {
        return "{$this->alamat_kirim}, RT {$this->rt}/RW {$this->rw}";
    }

    /**
     * Accessor untuk format total
     */
    public function getTotalFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    /**
     * Accessor untuk tanggal format pendek
     */
    public function getTanggalPendekAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * Accessor untuk tanggal format lengkap
     */
    public function getTanggalLengkapAttribute()
    {
        return $this->created_at->format('d F Y H:i');
    }

    /**
     * Generate nomor pesanan
     */
    public static function generateNomorPesanan()
    {
        $prefix    = 'PSN-' . date('Ymd') . '-';
        $lastOrder = self::where('nomor_pesanan', 'like', $prefix . '%')
            ->orderBy('nomor_pesanan', 'desc')
            ->first();

        if ($lastOrder) {
            $lastNumber = intval(substr($lastOrder->nomor_pesanan, -4));
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        return $prefix . $nextNumber;
    }

    /**
     * Get statistics for dashboard
     */
    public static function getStatistics()
    {
        return [
            'total'           => self::count(),
            'pending'         => self::where('status', 'pending')->count(),
            'diproses'        => self::where('status', 'diproses')->count(),
            'dikirim'         => self::where('status', 'dikirim')->count(),
            'selesai'         => self::where('status', 'selesai')->count(),
            'total_hari_ini'  => self::whereDate('created_at', today())->count(),
            'total_bulan_ini' => self::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->count(),
        ];
    }
}
