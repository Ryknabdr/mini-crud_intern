<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Sesuaiin sama nama tabel kalau bahasa Indonesia
    protected $table = 'kategoris'; 
    protected $fillable = ['nama_kategori'];

    // Relasi: 1 Kategori punya BANYAK (hasMany) Barang
    public function barangs()
    {
        // Parameter kedua ('kategori_id') itu nama kolom foreign key di tabel barangs
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}