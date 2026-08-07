<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori; // Pastiin modelnya di-import ya

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Pakaian'],
            ['nama_kategori' => 'Makanan & Minuman'],
            ['nama_kategori' => 'Peralatan Mandi'],
            ['nama_kategori' => 'Buku & Alat Tulis'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}