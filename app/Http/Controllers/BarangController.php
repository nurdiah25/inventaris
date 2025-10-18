<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cabang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // === TAMPILKAN DATA BARANG PER CABANG ===
    public function index($cabang)
    {
        // Validasi cabang agar tidak asal akses
        $allowed = ['banjarbaru', 'martapura', 'lianganggang', 'gudangpusat'];
        if (!in_array(strtolower($cabang), $allowed)) {
            abort(404, 'Cabang tidak ditemukan.');
        }

        // Ambil data cabang berdasarkan nama route
        $cabangData = Cabang::whereRaw(
            'LOWER(REPLACE(nama_cabang, " ", "")) = ?',
            [strtolower(str_replace(' ', '', $cabang))]
        )->firstOrFail();

        // Ambil semua barang milik cabang tersebut
        $barangs = Barang::where('id_cabang', $cabangData->id_cabang)->get();

        // Kirim ke view masing-masing cabang
        return view(strtolower(str_replace(' ', '', $cabang)) . '.barang', compact('barangs', 'cabangData'));
    }

    // === TAMBAH DATA BARANG BARU ===
    public function store(Request $request, $cabang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'nullable|integer',
            'stok' => 'required|integer|min:0',
        ]);

        $cabangData = Cabang::whereRaw(
            'LOWER(REPLACE(nama_cabang, " ", "")) = ?',
            [strtolower(str_replace(' ', '', $cabang))]
        )->firstOrFail();

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'id_cabang' => $cabangData->id_cabang,
        ]);

        $routeName = strtolower(str_replace(' ', '', $cabang)) . '.barang';
        return redirect()->route($routeName)->with('success', 'Barang berhasil ditambahkan.');
    }

    // === UPDATE DATA BARANG ===
    public function update(Request $request, $cabang, $id_barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'nullable|integer',
            'stok' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id_barang);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        $routeName = strtolower(str_replace(' ', '', $cabang)) . '.barang';
        return redirect()->route($routeName)->with('success', 'Barang berhasil diperbarui.');
    }

    // === HAPUS DATA BARANG ===
    public function destroy($cabang, $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $barang->delete();

        $routeName = strtolower(str_replace(' ', '', $cabang)) . '.barang';
        return redirect()->route($routeName)->with('success', 'Barang berhasil dihapus.');
    }
}
