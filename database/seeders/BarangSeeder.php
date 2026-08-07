<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Kategori; // 1. Wajib panggil model Kategori di sini

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 2. Kita ambil semua ID dari tabel kategoris yang udah ada
        // (Biar Faker-nya milih dari ID yang valid aja)
        $kategoriIds = Kategori::pluck('id')->toArray();

        // Kalau tabel kategori ternyata masih kosong, kita skip aja atau kasih warning
        if (empty($kategoriIds)) {
            $this->command->warn('Tabel Kategori kosong, Bos! Bikin kategori dulu gih.');
            return;
        }

        for ($i = 1; $i <= 20; $i++) {
            DB::table('barangs')->insert([
                'nama_barang' => $faker->words(2, true),
                
                // 3. Nah, ini yang diganti! 'kategori' jadi 'kategori_id'
                // Isinya diacak dari ID kategori yang beneran ada di database
                'kategori_id' => $faker->randomElement($kategoriIds), 
                
                'stok'        => $faker->numberBetween(10, 100),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}