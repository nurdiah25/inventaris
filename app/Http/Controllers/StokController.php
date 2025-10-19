<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Barang;
use App\Models\Cabang;
use Illuminate\Http\Request;

class StokController extends Controller
{
    // === TAMPILKAN HALAMAN STOK PER CABANG ===
    public function index($cabang)
    {
        $cabangData = Cabang::where('slug', strtolower($cabang))->firstOrFail();
        $stoks = Stok::with('barang')->where('id_cabang', $cabangData->id_cabang)->get();
        $barangs = Barang::where('id_cabang', $cabangData->id_cabang)->get();

        return view("{$cabangData->slug}.stok", compact('stoks', 'barangs', 'cabangData'));
    }

    // === TAMBAH STOK BARU ===
    public function store(Request $request, $cabang)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah_masuk' => 'required|integer|min:0',
            'tanggal' => 'required|date',
        ]);

        $cabangData = Cabang::where('slug', strtolower($cabang))->firstOrFail();

        // Tambah stok
        $stok = Stok::create([
            'id_barang' => $request->id_barang,
            'id_cabang' => $cabangData->id_cabang,
            'jumlah_masuk' => $request->jumlah_masuk,
            'tanggal' => $request->tanggal,
        ]);

        // Update stok barang
        $barang = Barang::find($request->id_barang);
        if ($barang) {
            $barang->stok += $request->jumlah_masuk;
            $barang->save();
        }

        return redirect()->route($cabangData->slug . '.stok')->with('success', 'Data stok berhasil ditambahkan.');
    }

    // === UPDATE DATA STOK ===
    public function update(Request $request, $cabang, $id_stok)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah_masuk' => 'required|integer|min:0',
            'tanggal' => 'required|date',
        ]);

        $cabangData = Cabang::where('slug', strtolower($cabang))->firstOrFail();
        $stok = Stok::findOrFail($id_stok);

        // Kurangi stok lama
        $barangLama = Barang::find($stok->id_barang);
        if ($barangLama) {
            $barangLama->stok -= $stok->jumlah_masuk;
            if ($barangLama->stok < 0) $barangLama->stok = 0;
            $barangLama->save();
        }

        // Update stok baru
        $stok->update([
            'id_barang' => $request->id_barang,
            'jumlah_masuk' => $request->jumlah_masuk,
            'tanggal' => $request->tanggal,
        ]);

        // Tambah stok baru ke barang tujuan
        $barangBaru = Barang::find($request->id_barang);
        if ($barangBaru) {
            $barangBaru->stok += $request->jumlah_masuk;
            $barangBaru->save();
        }

        return redirect()->route($cabangData->slug . '.stok')->with('success', 'Data stok berhasil diperbarui.');
    }

    // === HAPUS DATA STOK ===
    public function destroy($cabang, $id_stok)
    {
        $cabangData = Cabang::where('slug', strtolower($cabang))->firstOrFail();
        $stok = Stok::findOrFail($id_stok);
        $barang = Barang::find($stok->id_barang);

        if ($barang) {
            $barang->stok -= $stok->jumlah_masuk;
            if ($barang->stok < 0) $barang->stok = 0;
            $barang->save();
        }

        $stok->delete();

        return redirect()->route($cabangData->slug . '.stok')->with('success', 'Data stok berhasil dihapus.');
    }
}
