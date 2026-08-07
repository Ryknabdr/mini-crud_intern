<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KategoriController extends Controller
{
    // 1. Tampilkan List Kategori
    public function index()
    {
        // Pake 10 per halaman biar seragam sama Barang wkwkw
        $kategoris = Kategori::latest()->paginate(10); 
        
        return Inertia::render('Kategori/Index', [
            'kategoris' => $kategoris
        ]);
    }

    // 2. Halaman Tambah Kategori
    public function create()
    {
        return Inertia::render('Kategori/Create');
    }

    // 3. Proses Simpan Kategori
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
        ]);

        Kategori::create($validated);
        
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // 4. Halaman Edit Kategori
    public function edit(Kategori $kategori)
    {
        return Inertia::render('Kategori/Edit', [
            'kategori' => $kategori
        ]);
    }

    // 5. Proses Update Kategori
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori->id,
        ]);

        $kategori->update($validated);
        
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate!');
    }

    // 6. Proses Hapus Kategori
    public function destroy(Kategori $kategori)
    {
        // INI YANG DIBENERIN: Ubah barang() jadi barangs() biar cocok sama Model
        if ($kategori->barangs()->count() > 0) {
            return redirect()->route('kategori.index')->with('error', 'Kategori nggak bisa dihapus karena masih dipakai di Barang!');
        }

        $kategori->delete();
        
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}