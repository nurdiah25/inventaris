<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Barang;
use App\Models\Cabang;
use Illuminate\Http\Request;

class StokController extends Controller
{
    // === TAMPILKAN HALAMAN STOK PER CABANG ===
    public function index($cabang = null)
    {
        $slug = strtolower(str_replace(' ', '', $cabang ?? request()->route('cabang')));
        $cabangData = Cabang::where('slug', $slug)->firstOrFail();

        $stoks = Stok::with('barang')->where('id_cabang', $cabangData->id_cabang)->get();
        $barangs = Barang::where('id_cabang', $cabangData->id_cabang)->get();

        return view("{$cabangData->slug}.stok", compact('stoks', 'barangs', 'cabangData'));
    }

    // === TAMBAH STOK BARU ===
    public function store(Request $request, $cabang = null)
    {
        $slug = strtolower(str_replace(' ', '', $cabang ?? $request->route('cabang')));
        $cabangData = Cabang::where('slug', $slug)->firstOrFail();

        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah_masuk' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        // Tambah stok ke tabel stok
        $stok = Stok::create([
            'id_barang' => $request->id_barang,
            'id_cabang' => $cabangData->id_cabang,
            'jumlah_masuk' => $request->jumlah_masuk,
            'tanggal' => $request->tanggal,
        ]);

        // Tambah stok ke barang terkait
        $barang = Barang::find($request->id_barang);
        if ($barang) {
            $barang->stok += $request->jumlah_masuk;
            $barang->save();
        }

        return redirect()->route("{$slug}.stok")->with('success', 'Data stok berhasil ditambahkan.');
    }

    // === UPDATE DATA STOK ===
    public function update(Request $request, $id_stok, $cabang = null)
    {
        $slug = strtolower(str_replace(' ', '', $cabang ?? $request->route('cabang')));
        $cabangData = Cabang::where('slug', $slug)->firstOrFail();

        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah_masuk' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $stok = Stok::findOrFail($id_stok);

        // Kurangi stok lama dari barang lama
        $barangLama = Barang::find($stok->id_barang);
        if ($barangLama) {
            $barangLama->stok -= $stok->jumlah_masuk;
            if ($barangLama->stok < 0) $barangLama->stok = 0;
            $barangLama->save();
        }

        // Update data stok
        $stok->update([
            'id_barang' => $request->id_barang,
            'jumlah_masuk' => $request->jumlah_masuk,
            'tanggal' => $request->tanggal,
        ]);

        // Tambahkan stok baru ke barang tujuan
        $barangBaru = Barang::find($request->id_barang);
        if ($barangBaru) {
            $barangBaru->stok += $request->jumlah_masuk;
            $barangBaru->save();
        }

        return redirect()->route("{$slug}.stok")->with('success', 'Data stok berhasil diperbarui.');
    }

    // === HAPUS DATA STOK ===
    public function destroy($id_stok, $cabang = null)
    {
        $slug = strtolower(str_replace(' ', '', $cabang ?? request()->route('cabang')));
        $cabangData = Cabang::where('slug', $slug)->firstOrFail();

        $stok = Stok::findOrFail($id_stok);
        $barang = Barang::find($stok->id_barang);

        if ($barang) {
            $barang->stok -= $stok->jumlah_masuk;
            if ($barang->stok < 0) $barang->stok = 0;
            $barang->save();
        }

        $stok->delete();

        return redirect()->route("{$slug}.stok")->with('success', 'Data stok berhasil dihapus.');
    }
}
