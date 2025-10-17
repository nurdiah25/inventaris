<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cabang;
use App\Models\Gudang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // === UNTUK CABANG ===
    public function index($cabang)
    {
        $allowed = ['banjarbaru', 'martapura', 'lianganggang'];

        if (!in_array($cabang, $allowed)) {
            abort(404, 'Cabang tidak ditemukan.');
        }

        $cabangData = Cabang::where('nama_cabang', $cabang)->first();

        if (!$cabangData) {
            abort(404, 'Data cabang belum dibuat di database.');
        }

        $barangs = Barang::where('id_cabang', $cabangData->id_cabang)->get();

        return view("$cabang.barang", compact('barangs', 'cabangData'));
    }

    public function store(Request $request, $cabang)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'harga' => 'nullable|integer',
            'stok' => 'required|integer',
        ]);

        $cabangData = Cabang::where('nama_cabang', $cabang)->firstOrFail();

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'id_cabang' => $cabangData->id_cabang,
        ]);

        return redirect()->route("{$cabang}.barang")->with('success', 'Barang berhasil ditambahkan.');
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

        return redirect()->route("{$cabang}.barang")->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($cabang, $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $barang->delete();

        return redirect()->route("{$cabang}.barang")->with('success', 'Barang berhasil dihapus.');
    }

    // === UNTUK GUDANG ===
    public function indexGudang()
    {
        $gudangData = Gudang::where('nama_gudang', 'GudangPusat')->first();

        if (!$gudangData) {
            abort(404, 'Data Gudang Pusat belum dibuat di database.');
        }

        $barangs = Barang::where('id_gudang', $gudangData->id_gudang)->get();

        return view('gudang.barang', compact('barangs', 'gudangData'));
    }

    public function storeGudang(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'harga' => 'nullable|integer',
            'stok' => 'required|integer',
        ]);

        $gudangData = Gudang::where('nama_gudang', 'GudangPusat')->firstOrFail();

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'id_gudang' => $gudangData->id_gudang,
        ]);

        return redirect()->route('gudang.barang')->with('success', 'Barang berhasil ditambahkan ke Gudang Pusat.');
    }

    public function updateGudang(Request $request, $id_barang)
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

        return redirect()->route('gudang.barang')->with('success', 'Barang gudang berhasil diperbarui.');
    }

    public function destroyGudang($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $barang->delete();

        return redirect()->route('gudang.barang')->with('success', 'Barang gudang berhasil dihapus.');
    }
}
