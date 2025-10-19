<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Barang;
use App\Models\Stok;
use App\Models\Cabang;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    // === Halaman daftar pengiriman dari Gudang Pusat ===
    public function index()
    {
        $gudangData = Cabang::where('slug', 'gudangpusat')->firstOrFail();
        $pengiriman = Pengiriman::with('barang')
            ->where('id_cabang', $gudangData->id_cabang)
            ->latest()
            ->get();

        $barangs = Barang::where('id_cabang', $gudangData->id_cabang)->get();
        $cabangs = Cabang::where('slug', '!=', 'gudangpusat')->get();

        return view('gudangpusat.pengiriman', compact('pengiriman', 'barangs', 'cabangs', 'gudangData'));
    }

    // === Tambah pengiriman dari Gudang Pusat ke cabang ===
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'tujuan_pengiriman' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengiriman' => 'required|date',
        ]);

        $gudangData = Cabang::where('slug', 'gudangpusat')->firstOrFail();
        $barang = Barang::findOrFail($request->id_barang);

        if ($barang->stok < $request->jumlah) {
            return back()->with('error', 'Stok di Gudang Pusat tidak mencukupi.');
        }

        Pengiriman::create([
            'id_barang' => $barang->id_barang,
            'id_cabang' => $gudangData->id_cabang,
            'tujuan_pengiriman' => strtolower($request->tujuan_pengiriman),
            'jumlah' => $request->jumlah,
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'status_pengiriman' => 'Dikemas',
        ]);

        // Kurangi stok gudang
        $barang->stok -= $request->jumlah;
        $barang->save();

        // Catat di tabel stok keluar
        Stok::create([
            'id_barang' => $barang->id_barang,
            'id_cabang' => $gudangData->id_cabang,
            'jumlah_keluar' => $request->jumlah,
            'tanggal' => $request->tanggal_pengiriman,
        ]);

        return redirect()->route('gudangpusat.pengiriman')->with('success', 'Pengiriman berhasil ditambahkan.');
    }

    // === Update status pengiriman dari Gudang ===
    public function updateStatus(Request $request, $id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        if ($pengiriman->status_pengiriman === 'Dikirim') {
            return back()->with('error', 'Status sudah Dikirim dan tidak bisa diubah lagi.');
        }

        $status = $request->status_pengiriman;
        if (!in_array($status, ['Dikemas', 'Dikirim'])) {
            return back()->with('error', 'Status tidak valid untuk gudang.');
        }

        $pengiriman->status_pengiriman = $status;
        $pengiriman->save();

        return back()->with('success', 'Status pengiriman berhasil diperbarui.');
    }

    // === Update penerimaan barang oleh cabang ===
    public function updatePenerimaan($cabang, $id_pengiriman)
    {
        $cabangData = Cabang::where('slug', strtolower($cabang))->firstOrFail();
        $pengiriman = Pengiriman::findOrFail($id_pengiriman);

        if ($pengiriman->status_pengiriman !== 'Dikirim') {
            return back()->with('error', 'Barang belum dikirim oleh gudang.');
        }

        $pengiriman->status_pengiriman = 'Diterima';
        $pengiriman->status_penerimaan = 'Diterima';
        $pengiriman->save();

        // Tambahkan stok barang di cabang penerima
        $barangCabang = Barang::where('nama_barang', $pengiriman->barang->nama_barang)
            ->where('id_cabang', $cabangData->id_cabang)
            ->first();

        if ($barangCabang) {
            $barangCabang->stok += $pengiriman->jumlah;
            $barangCabang->save();
        }

        return back()->with('success', 'Barang telah diterima oleh cabang.');
    }

    // === Hapus pengiriman ===
    public function destroy($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->delete();
        return redirect()->route('gudangpusat.pengiriman')->with('success', 'Data pengiriman berhasil dihapus.');
    }

    // === Riwayat pengiriman ke cabang ===
    public function riwayat($cabang)
    {
        $cabangData = Cabang::where('slug', strtolower($cabang))->firstOrFail();

        $riwayat = Pengiriman::with('barang')
            ->whereRaw('LOWER(tujuan_pengiriman) = ?', [$cabangData->slug])
            ->latest()
            ->get();

        return view("{$cabangData->slug}.riwayat", compact('riwayat', 'cabangData'));
    }
}
