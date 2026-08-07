<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id(); // Bawaan Laravel (Primary Key)
            $table->string('nama_barang'); // Tipe teks pendek
            $table->integer('stok'); // Tipe angka bulat
            
            // ✅ Ini yang bener Bos, diganti jadi foreign key
            $table->foreignId('kategori_id')->constrained('kategoris')->cascadeOnDelete();
            
            $table->timestamps(); // Bawaan Laravel (created_at & updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};