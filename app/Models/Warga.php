<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Warga extends Model
{
    use HasFactory;
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable = ['no_ktp', 'nama', 'jenis_kelamin', 'agama', 'pekerjaan', 'telp', 'email'];
    // Relasi dengan UMKM/Binadesa
    public function umkm()
    {
        return $this->hasMany(Umkm::class, 'pemilik_warga_id', 'warga_id');
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
}
