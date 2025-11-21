<?php
namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateWarga extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID'); // Gunakan locale Indonesia

        foreach (range(1, 100) as $index) {
            DB::table('warga')->insert([
                'no_ktp'        => $faker->nik(),
                'nama'          => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
                'pekerjaan'     => $faker->jobTitle(),
                'telp'          => '08' . $faker->numerify('##########'),
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
