<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Barang;
use App\Models\Cabang;
use App\Models\Gudang;
use Illuminate\Http\Request;

class StokController extends Controller
{
    // === UNTUK CABANG ===
    public function index($cabang)
    {
        $allowed = ['banjarbaru', 'martapura', 'lianganggang'];

        if (!in_array($cabang, $allowed)) {
            abort(404, 'Cabang tidak ditemukan.');
        }

        $cabangData = Cabang::where('nama_cabang', $cabang)->firstOrFail();
        $stoks = Stok::with('barang')->where('id_cabang', $cabangData->id_cabang)->get();
        $barangs = Barang::where('id_cabang', $cabangData->id_cabang)->get();

        return view("$cabang.stok", compact('stoks', 'barangs', 'cabangData'));
    }

    public function store(Request $request, $cabang)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah_masuk' => 'nullable|integer|min:0',
            'jumlah_keluar' => 'nullable|integer|min:0',
            'tanggal' => 'required|date',
        ]);

        $cabangData = Cabang::where('nama_cabang', $cabang)->firstOrFail();

        Stok::create([
            'id_barang' => $request->id_barang,
            'id_cabang' => $cabangData->id_cabang,
            'jumlah_masuk' => $request->jumlah_masuk ?? 0,
            'jumlah_keluar' => $request->jumlah_keluar ?? 0,
            'tanggal' => $request->tanggal,
        ]);

        // update stok barang
        $barang = Barang::find($request->id_barang);
        if ($barang) {
            $barang->stok += ($request->jumlah_masuk ?? 0);
            $barang->stok -= ($request->jumlah_keluar ?? 0);
            if ($barang->stok < 0) $barang->stok = 0;
            $barang->save();
        }

        return redirect()->route("{$cabang}.stok")->with('success', 'Data stok berhasil ditambahkan.');
    }

    public function update(Request $request, $cabang, $id_stok)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah_masuk' => 'nullable|integer|min:0',
            'jumlah_keluar' => 'nullable|integer|min:0',
            'tanggal' => 'required|date',
        ]);

        $stok = Stok::findOrFail($id_stok);

        // kembalikan stok lama
        $barangLama = Barang::find($stok->id_barang);
        if ($barangLama) {
            $barangLama->stok -= $stok->jumlah_masuk;
            $barangLama->stok += $stok->jumlah_keluar;
            if ($barangLama->stok < 0) $barangLama->stok = 0;
            $barangLama->save();
        }

        $stok->update([
            'id_barang' => $request->id_barang,
            'jumlah_masuk' => $request->jumlah_masuk ?? 0,
            'jumlah_keluar' => $request->jumlah_keluar ?? 0,
            'tanggal' => $request->tanggal,
        ]);

        // update stok baru
        $barangBaru = Barang::find($request->id_barang);
        if ($barangBaru) {
            $barangBaru->stok += $request->jumlah_masuk ?? 0;
            $barangBaru->stok -= $request->jumlah_keluar ?? 0;
            if ($barangBaru->stok < 0) $barangBaru->stok = 0;
            $barangBaru->save();
        }

        return redirect()->route("{$cabang}.stok")->with('success', 'Data stok berhasil diperbarui.');
    }

    public function destroy($cabang, $id_stok)
    {
        $stok = Stok::findOrFail($id_stok);

        $barang = Barang::find($stok->id_barang);
        if ($barang) {
            $barang->stok -= $stok->jumlah_masuk;
            $barang->stok += $stok->jumlah_keluar;
            if ($barang->stok < 0) $barang->stok = 0;
            $barang->save();
        }

        $stok->delete();

        return redirect()->route("{$cabang}.stok")->with('success', 'Data stok berhasil dihapus.');
    }

    // === UNTUK GUDANG ===
    public function indexGudang()
    {
        $gudangData = Gudang::where('nama_gudang', 'GudangPusat')->first();

        if (!$gudangData) {
            abort(404, 'Data Gudang Pusat belum dibuat di database.');
        }

        $stoks = Stok::with('barang')->where('id_gudang', $gudangData->id_gudang)->get();
        $barangs = Barang::where('id_gudang', $gudangData->id_gudang)->get();

        return view('gudang.stok', compact('stoks', 'barangs', 'gudangData'));
    }

    public function storeGudang(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah_masuk' => 'nullable|integer|min:0',
            'jumlah_keluar' => 'nullable|integer|min:0',
            'tanggal' => 'required|date',
        ]);

        $gudangData = Gudang::where('nama_gudang', 'GudangPusat')->firstOrFail();

        Stok::create([
            'id_barang' => $request->id_barang,
            'id_gudang' => $gudangData->id_gudang,
            'jumlah_masuk' => $request->jumlah_masuk ?? 0,
            'jumlah_keluar' => $request->jumlah_keluar ?? 0,
            'tanggal' => $request->tanggal,
        ]);

        // update stok barang
        $barang = Barang::find($request->id_barang);
        if ($barang) {
            $barang->stok += ($request->jumlah_masuk ?? 0);
            $barang->stok -= ($request->jumlah_keluar ?? 0);
            if ($barang->stok < 0) $barang->stok = 0;
            $barang->save();
        }

        return redirect()->route('gudang.stok')->with('success', 'Data stok gudang berhasil ditambahkan.');
    }

    public function updateGudang(Request $request, $id_stok)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah_masuk' => 'nullable|integer|min:0',
            'jumlah_keluar' => 'nullable|integer|min:0',
            'tanggal' => 'required|date',
        ]);

        $stok = Stok::findOrFail($id_stok);

        // kembalikan stok lama
        $barangLama = Barang::find($stok->id_barang);
        if ($barangLama) {
            $barangLama->stok -= $stok->jumlah_masuk;
            $barangLama->stok += $stok->jumlah_keluar;
            if ($barangLama->stok < 0) $barangLama->stok = 0;
            $barangLama->save();
        }

        $stok->update([
            'id_barang' => $request->id_barang,
            'jumlah_masuk' => $request->jumlah_masuk ?? 0,
            'jumlah_keluar' => $request->jumlah_keluar ?? 0,
            'tanggal' => $request->tanggal,
        ]);

        // update stok baru
        $barangBaru = Barang::find($request->id_barang);
        if ($barangBaru) {
            $barangBaru->stok += $request->jumlah_masuk ?? 0;
            $barangBaru->stok -= $request->jumlah_keluar ?? 0;
            if ($barangBaru->stok < 0) $barangBaru->stok = 0;
            $barangBaru->save();
        }

        return redirect()->route('gudang.stok')->with('success', 'Data stok gudang berhasil diperbarui.');
    }

    public function destroyGudang($id_stok)
    {
        $stok = Stok::findOrFail($id_stok);

        $barang = Barang::find($stok->id_barang);
        if ($barang) {
            $barang->stok -= $stok->jumlah_masuk;
            $barang->stok += $stok->jumlah_keluar;
            if ($barang->stok < 0) $barang->stok = 0;
            $barang->save();
        }

        $stok->delete();

        return redirect()->route('gudang.stok')->with('success', 'Data stok gudang berhasil dihapus.');
    }
}
