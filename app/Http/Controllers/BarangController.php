<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Inertia\Inertia;
use App\Http\Requests\StoreBarangRequest; 

class BarangController extends Controller
{
    // 1. Tampilkan Halaman Utama (Daftar List Barang)
    public function index()
    {
        // INI YANG BERUBAH: get() diganti jadi paginate(5)
        $items = Barang::with('kategori')->latest()->paginate(10); 
        
        return Inertia::render('Barang/Index', [
            'items' => $items
        ]);
    }

    // 2. Tampilkan Halaman Form Tambah Barang Baru
    public function create()
    {
        // Ambil semua data kategori buat ngisi Dropdown
        $kategoris = Kategori::all();

        return Inertia::render('Barang/Create', [
            'kategoris' => $kategoris 
        ]);
    }

    // 3. Proses Simpan Barang Baru ke Database
    public function store(StoreBarangRequest $request)
    {
        Barang::create($request->validated());
        
        return redirect()->route('barang.index');
    }

    // 4. Tampilkan Halaman Form Edit Barang
    public function edit(Barang $barang)
    {
        // Ambil data kategori juga buat form edit
        $kategoris = Kategori::all();

        return Inertia::render('Barang/Edit', [
            'item' => $barang,
            'kategoris' => $kategoris 
        ]);
    }

    // 5. Proses Update Data Barang ke Database
    public function update(StoreBarangRequest $request, Barang $barang)
    {
        $barang->update($request->validated());
        
        return redirect()->route('barang.index');
    }

    // 6. Proses Hapus Barang
    public function destroy(Barang $barang)
    {
        $barang->delete();
        
        return redirect()->route('barang.index');
    }
}