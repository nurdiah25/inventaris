<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Barang;
use App\Models\Stok;
use App\Models\Gudang;
use App\Models\Cabang;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    // === Halaman daftar pengiriman dari gudang ===
    public function index()
    {
        $gudangData = Gudang::where('nama_gudang', 'GudangPusat')->firstOrFail();
        $pengiriman = Pengiriman::with('barang')->where('id_gudang', $gudangData->id_gudang)->latest()->get();
        $barangs = Barang::where('id_gudang', $gudangData->id_gudang)->get();
        $cabangs = Cabang::all();

        return view('gudang.pengiriman', compact('pengiriman', 'barangs', 'cabangs', 'gudangData'));
    }

    // === Tambah pengiriman dari gudang ke cabang ===
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'tujuan_pengiriman' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengiriman' => 'required|date',
        ]);

        $gudangData = Gudang::where('nama_gudang', 'GudangPusat')->firstOrFail();
        $barang = Barang::findOrFail($request->id_barang);

        if ($barang->stok < $request->jumlah) {
            return back()->with('error', 'Stok barang di gudang tidak mencukupi.');
        }

        // Simpan data pengiriman
        Pengiriman::create([
            'id_barang' => $barang->id_barang,
            'id_gudang' => $gudangData->id_gudang,
            'tujuan_pengiriman' => $request->tujuan_pengiriman,
            'jumlah' => $request->jumlah,
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'status_pengiriman' => 'Dikemas',
        ]);

        // Kurangi stok barang di gudang
        $barang->stok -= $request->jumlah;
        $barang->save();

        // Catat stok keluar di tabel stok
        Stok::create([
            'id_barang' => $barang->id_barang,
            'id_gudang' => $gudangData->id_gudang,
            'jumlah_keluar' => $request->jumlah,
            'tanggal' => $request->tanggal_pengiriman,
        ]);

        return redirect()->route('gudang.pengiriman')->with('success', 'Pengiriman berhasil ditambahkan dan stok gudang diperbarui.');
    }

    // === Update status pengiriman ===
    public function updateStatus(Request $request, $id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->status_pengiriman = $request->status_pengiriman;
        $pengiriman->save();

        return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui.');
    }

    // === Hapus pengiriman ===
    public function destroy($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->delete();

        return redirect()->route('gudang.pengiriman')->with('success', 'Data pengiriman berhasil dihapus.');
    }
}
