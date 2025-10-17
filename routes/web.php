<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PengirimanController;


Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// CABANG BANJARBARU
// =======================
Route::prefix('banjarbaru')->group(function () {

    // barang
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

    // PENGIRIMAN
    Route::get('/pengiriman', [PengirimanController::class, 'index'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.pengiriman');

    Route::post('/pengiriman', [PengirimanController::class, 'store'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.pengiriman.store');

    Route::put('/pengiriman/{id_pengiriman}/status', [PengirimanController::class, 'updateStatus'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.pengiriman.updateStatus');

    Route::delete('/pengiriman/{id_pengiriman}', [PengirimanController::class, 'destroy'])
        ->defaults('cabang', 'banjarbaru')
        ->name('banjarbaru.pengiriman.destroy');
});

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
    Route::get('/pengiriman', [PengirimanController::class, 'index'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.pengiriman');

    Route::post('/pengiriman', [PengirimanController::class, 'store'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.pengiriman.store');

    Route::put('/pengiriman/{id_pengiriman}/status', [PengirimanController::class, 'updateStatus'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.pengiriman.updateStatus'); 

    Route::delete('/pengiriman/{id_pengiriman}', [PengirimanController::class, 'destroy'])
        ->defaults('cabang', 'martapura')
        ->name('martapura.pengiriman.destroy');
});

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
    Route::get('/pengiriman', [PengirimanController::class, 'index'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.pengiriman');

    Route::post('/pengiriman', [PengirimanController::class, 'store'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.pengiriman.store');

    Route::put('/pengiriman/{id_pengiriman}/status', [PengirimanController::class, 'updateStatus'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.pengiriman.updateStatus'); 

    Route::delete('/pengiriman/{id_pengiriman}', [PengirimanController::class, 'destroy'])
        ->defaults('cabang', 'lianganggang')
        ->name('lianganggang.pengiriman.destroy');

// GUDANG
// =======================
Route::prefix('gudang')->group(function () {

    // Barang Gudang
    Route::get('/barang', [BarangController::class, 'indexGudang'])
        ->name('gudang.barang');

    Route::post('/barang', [BarangController::class, 'storeGudang'])
        ->name('gudang.barang.store');

    Route::put('/barang/{id_barang}', [BarangController::class, 'updateGudang'])
        ->name('gudang.barang.update');

    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroyGudang'])
        ->name('gudang.barang.destroy');

    // Stok Gudang
    Route::get('/stok', [StokController::class, 'indexGudang'])
        ->name('gudang.stok');

    Route::post('/stok', [StokController::class, 'storeGudang'])
        ->name('gudang.stok.store');

    Route::put('/stok/{id_stok}', [StokController::class, 'updateGudang'])
        ->name('gudang.stok.update');

    Route::delete('/stok/{id_stok}', [StokController::class, 'destroyGudang'])
        ->name('gudang.stok.destroy');

    // Pengiriman Gudang
    Route::get('/pengiriman', [PengirimanController::class, 'index'])
        ->name('gudang.pengiriman');

    Route::post('/pengiriman', [PengirimanController::class, 'store'])
        ->name('gudang.pengiriman.store');

    Route::put('/pengiriman/{id_pengiriman}/status', [PengirimanController::class, 'updateStatus'])
        ->name('gudang.pengiriman.updateStatus');

    Route::delete('/pengiriman/{id_pengiriman}', [PengirimanController::class, 'destroy'])
        ->name('gudang.pengiriman.destroy');
});


});
