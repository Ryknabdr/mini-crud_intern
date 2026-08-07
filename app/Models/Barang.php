<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Perhatikan: 'kategori' sekarang ganti jadi 'kategori_id'
    protected $fillable = [
        'nama_barang', 
        'kategori_id', 
        'stok'
    ];

    // Relasi: 1 Barang ini MILIK (belongsTo) 1 Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}