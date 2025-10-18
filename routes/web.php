<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


// =======================
// CABANG BANJARBARU
// =======================
Route::prefix('banjarbaru')->group(function () {

    // Barang
    Route::get('/barang', [BarangController::class, 'index'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.barang');

    Route::post('/barang', [BarangController::class, 'store'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.barang.store');

    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.barang.update');

    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.barang.destroy');

    // Stok
    Route::get('/stok', [StokController::class, 'index'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.stok');

    Route::post('/stok', [StokController::class, 'store'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.stok.store');

    Route::put('/stok/{id_stok}', [StokController::class, 'update'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.stok.update');

    Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.stok.destroy');

    // Riwayat Pengiriman
    Route::get('/riwayat-pengiriman', [PengirimanController::class, 'riwayat'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.riwayat');

    Route::put('/riwayat-pengiriman/{id_pengiriman}/terima', [PengirimanController::class, 'updatePenerimaan'])
        ->defaults('cabang', 'banjarbaru') // sesuaikan tiap cabang
        ->name('banjarbaru.riwayat.terima');


// =======================
// CABANG MARTAPURA
// =======================
Route::prefix('martapura')->group(function () {

    // Barang
    Route::get('/barang', [BarangController::class, 'index'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.barang');

    Route::post('/barang', [BarangController::class, 'store'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.barang.store');

    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.barang.update');

    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.barang.destroy');

    // Stok
    Route::get('/stok', [StokController::class, 'index'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.stok');

    Route::post('/stok', [StokController::class, 'store'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.stok.store');

    Route::put('/stok/{id_stok}', [StokController::class, 'update'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.stok.update');

    Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.stok.destroy');

    // Pengiriman
    Route::get('/riwayat-pengiriman', [PengirimanController::class, 'riwayat'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.riwayat');

    Route::put('/riwayat-pengiriman/{id_pengiriman}/terima', [PengirimanController::class, 'updatePenerimaan'])
        ->defaults('cabang', 'martapura') // sesuaikan tiap cabang
        ->name('martapura.riwayat.terima');

});


// =======================
// CABANG LIANG ANGGANG
// =======================
Route::prefix('lianganggang')->group(function () {

    // Barang
    Route::get('/barang', [BarangController::class, 'index'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.barang');

    Route::post('/barang', [BarangController::class, 'store'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.barang.store');

    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.barang.update');

    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.barang.destroy');

    // Stok
    Route::get('/stok', [StokController::class, 'index'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.stok');

    Route::post('/stok', [StokController::class, 'store'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.stok.store');

    Route::put('/stok/{id_stok}', [StokController::class, 'update'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.stok.update');

    Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.stok.destroy');

    // Pengiriman
    Route::get('/riwayat-pengiriman', [PengirimanController::class, 'riwayat'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.riwayat');

    Route::put('/riwayat-pengiriman/{id_pengiriman}/terima', [PengirimanController::class, 'updatePenerimaan'])
        ->defaults('cabang', 'lianganggang') // sesuaikan tiap cabang
        ->name('lianganggang.riwayat.terima');

});


// =======================
// GUDANG PUSAT
// =======================
Route::prefix('gudangpusat')->group(function () {

    // Barang
    Route::get('/barang', [BarangController::class, 'index'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.barang');

    Route::post('/barang', [BarangController::class, 'store'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.barang.store');

    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.barang.update');

    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.barang.destroy');

    // Stok
    Route::get('/stok', [StokController::class, 'index'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.stok');

    Route::post('/stok', [StokController::class, 'store'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.stok.store');

    Route::put('/stok/{id_stok}', [StokController::class, 'update'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.stok.update');

    Route::delete('/stok/{id_stok}', [StokController::class, 'destroy'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.stok.destroy');

    // Pengiriman
    Route::get('/pengiriman', [PengirimanController::class, 'index'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.pengiriman');

    Route::post('/pengiriman', [PengirimanController::class, 'store'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.pengiriman.store');

    Route::put('/pengiriman/{id_pengiriman}/status', [PengirimanController::class, 'updateStatus'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.pengiriman.updateStatus');

    Route::delete('/pengiriman/{id_pengiriman}', [PengirimanController::class, 'destroy'])
        ->defaults('cabang', 'gudangpusat')
        ->name('gudangpusat.pengiriman.destroy');
});


});

