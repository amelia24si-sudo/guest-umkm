<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table      = 'umkm';
    protected $primaryKey = 'umkm_id';
    protected $fillable   = ['nama_usaha', 'pemilik_warga_id', 'alamat', 'rt', 'rw', 'kategori', 'kontak', 'deskripsi'];

    public function pemilik()
    {
        return $this->belongsTo(Warga::class, 'pemilik_warga_id', 'warga_id');
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'umkm_id', 'umkm_id');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'ref', 'ref_table', 'ref_id');
    }
}
