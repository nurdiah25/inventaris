<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\DashboardController;

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
| Dashboard (Superadmin & Semua Cabang)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Profile Routes (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ==================== CABANG BANJARBARU ====================
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:banjarbaru'])->prefix('banjarbaru')->group(function () {
    // Barang
    Route::get('/barang', [BarangController::class, 'index'])
        ->name('banjarbaru.barang')->defaults('cabang', 'banjarbaru');
    Route::post('/barang', [BarangController::class, 'store'])
        ->name('banjarbaru.barang.store')->defaults('cabang', 'banjarbaru');
    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])
        ->name('banjarbaru.barang.update')->defaults('cabang', 'banjarbaru');
    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])
        ->name('banjarbaru.barang.destroy')->defaults('cabang', 'banjarbaru');

    // Stok
    Route::get('/stok', [StokController::class, 'index'])
        ->name('banjarbaru.stok')->defaults('cabang', 'banjarbaru');
    Route::post('/stok', [StokController::class, 'store'])
        ->name('banjarbaru.stok.store')->defaults('cabang', 'banjarbaru');
    Route::put('/stok/{id_stok}', [StokController::class, 'update'])
        ->name('banjarbaru.stok.update')->defaults('cabang', 'banjarbaru');
    Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])
        ->name('banjarbaru.stok.destroy')->defaults('cabang', 'banjarbaru');

    // Riwayat Pengiriman (via PengirimanController)
    Route::get('/riwayat', [PengirimanController::class, 'riwayat'])
        ->name('banjarbaru.riwayat')->defaults('cabang', 'banjarbaru');
    Route::put('/riwayat/terima/{id_pengiriman}', [PengirimanController::class, 'updatePenerimaan'])
        ->name('banjarbaru.riwayat.terima')->defaults('cabang', 'banjarbaru');
});

/*
|--------------------------------------------------------------------------
| ==================== CABANG MARTAPURA ====================
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:martapura'])->prefix('martapura')->group(function () {
    // Barang
    Route::get('/barang', [BarangController::class, 'index'])
        ->name('martapura.barang')->defaults('cabang', 'martapura');
    Route::post('/barang', [BarangController::class, 'store'])
        ->name('martapura.barang.store')->defaults('cabang', 'martapura');
    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])
        ->name('martapura.barang.update')->defaults('cabang', 'martapura');
    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])
        ->name('martapura.barang.destroy')->defaults('cabang', 'martapura');

    // Stok
    Route::get('/stok', [StokController::class, 'index'])
        ->name('martapura.stok')->defaults('cabang', 'martapura');
    Route::post('/stok', [StokController::class, 'store'])
        ->name('martapura.stok.store')->defaults('cabang', 'martapura');
    Route::put('/stok/{id_stok}', [StokController::class, 'update'])
        ->name('martapura.stok.update')->defaults('cabang', 'martapura');
    Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])
        ->name('martapura.stok.destroy')->defaults('cabang', 'martapura');

    // Riwayat Pengiriman
    Route::get('/riwayat', [PengirimanController::class, 'riwayat'])
        ->name('martapura.riwayat')->defaults('cabang', 'martapura');
    Route::put('/riwayat/terima/{id_pengiriman}', [PengirimanController::class, 'updatePenerimaan'])
        ->name('martapura.riwayat.terima')->defaults('cabang', 'martapura');
});

/*
|--------------------------------------------------------------------------
| ==================== CABANG LIANG ANGGANG ====================
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:lianganggang'])->prefix('lianganggang')->group(function () {
    // Barang
    Route::get('/barang', [BarangController::class, 'index'])
        ->name('lianganggang.barang')->defaults('cabang', 'lianganggang');
    Route::post('/barang', [BarangController::class, 'store'])
        ->name('lianganggang.barang.store')->defaults('cabang', 'lianganggang');
    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])
        ->name('lianganggang.barang.update')->defaults('cabang', 'lianganggang');
    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])
        ->name('lianganggang.barang.destroy')->defaults('cabang', 'lianganggang');

    // Stok
    Route::get('/stok', [StokController::class, 'index'])
        ->name('lianganggang.stok')->defaults('cabang', 'lianganggang');
    Route::post('/stok', [StokController::class, 'store'])
        ->name('lianganggang.stok.store')->defaults('cabang', 'lianganggang');
    Route::put('/stok/{id_stok}', [StokController::class, 'update'])
        ->name('lianganggang.stok.update')->defaults('cabang', 'lianganggang');
    Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])
        ->name('lianganggang.stok.destroy')->defaults('cabang', 'lianganggang');

    // Riwayat Pengiriman
    Route::get('/riwayat', [PengirimanController::class, 'riwayat'])
        ->name('lianganggang.riwayat')->defaults('cabang', 'lianganggang');
    Route::put('/riwayat/terima/{id_pengiriman}', [PengirimanController::class, 'updatePenerimaan'])
        ->name('lianganggang.riwayat.terima')->defaults('cabang', 'lianganggang');
});

/*
|--------------------------------------------------------------------------
| ==================== GUDANG PUSAT ====================
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:gudangpusat'])->prefix('gudangpusat')->group(function () {
    // Barang
    Route::get('/barang', [BarangController::class, 'index'])
        ->name('gudangpusat.barang')->defaults('cabang', 'gudangpusat');
    Route::post('/barang', [BarangController::class, 'store'])
        ->name('gudangpusat.barang.store')->defaults('cabang', 'gudangpusat');
    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])
        ->name('gudangpusat.barang.update')->defaults('cabang', 'gudangpusat');
    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])
        ->name('gudangpusat.barang.destroy')->defaults('cabang', 'gudangpusat');

    // Stok
    Route::get('/stok', [StokController::class, 'index'])
        ->name('gudangpusat.stok')->defaults('cabang', 'gudangpusat');
    Route::post('/stok', [StokController::class, 'store'])
        ->name('gudangpusat.stok.store')->defaults('cabang', 'gudangpusat');
    Route::put('/stok/{id_stok}', [StokController::class, 'update'])
        ->name('gudangpusat.stok.update')->defaults('cabang', 'gudangpusat');
    Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])
        ->name('gudangpusat.stok.destroy')->defaults('cabang', 'gudangpusat');

    // Pengiriman (pusat)
    Route::get('/pengiriman', [PengirimanController::class, 'index'])
        ->name('gudangpusat.pengiriman')->defaults('cabang', 'gudangpusat');
    Route::post('/pengiriman', [PengirimanController::class, 'store'])
        ->name('gudangpusat.pengiriman.store')->defaults('cabang', 'gudangpusat');
    Route::put('/pengiriman/status/{id_pengiriman}', [PengirimanController::class, 'updateStatus'])
        ->name('gudangpusat.pengiriman.updateStatus')->defaults('cabang', 'gudangpusat');
    Route::delete('/pengiriman/{id_pengiriman}', [PengirimanController::class, 'destroy'])
        ->name('gudangpusat.pengiriman.destroy')->defaults('cabang', 'gudangpusat');
});

require __DIR__ . '/auth.php';
