<?php

use Illuminate\Support\Facades\Route;
// 1. TAMBAHIN INI BIAR LARAVEL KENAL SAMA CONTROLLER KITA
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::resource('kategori', KategoriController::class);
    Route::resource('barang', BarangController::class);
});



require __DIR__ . '/settings.php';