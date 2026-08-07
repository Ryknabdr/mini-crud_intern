<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        // PENTING: Ubah bagian ini dari false menjadi true biar request nggak diblokir
        return true; 
    }

    public function rules(): array
    {
        return [
            // 1. Teks (Wajib diisi & maksimal 255 karakter biar aman)
            'nama_barang' => 'required|string|max:255', 
            
            // 2. Angka (Wajib angka & minimal 1)
            'stok'        => 'required|integer|min:1', 

            // 3. Relasi Database (Wajib diisi & ID-nya HARUS ada di tabel kategoris)
            'kategori_id' => 'required|exists:kategoris,id', 
        ];
    }

    // (BONUS) Pesan error custom pakai bahasa yang gampang dimengerti
    public function messages(): array
    {
        return [
            'nama_barang.required' => 'Nama barang nggak boleh kosong ya.',
            'stok.required'        => 'Stok wajib diisi.',
            'stok.min'             => 'Stok minimal harus 1.',
            'kategori_id.required' => 'Jangan lupa pilih kategori barangnya!',
            'kategori_id.exists'   => 'Kategori yang dipilih nggak valid.',
        ];
    }
}