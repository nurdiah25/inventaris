<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    // === TAMPILKAN DATA BARANG PER CABANG ===
    public function index(Request $request, $cabang = null)
    {
        $slug = strtolower(str_replace(' ', '', $cabang ?? $request->route('cabang')));
        $cabangData = Cabang::where('slug', $slug)->first();

        if (!$cabangData) {
            abort(404, 'Cabang tidak ditemukan.');
        }

        $barangs = Barang::where('id_cabang', $cabangData->id_cabang)->get();

        // Tentukan view dinamis
        $viewPath = resource_path("views/{$slug}/barang.blade.php");
        $view = File::exists($viewPath) ? "{$slug}.barang" : "banjarbaru.barang";

        return view($view, compact('barangs', 'cabangData'));
    }

    // === TAMBAH BARANG BARU ===
    public function store(Request $request, $cabang = null)
    {
        $slug = strtolower(str_replace(' ', '', $cabang ?? $request->route('cabang')));
        $cabangData = Cabang::where('slug', $slug)->firstOrFail();

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'nullable|integer',
            'stok' => 'required|integer|min:0',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'id_cabang' => $cabangData->id_cabang,
        ]);

        return redirect()->route("$slug.barang")->with('success', 'Barang berhasil ditambahkan.');
    }

    // === UPDATE BARANG ===
    public function update(Request $request, $id_barang, $cabang = null)
    {
        $slug = strtolower(str_replace(' ', '', $cabang ?? $request->route('cabang')));

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'nullable|integer',
            'stok' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id_barang);
        $barang->update($request->only(['nama_barang', 'harga', 'stok']));

        return redirect()->route("$slug.barang")->with('success', 'Barang berhasil diperbarui.');
    }

    // === HAPUS BARANG ===
    public function destroy($id_barang, $cabang = null)
    {
        $slug = strtolower(str_replace(' ', '', $cabang ?? request()->route('cabang')));

        $barang = Barang::findOrFail($id_barang);
        $barang->delete();

        return redirect()->route("$slug.barang")->with('success', 'Barang berhasil dihapus.');
    }
}
