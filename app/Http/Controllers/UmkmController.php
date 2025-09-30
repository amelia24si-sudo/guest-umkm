<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmkmController extends Controller
{
    // Menampilkan semua UMKM
    public function index()
    {
        // Data UMKM contoh
        $data_umkm = [
            [
                'id' => 1,
                'nama_usaha' => 'Toko Bangunan Maju Jaya',
                'pemilik' => 'Budi Santoso',
                'alamat' => 'Jl. Merdeka No. 123',
                'kategori' => 'Perdagangan',
                'kontak' => '081234567890',
                'deskripsi' => 'Menjual material bangunan berkualitas',
                'gambar' => 'toko1.jpg'
            ],
            [
                'id' => 2,
                'nama_usaha' => 'Warung Makan Sederhana',
                'pemilik' => 'Siti Rahayu',
                'alamat' => 'Jl. Pahlawan No. 45',
                'kategori' => 'Kuliner',
                'kontak' => '081987654321',
                'deskripsi' => 'Masakan rumahan yang lezat',
                'gambar' => 'warung1.jpg'
            ],
            [
                'id' => 3,
                'nama_usaha' => 'Toko Elektronik Sejahtera',
                'pemilik' => 'Ahmad Wijaya',
                'alamat' => 'Jl. Sudirman No. 78',
                'kategori' => 'Elektronik',
                'kontak' => '081345678901',
                'deskripsi' => 'Service dan jual alat elektronik',
                'gambar' => 'elektronik1.jpg'
            ],
            [
                'id' => 4,
                'nama_usaha' => 'Butik Cantik',
                'pemilik' => 'Dewi Lestari',
                'alamat' => 'Jl. Melati No. 12',
                'kategori' => 'Fashion',
                'kontak' => '081456789012',
                'deskripsi' => 'Pakaian wanita modern dan tradisional',
                'gambar' => 'butik1.jpg'
            ]
        ];

        return view('Umkm.index', ['umkms' => $data_umkm]);
    }

    // Menampilkan detail UMKM
    public function show($id)
    {
        // Data UMKM contoh
        $data_umkm = [
            [
                'id' => 1,
                'nama_usaha' => 'Toko Bangunan Maju Jaya',
                'pemilik' => 'Budi Santoso',
                'alamat' => 'Jl. Merdeka No. 123, RT 01/RW 05',
                'kategori' => 'Perdagangan',
                'kontak' => '081234567890',
                'deskripsi' => 'Menjual berbagai material bangunan berkualitas dengan harga terjangkau. Melayani kebutuhan proyek besar maupun kecil.',
                'gambar' => 'toko1.jpg',
                'produk_unggulan' => 'Semen, Pasir, Batu Bata, Cat'
            ],
            [
                'id' => 2,
                'nama_usaha' => 'Warung Makan Sederhana',
                'pemilik' => 'Siti Rahayu',
                'alamat' => 'Jl. Pahlawan No. 45, RT 02/RW 05',
                'kategori' => 'Kuliner',
                'kontak' => '081987654321',
                'deskripsi' => 'Menyediakan masakan rumahan yang lezat dan higienis. Special nasi campur dengan lauk pauk fresh setiap hari.',
                'gambar' => 'warung1.jpg',
                'produk_unggulan' => 'Nasi Campur, Soto Ayam, Gado-gado'
            ],
            [
                'id' => 3,
                'nama_usaha' => 'Toko Elektronik Sejahtera',
                'pemilik' => 'Ahmad Wijaya',
                'alamat' => 'Jl. Sudirman No. 78, RT 03/RW 05',
                'kategori' => 'Elektronik',
                'kontak' => '081345678901',
                'deskripsi' => 'Spesialis perbaikan dan penjualan alat elektronik. Juga melayani service TV, kulkas, AC, dan mesin cuci.',
                'gambar' => 'elektronik1.jpg',
                'produk_unggulan' => 'Service Elektronik, Kabel, Adaptor'
            ],
            [
                'id' => 4,
                'nama_usaha' => 'Butik Cantik',
                'pemilik' => 'Dewi Lestari',
                'alamat' => 'Jl. Melati No. 12, RT 04/RW 05',
                'kategori' => 'Fashion',
                'kontak' => '081456789012',
                'deskripsi' => 'Menjual pakaian wanita modern dan tradisional. Juga menerima jasa jahit dan modifikasi baju.',
                'gambar' => 'butik1.jpg',
                'produk_unggulan' => 'Dress, Kebaya, Jasa Jahit'
            ]
        ];

        // Cari UMKM berdasarkan ID
        $umkm_detail = null;
        foreach ($data_umkm as $umkm) {
            if ($umkm['id'] == $id) {
                $umkm_detail = $umkm;
                break;
            }
        }

        if ($umkm_detail) {
            return view('Umkm.show', ['umkm' => $umkm_detail]);
        } else {
            return redirect('/umkm');
        }
    }
}
