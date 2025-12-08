<?php
namespace App\Models;

use App\Models\Umkm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{
    use HasFactory;
    protected $table      = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable   = ['no_ktp', 'nama', 'jenis_kelamin', 'agama', 'pekerjaan', 'telp', 'email', 'alamat', 'rt', 'rw'];

    // Relasi dengan UMKM/Binadesa
    public function umkm()
    {
        return $this->hasMany(Umkm::class, 'pemilik_warga_id', 'warga_id');
    }
    public function ulasan()
    {
        return $this->hasMany(UlasanProduk::class, 'warga_id', 'warga_id');
    }
    // Accessor untuk menampilkan informasi lengkap
    public function getInfoLengkapAttribute()
    {
        $info = $this->nama;
        if ($this->no_ktp) {
            $info .= " - NIK: " . $this->no_ktp;
        }
        if ($this->alamat) {
            $info .= " - Alamat: " . $this->alamat;
        }
        return $info;
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

    // Scope untuk filter UMKM
    public function scopeFilterUmkm($query, $value)
    {
        if ($value === 'pemilik') {
            return $query->has('umkm');
        } elseif ($value === 'bukan') {
            return $query->doesntHave('umkm');
        }
        return $query;
    }
}
