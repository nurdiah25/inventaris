<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Cabang;
use App\Models\Pengiriman;
use App\Models\Gudang;

class GudangController extends Controller
{
    public function index()
    {
        $gudang = Gudang::first(); // karena hanya 1
        $barangs = Barang::all();
        $cabangs = Cabang::all();
        $pengiriman = Pengiriman::where('id_gudang', $gudang->id_gudang)->get();

        return view('gudang.index', compact('gudang', 'barangs', 'cabangs', 'pengiriman'));
    }

    public function storePengiriman(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tujuan_pengiriman' => 'required',
            'tanggal_pengiriman' => 'required|date',
        ]);

        $gudang = Gudang::first();

        Pengiriman::create([
            'id_gudang' => $gudang->id_gudang,
            'id_barang' => $request->id_barang,
            'id_cabang' => $request->tujuan_pengiriman,
            'jumlah' => $request->jumlah,
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'status_pengiriman' => 'Dikemas',
        ]);

        return back()->with('success', 'Pengiriman berhasil ditambahkan!');
    }
}
