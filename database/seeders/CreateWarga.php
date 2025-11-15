<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreateWarga extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID'); // Gunakan locale Indonesia

        foreach (range(1, 10) as $index) {
            DB::table('warga')->insert([
                'no_ktp'        => $faker->nik(), // Generate NIK Indonesia
                'nama'          => $faker->name(), // Generate nama lengkap
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan'     => $faker->jobTitle(),
                'telp'          => $faker->phoneNumber(),
                'email'         => $faker->unique()->safeEmail(),
                'alamat'        => $faker->address(),
                'rt'            => $faker->numberBetween(1, 10),
                'rw'            => $faker->numberBetween(1, 5),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
