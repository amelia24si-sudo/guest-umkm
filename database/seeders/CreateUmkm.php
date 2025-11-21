<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateUmkm extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Ambil data warga yang sudah ada
        $wargas = DB::table('warga')->get();

        if ($wargas->isEmpty()) {
            $this->command->info('Tidak ada data warga! Jalankan WargaSeeder terlebih dahulu.');
            return;
        }

        $umkmData = [];

        // Kategori sesuai permintaan
        $kategoriUmkm = [
            'Makanan & Minuman',
            'Kerajinan Tangan',
            'Pertanian',
            'Peternakan',
            'Jasa',
            'Perdagangan',
            'Industri Kecil',
            'Lainnya'
        ];

        foreach ($wargas->take(90) as $warga) {
            // Generate nama usaha berdasarkan kategori random
            $kategori = $kategoriUmkm[array_rand($kategoriUmkm)];
            $namaUsaha = $this->generateNamaUsaha($faker, $kategori);

            $umkmData[] = [
                'nama_usaha'     => $namaUsaha,
                'pemilik_warga_id' => $warga->warga_id,
                'alamat'         => $warga->alamat,
                'rt'             => $warga->rt,
                'rw'             => $warga->rw,
                'kategori'       => $kategori,
                'kontak'         => $warga->telp,
                'deskripsi'      => $faker->paragraph(2),
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        DB::table('umkm')->insert($umkmData);

        $this->command->info('Berhasil menambahkan ' . count($umkmData) . ' data UMKM.');
    }

    private function generateNamaUsaha($faker, $kategori)
    {
        switch ($kategori) {
            case 'Makanan & Minuman':
                $prefix = $faker->randomElement(['Warung Makan', 'Kedai Kopi', 'Rumah Makan', 'Warung Nasi', 'Kafe', 'Restoran', 'Warkop', 'Bakso', 'Mie Ayam', 'Es']);
                return $prefix . ' ' . $faker->firstName();

            case 'Kerajinan Tangan':
                $prefix = $faker->randomElement(['Kerajinan', 'Usaha', 'Sentra', 'Produksi']);
                $material = $faker->randomElement(['Kayu', 'Bambu', 'Rotan', 'Tanah Liat', 'Sablon', 'Bordir', 'Tenun', 'Batik']);
                return $prefix . ' ' . $material . ' ' . $faker->lastName();

            case 'Pertanian':
                $prefix = $faker->randomElement(['Kebun', 'Usaha Tani', 'Budidaya', 'Toko Bibit']);
                $product = $faker->randomElement(['Sayur', 'Buah', 'Padi', 'Jagung', 'Cabe', 'Tomat']);
                return $prefix . ' ' . $product . ' ' . $faker->firstName();

            case 'Peternakan':
                $prefix = $faker->randomElement(['Peternakan', 'Usaha', 'Budidaya', 'Kandang']);
                $animal = $faker->randomElement(['Ayam', 'Sapi', 'Kambing', 'Bebek', 'Ikan', 'Lele']);
                return $prefix . ' ' . $animal . ' ' . $faker->lastName();

            case 'Jasa':
                $prefix = $faker->randomElement(['Bengkel', 'Salon', 'Laundry', 'Jasa Service', 'Potong Rambut', 'Rental']);
                $service = $faker->randomElement(['Motor', 'Mobil', 'AC', 'Kulkas', 'TV', 'Komputer']);
                return $prefix . ' ' . $service . ' ' . $faker->firstName();

            case 'Perdagangan':
                $prefix = $faker->randomElement(['Toko', 'Minimarket', 'Warung', 'Kios']);
                $product = $faker->randomElement(['Sembako', 'Kelontong', 'Bangunan', 'Elektronik', 'Pakaian']);
                return $prefix . ' ' . $product . ' ' . $faker->lastName();

            case 'Industri Kecil':
                $prefix = $faker->randomElement(['Industri', 'Produksi', 'Home Industry', 'Usaha Pengolahan']);
                $product = $faker->randomElement(['Makanan', 'Minuman', 'Kerajinan', 'Ikan', 'Daging']);
                return $prefix . ' ' . $product . ' ' . $faker->firstName();

            default: // lainnya
                return $faker->randomElement(['UD', 'CV', 'Usaha', 'Bisnis']) . ' ' . $faker->lastName() . ' ' . $faker->randomElement(['Jaya', 'Sejahtera', 'Makmur']);
        }
    }
}
