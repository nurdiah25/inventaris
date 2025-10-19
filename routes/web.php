<?php

use App\Models\Cabang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;

/*
|--------------------------------------------------------------------------
| Redirect Default ke Login
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Profile (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Superadmin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
});

/*
|--------------------------------------------------------------------------
| Gudang Pusat
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:gudangpusat'])->prefix('gudangpusat')->group(function () {
    Route::get('/barang', [BarangController::class, 'index'])->name('gudangpusat.barang')->defaults('cabang', 'gudangpusat');
    Route::post('/barang', [BarangController::class, 'store'])->name('gudangpusat.barang.store')->defaults('cabang', 'gudangpusat');
    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])->name('gudangpusat.barang.update')->defaults('cabang', 'gudangpusat');
    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])->name('gudangpusat.barang.destroy')->defaults('cabang', 'gudangpusat');

    Route::get('/stok', [StokController::class, 'index'])->name('gudangpusat.stok')->defaults('cabang', 'gudangpusat');
    Route::post('/stok', [StokController::class, 'store'])->name('gudangpusat.stok.store')->defaults('cabang', 'gudangpusat');
    Route::put('/stok/{id_stok}', [StokController::class, 'update'])->name('gudangpusat.stok.update')->defaults('cabang', 'gudangpusat');
    Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])->name('gudangpusat.stok.destroy')->defaults('cabang', 'gudangpusat');

    Route::get('/pengiriman', [PengirimanController::class, 'index'])->name('gudangpusat.pengiriman')->defaults('cabang', 'gudangpusat');
    Route::post('/pengiriman', [PengirimanController::class, 'store'])->name('gudangpusat.pengiriman.store')->defaults('cabang', 'gudangpusat');
    Route::put('/pengiriman/status/{id_pengiriman}', [PengirimanController::class, 'updateStatus'])->name('gudangpusat.pengiriman.updateStatus')->defaults('cabang', 'gudangpusat');
    Route::delete('/pengiriman/{id_pengiriman}', [PengirimanController::class, 'destroy'])->name('gudangpusat.pengiriman.destroy')->defaults('cabang', 'gudangpusat');
});

/*
|--------------------------------------------------------------------------
| Route Dinamis Semua Cabang dari Database
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    $cabangs = Cabang::select('slug')->get();

    foreach ($cabangs as $cabang) {
        $slug = $cabang->slug;

        Route::prefix($slug)->middleware("role:$slug")->group(function () use ($slug) {
            // Barang
            Route::get('/barang', [BarangController::class, 'index'])->name("$slug.barang")->defaults('cabang', $slug);
            Route::post('/barang', [BarangController::class, 'store'])->name("$slug.barang.store")->defaults('cabang', $slug);
            Route::put('/barang/{id_barang}', [BarangController::class, 'update'])->name("$slug.barang.update")->defaults('cabang', $slug);
            Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])->name("$slug.barang.destroy")->defaults('cabang', $slug);

            // Stok
            Route::get('/stok', [StokController::class, 'index'])->name("$slug.stok")->defaults('cabang', $slug);
            Route::post('/stok', [StokController::class, 'store'])->name("$slug.stok.store")->defaults('cabang', $slug);
            Route::put('/stok/{id_stok}', [StokController::class, 'update'])->name("$slug.stok.update")->defaults('cabang', $slug);
            Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])->name("$slug.stok.destroy")->defaults('cabang', $slug);

            // Riwayat
            Route::get('/riwayat', [PengirimanController::class, 'riwayat'])->name("$slug.riwayat")->defaults('cabang', $slug);
            Route::put('/riwayat/terima/{id_pengiriman}', [PengirimanController::class, 'updatePenerimaan'])->name("$slug.riwayat.terima")->defaults('cabang', $slug);
        });
    }
});

/*
|--------------------------------------------------------------------------
| Fallback Universal (agar Edit Barang tidak 404)
|--------------------------------------------------------------------------
*/
Route::any('/{cabang}/barang/{id_barang}', [BarangController::class, 'update'])
    ->where('cabang', '[A-Za-z0-9-_]+')
    ->name('barang.update.fallback');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
