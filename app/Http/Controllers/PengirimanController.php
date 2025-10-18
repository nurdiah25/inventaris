<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Barang;
use App\Models\Stok;
use App\Models\Cabang;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    // === Halaman daftar pengiriman dari GudangPusat ===
    public function index()
    {
        $gudangData = Cabang::where('nama_cabang', 'gudangpusat')->firstOrFail();
        $pengiriman = Pengiriman::with('barang')
            ->where('id_cabang', $gudangData->id_cabang)
            ->latest()
            ->get();
        $barangs = Barang::where('id_cabang', $gudangData->id_cabang)->get();
        $cabangs = Cabang::where('nama_cabang', '!=', 'gudangpusat')->get();

        return view('gudangpusat.pengiriman', compact('pengiriman', 'barangs', 'cabangs', 'gudangData'));
    }

    // === Tambah pengiriman dari GudangPusat ke cabang ===
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'tujuan_pengiriman' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengiriman' => 'required|date',
        ]);

        $gudangData = Cabang::where('nama_cabang', 'gudangpusat')->firstOrFail();
        $barang = Barang::findOrFail($request->id_barang);

        if ($barang->stok < $request->jumlah) {
            return back()->with('error', 'Stok di Gudang Pusat tidak mencukupi.');
        }

        Pengiriman::create([
            'id_barang' => $barang->id_barang,
            'id_cabang' => $gudangData->id_cabang,
            'tujuan_pengiriman' => $request->tujuan_pengiriman,
            'jumlah' => $request->jumlah,
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'status_pengiriman' => 'Dikemas',
        ]);

        $barang->stok -= $request->jumlah;
        $barang->save();

        Stok::create([
            'id_barang' => $barang->id_barang,
            'id_cabang' => $gudangData->id_cabang,
            'jumlah_keluar' => $request->jumlah,
            'tanggal' => $request->tanggal_pengiriman,
        ]);

        return redirect()->route('gudangpusat.pengiriman')->with('success', 'Pengiriman berhasil ditambahkan.');
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

        return redirect()->route('gudangpusat.pengiriman')->with('success', 'Data pengiriman berhasil dihapus.');
    }

    // === Riwayat Pengiriman ke Cabang ===
    public function riwayat($cabang)
    {
        $cabangData = Cabang::where('nama_cabang', $cabang)->firstOrFail();

    // Ambil semua pengiriman dari gudangpusat ke cabang ini
        $riwayat = Pengiriman::with('barang')
            ->where('tujuan_pengiriman', $cabangData->nama_cabang)
            ->latest()
            ->get();

        return view("$cabang.riwayat", compact('riwayat', 'cabangData'));
    }

}
