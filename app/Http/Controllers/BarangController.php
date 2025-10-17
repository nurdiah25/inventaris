<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cabang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // === UNTUK CABANG (termasuk GudangPusat) ===
    public function index($cabang)
    {
        $allowed = ['banjarbaru', 'martapura', 'lianganggang', 'gudangpusat'];

        if (!in_array(strtolower($cabang), $allowed)) {
            abort(404, 'Cabang tidak ditemukan.');
        }

        $cabangData = Cabang::whereRaw('LOWER(REPLACE(nama_cabang, " ", "")) = ?', [strtolower(str_replace(' ', '', $cabang))])
            ->firstOrFail();

        $barangs = Barang::where('id_cabang', $cabangData->id_cabang)->get();

        return view(strtolower(str_replace(' ', '', $cabang)) . '.barang', compact('barangs', 'cabangData'));
    }

    public function store(Request $request, $cabang)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'harga' => 'nullable|integer',
            'stok' => 'required|integer',
        ]);

        $cabangData = Cabang::whereRaw('LOWER(REPLACE(nama_cabang, " ", "")) = ?', [strtolower(str_replace(' ', '', $cabang))])
            ->firstOrFail();

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'id_cabang' => $cabangData->id_cabang,
        ]);

        $routeName = strtolower(str_replace(' ', '', $cabang)) . '.barang';
        return redirect()->route($routeName)->with('success', 'Barang berhasil ditambahkan.');
    }

    public function update(Request $request, $cabang, $id_barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'nullable|integer',
            'stok' => 'required|integer',
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

    public function destroy($cabang, $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $barang->delete();

        $routeName = strtolower(str_replace(' ', '', $cabang)) . '.barang';
        return redirect()->route($routeName)->with('success', 'Barang berhasil dihapus.');
    }
}
