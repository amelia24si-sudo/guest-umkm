<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateProduk extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Ambil data UMKM yang sudah ada
        $umkms = DB::table('umkm')->get();

        if ($umkms->isEmpty()) {
            $this->command->info('Tidak ada data UMKM! Jalankan CreateUmkmSeeder terlebih dahulu.');
            return;
        }

        $produkData = [];

        // Daftar kategori produk berdasarkan kategori UMKM
        $kategoriProduk = [
            'Makanan & Minuman' => [
                'Makanan Ringan', 'Minuman Kemasan', 'Makanan Olahan', 'Minuman Tradisional',
                'Kue & Roti', 'Makanan Beku', 'Sambal & Bumbu', 'Makanan Instan'
            ],
            'Kerajinan Tangan' => [
                'Aksesoris', 'Dekorasi Rumah', 'Perhiasan', 'Kerajinan Kayu',
                'Kerajinan Bambu', 'Kerajinan Rotan', 'Batik', 'Tenun'
            ],
            'Pertanian' => [
                'Sayuran Segar', 'Buah-buahan', 'Beras Organik', 'Tanaman Obat',
                'Bibit Tanaman', 'Pupuk Organik', 'Bunga Potong', 'Rempah-rempah'
            ],
            'Peternakan' => [
                'Daging Segar', 'Telur', 'Susu', 'Madu',
                'Ikan Segar', 'Unggas', 'Hasil Olahan Daging', 'Pakan Ternak'
            ],
            'Jasa' => [
                'Jasa Perbaikan', 'Jasa Kebersihan', 'Jasa Transportasi', 'Jasa Pengiriman',
                'Jasa Konsultasi', 'Jasa Pendidikan', 'Jasa Kesehatan', 'Jasa Teknologi'
            ],
            'Perdagangan' => [
                'Sembako', 'Elektronik', 'Pakaian', 'Alat Rumah Tangga',
                'Perlengkapan Kantor', 'Mainan', 'Alat Tulis', 'Bahan Bangunan'
            ],
            'Industri Kecil' => [
                'Mebel', 'Pakaian Jadi', 'Alat Dapur', 'Kerajinan Logam',
                'Produk Plastik', 'Kemasan', 'Alat Pertanian', 'Perlengkapan Ternak'
            ],
            'Lainnya' => [
                'Produk Digital', 'Voucher', 'Layanan Online', 'Produk Kreatif',
                'Barang Antik', 'Koleksi', 'Produk Lokal', 'Kerajinan Unik'
            ]
        ];

        $totalProduk = 0;
        $produkPerUmkm = 3; // Setiap UMKM memiliki 3 produk

        foreach ($umkms as $umkm) {
            // Tentukan kategori berdasarkan kategori UMKM
            $kategoriUmkm = $umkm->kategori;
            $subKategoriList = $kategoriProduk[$kategoriUmkm] ?? $kategoriProduk['Lainnya'];

            for ($i = 0; $i < $produkPerUmkm; $i++) {
                // Pilih subkategori random
                $subKategori = $faker->randomElement($subKategoriList);

                // Generate nama produk berdasarkan kategori
                $namaProduk = $this->generateNamaProduk($faker, $kategoriUmkm, $subKategori);

                $produkData[] = [
                    'umkm_id'      => $umkm->umkm_id,
                    'nama_produk'  => $namaProduk,
                    'deskripsi'    => $faker->paragraph(3),
                    'harga'        => $faker->numberBetween(10000, 1000000),
                    'stok'         => $faker->numberBetween(5, 100),
                    'status'       => $faker->randomElement(['aktif', 'nonaktif']),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];

                $totalProduk++;
            }
        }

        // Insert data produk
        DB::table('produk')->insert($produkData);

        $this->command->info("✅ Berhasil menambahkan {$totalProduk} data produk.");

        // Ambil semua produk yang baru saja dibuat
        $allProduk = DB::table('produk')->get();

        // Tambahkan gambar untuk 50 produk pertama
        $produkDenganGambar = $allProduk->take(50);
        $this->seedMediaForProduk($produkDenganGambar);
    }

    private function generateNamaProduk($faker, $kategoriUmkm, $subKategori)
    {
        $prefixes = [
            'Makanan & Minuman' => ['Special', 'Premium', 'Homemade', 'Original', 'Tradisional'],
            'Kerajinan Tangan' => ['Handmade', 'Eksklusif', 'Unik', 'Custom', 'Limited Edition'],
            'Pertanian' => ['Organik', 'Fresh', 'Alami', 'Berkualitas', 'Segar'],
            'Peternakan' => ['Fresh', 'Premium', 'Berkualitas', 'Pilihan', 'Terbaik'],
            'Jasa' => ['Professional', 'Premium', 'Express', 'Standard', 'Custom'],
            'Perdagangan' => ['Original', 'Berkualitas', 'Murah', 'Terlaris', 'Populer'],
            'Industri Kecil' => ['Produksi', 'Handmade', 'Custom', 'Berkualitas', 'Lokal'],
            'Lainnya' => ['Special', 'Unique', 'Limited', 'Custom', 'Premium']
        ];

        $prefixList = $prefixes[$kategoriUmkm] ?? $prefixes['Lainnya'];
        $prefix = $faker->randomElement($prefixList);

        // Nama produk berdasarkan kategori
        switch ($kategoriUmkm) {
            case 'Makanan & Minuman':
                $baseName = $faker->randomElement(['Nasi', 'Mie', 'Soto', 'Bakso', 'Rendang', 'Sate', 'Kue', 'Minuman']);
                return "{$prefix} {$baseName} {$subKategori}";

            case 'Kerajinan Tangan':
                $material = $faker->randomElement(['Kayu', 'Bambu', 'Rotan', 'Besi', 'Kain']);
                return "{$prefix} {$material} {$subKategori}";

            case 'Pertanian':
                $type = $faker->randomElement(['Sayur', 'Buah', 'Bibit', 'Pupuk', 'Tanaman']);
                return "{$prefix} {$type} {$subKategori}";

            case 'Peternakan':
                $animal = $faker->randomElement(['Ayam', 'Sapi', 'Kambing', 'Ikan', 'Bebek']);
                return "{$prefix} {$animal} {$subKategori}";

            case 'Jasa':
                $serviceType = $faker->randomElement(['Service', 'Perbaikan', 'Konsultasi', 'Pengiriman', 'Pembersihan']);
                return "{$prefix} {$serviceType} {$subKategori}";

            case 'Perdagangan':
                $productType = $faker->randomElement(['Produk', 'Barang', 'Alat', 'Bahan', 'Perlengkapan']);
                return "{$prefix} {$productType} {$subKategori}";

            case 'Industri Kecil':
                $productType = $faker->randomElement(['Produk', 'Hasil', 'Kerajinan', 'Barang', 'Alat']);
                return "{$prefix} {$productType} {$subKategori}";

            default:
                return "{$prefix} {$subKategori} " . $faker->word();
        }
    }

    /**
     * Menambahkan data media (gambar) untuk produk
     */
    private function seedMediaForProduk($produkList)
    {
        $mediaData = [];
        $faker = Factory::create('id_ID');

        $this->command->info('Menyiapkan gambar untuk 50 produk pertama...');

        foreach ($produkList as $index => $produk) {
            try {
                // Tentukan jumlah gambar (1-2 gambar per produk)
                $jumlahGambar = rand(1, 2);

                for ($i = 1; $i <= $jumlahGambar; $i++) {
                    // Generate nama file unik
                    $fileName = 'produk_' . $produk->produk_id . '_' . time() . '_' . $i . '.jpg';
                    $filePath = 'produk/images/' . $fileName;

                    // Download gambar dari Picsum Photos dengan tema sesuai kategori
                    $this->downloadProductImage($filePath, $produk->nama_produk);

                    $mediaData[] = [
                        'ref_table'   => 'produk',
                        'ref_id'      => $produk->produk_id,
                        'file_nama'   => $filePath,
                        'caption'     => $faker->sentence(3),
                        'mime_type'   => 'image/jpeg',
                        'sort_order'  => $i,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ];
                }

                // Progress indicator
                if (($index + 1) % 10 === 0) {
                    $this->command->info("  ✓ Telah diproses " . ($index + 1) . " produk");
                }

            } catch (\Exception $e) {
                $this->command->error("  ✗ Gagal membuat gambar untuk Produk ID {$produk->produk_id}: " . $e->getMessage());
            }
        }

        // Insert data media
        if (!empty($mediaData)) {
            DB::table('media')->insert($mediaData);
            $this->command->info("✅ Berhasil menambahkan " . count($mediaData) . " data media (gambar) untuk 50 produk pertama.");
        } else {
            $this->command->warn('⚠ Tidak ada data media yang berhasil dibuat');
        }
    }

    /**
     * Download gambar produk dari Picsum Photos dengan tema tertentu
     */
    private function downloadProductImage($destinationPath, $productName)
    {
        // Ukuran gambar produk
        $width = 600;
        $height = 600;

        // Tentukan image ID berdasarkan kategori produk
        $imageId = $this->getImageIdByProductCategory($productName);

        // URL Picsum Photos
        $imageUrl = "https://picsum.photos/id/{$imageId}/{$width}/{$height}";

        // Tambahkan delay untuk menghindari rate limit
        usleep(50000); // 0.05 detik

        // Context untuk request
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
            'http' => [
                'timeout' => 10,
                'header' => "User-Agent: Laravel Produk Seeder\r\n"
            ]
        ]);

        $imageContent = @file_get_contents($imageUrl, false, $context);

        if ($imageContent === false) {
            // Jika gagal, gunakan URL random
            $imageUrl = "https://picsum.photos/{$width}/{$height}?random=" . rand(1, 10000);
            $imageContent = @file_get_contents($imageUrl, false, $context);
        }

        if ($imageContent === false) {
            // Buat gambar dummy sebagai fallback
            $imageContent = $this->createDummyImage($width, $height, $productName);
        }

        // Simpan ke storage
        Storage::disk('public')->put($destinationPath, $imageContent);
    }

    /**
     * Mendapatkan image ID berdasarkan kategori produk
     */
    private function getImageIdByProductCategory($productName)
    {
        $lowerName = strtolower($productName);

        // Mapping image ID berdasarkan kata kunci
        if (strpos($lowerName, 'makanan') !== false || strpos($lowerName, 'minuman') !== false) {
            // Gambar makanan
            return rand(300, 350); // Range ID untuk makanan
        } elseif (strpos($lowerName, 'kerajinan') !== false || strpos($lowerName, 'tangan') !== false) {
            // Gambar kerajinan
            return rand(400, 450); // Range ID untuk kerajinan
        } elseif (strpos($lowerName, 'pertanian') !== false || strpos($lowerName, 'sayur') !== false || strpos($lowerName, 'buah') !== false) {
            // Gambar pertanian
            return rand(200, 250); // Range ID untuk pertanian
        } elseif (strpos($lowerName, 'peternakan') !== false || strpos($lowerName, 'daging') !== false) {
            // Gambar peternakan
            return rand(100, 150); // Range ID untuk hewan
        } elseif (strpos($lowerName, 'jasa') !== false) {
            // Gambar jasa
            return rand(500, 550); // Range ID untuk jasa
        } else {
            // Random untuk lainnya
            return rand(1, 1000);
        }
    }

    /**
     * Membuat gambar dummy sebagai fallback
     */
    private function createDummyImage($width, $height, $text)
    {
        // Buat gambar dengan GD
        $image = imagecreate($width, $height);

        // Warna background
        $bgColor = imagecolorallocate($image,
            rand(200, 255),
            rand(200, 255),
            rand(200, 255)
        );

        // Warna text
        $textColor = imagecolorallocate($image, 50, 50, 50);

        // Isi background
        imagefill($image, 0, 0, $bgColor);

        // Tambahkan border
        $borderColor = imagecolorallocate($image, 100, 100, 100);
        imagerectangle($image, 0, 0, $width-1, $height-1, $borderColor);

        // Potong text jika terlalu panjang
        $displayText = substr($text, 0, 30);
        if (strlen($text) > 30) {
            $displayText .= '...';
        }

        // Tambahkan teks produk
        $fontSize = 5; // GD built-in font
        $textWidth = imagefontwidth($fontSize) * strlen($displayText);
        $textHeight = imagefontheight($fontSize);
        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2;

        imagestring($image, $fontSize, $x, $y, $displayText, $textColor);

        // Tambahkan teks "PRODUK"
        imagestring($image, 5, 10, 10, 'PRODUK', $textColor);

        // Simpan ke memory
        ob_start();
        imagejpeg($image, null, 90);
        $imageData = ob_get_clean();
        imagedestroy($image);

        return $imageData;
    }
}
