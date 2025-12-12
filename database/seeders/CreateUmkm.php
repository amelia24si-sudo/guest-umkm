<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        foreach ($wargas->take(90) as $index => $warga) {
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

        // Insert data UMKM
        DB::table('umkm')->insert($umkmData);

        $this->command->info('Berhasil menambahkan ' . count($umkmData) . ' data UMKM.');

        // Ambil semua UMKM yang baru saja dibuat
        $allUmkms = DB::table('umkm')->get();

        // Tambahkan 1 gambar untuk 20 UMKM pertama
        $this->seedMediaForUmkm($allUmkms->take(20));
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

    /**
     * Menambahkan 1 data media (gambar) untuk setiap UMKM
     */
    private function seedMediaForUmkm($umkms)
    {
        $mediaData = [];
        $faker = Factory::create('id_ID');

        $this->command->info('Menyiapkan gambar untuk 20 UMKM pertama...');

        foreach ($umkms as $umkm) {
            try {
                // Generate nama file unik
                $fileName = 'umkm_' . $umkm->umkm_id . '_' . time() . '_' . rand(1000, 9999) . '.jpg';
                $filePath = 'umkm/images/' . $fileName;

                // Download gambar dari Picsum Photos
                $this->downloadPicsumImage($filePath);

                $mediaData[] = [
                    'ref_table'   => 'umkm',
                    'ref_id'      => $umkm->umkm_id,
                    'file_nama'   => $filePath,
                    'caption'     => $faker->sentence(3),
                    'mime_type'   => 'image/jpeg',
                    'sort_order'  => 1,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];

                $this->command->info("  ✓ Gambar untuk UMKM ID {$umkm->umkm_id} berhasil dibuat");

            } catch (\Exception $e) {
                $this->command->error("  ✗ Gagal membuat gambar untuk UMKM ID {$umkm->umkm_id}: " . $e->getMessage());
            }
        }

        // Insert data media
        if (!empty($mediaData)) {
            DB::table('media')->insert($mediaData);
            $this->command->info('✅ Berhasil menambahkan ' . count($mediaData) . ' data media (gambar) untuk 20 UMKM pertama.');
        } else {
            $this->command->warn('⚠ Tidak ada data media yang berhasil dibuat');
        }
    }

    /**
     * Download gambar dari Picsum Photos
     */
    private function downloadPicsumImage($destinationPath)
    {
        // Ukuran gambar
        $width = 800;
        $height = 600;

        // ID gambar unik untuk variasi
        $imageId = rand(1, 1000);

        // URL Picsum Photos dengan random seed
        $imageUrl = "https://picsum.photos/id/{$imageId}/{$width}/{$height}";

        // Tambahkan delay untuk menghindari rate limit
        usleep(100000); // 0.1 detik

        // Coba download gambar
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
            'http' => [
                'timeout' => 10, // Timeout 10 detik
                'header' => "User-Agent: Laravel Seeder\r\n"
            ]
        ]);

        $imageContent = @file_get_contents($imageUrl, false, $context);

        if ($imageContent === false) {
            // Jika gagal, gunakan URL alternatif
            $imageUrl = "https://picsum.photos/{$width}/{$height}?random=" . rand(1, 10000);
            $imageContent = @file_get_contents($imageUrl, false, $context);
        }

        if ($imageContent === false) {
            throw new \Exception("Gagal mengunduh gambar dari Picsum Photos");
        }

        // Simpan ke storage
        Storage::disk('public')->put($destinationPath, $imageContent);
    }
}
