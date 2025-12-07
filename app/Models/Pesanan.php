<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table      = 'pesanan';
    protected $primaryKey = 'pesanan_id';
    protected $fillable = [
        'nomor_pesanan',
        'warga_id',
        'total',
        'status',
        'alamat_kirim',
        'rt',
        'rw',
        'metode_bayar',
        'bukti_bayar',
        'resi_pengiriman',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    // Relasi dengan Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Hapus atau comment relasi items jika tidak ada tabel pesanan_items
    // public function items()
    // {
    //     return $this->hasMany(PesananItem::class, 'pesanan_id', 'pesanan_id');
    // }

    // Accessor untuk status lengkap
    public function getStatusLengkapAttribute()
    {
        $statusMap = [
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'diproses'            => 'Diproses',
            'dikirim'             => 'Dikirim',
            'selesai'             => 'Selesai',
            'dibatalkan'          => 'Dibatalkan',
        ];

        return $statusMap[$this->status] ?? $this->status;
    }

    // Accessor untuk metode bayar lengkap
    public function getMetodeBayarLengkapAttribute()
    {
        $metodeMap = [
            'transfer' => 'Transfer Bank',
            'cod'      => 'Cash on Delivery (COD)',
            'lainnya'  => 'Lainnya',
        ];

        return $metodeMap[$this->metode_bayar] ?? $this->metode_bayar;
    }

    // Accessor untuk informasi lengkap
    public function getInfoPesananAttribute()
    {
        return "{$this->nomor_pesanan} - {$this->warga->nama} - Rp " . number_format($this->total, 0, ',', '.');
    }

    // Scope untuk filter
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope untuk search
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }

    // Scope untuk filter berdasarkan tanggal
    public function scopeFilterTanggal($query, $dari, $sampai)
    {
        if ($dari && $sampai) {
            return $query->whereBetween('created_at', [$dari, $sampai]);
        }
        return $query;
    }

    // Scope untuk filter berdasarkan status
    public function scopeFilterStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }

    // Scope untuk filter berdasarkan warga
    public function scopeFilterWarga($query, $wargaId)
    {
        if ($wargaId) {
            return $query->where('warga_id', $wargaId);
        }
        return $query;
    }
}
