<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya user login yang bisa akses dashboard
        $this->middleware('auth');
    }

    public function index()
    {
        $role = Auth::user()->role ?? '';

        // Jika superadmin, tampilkan semua cabang
        if ($role === 'superadmin') {
            $jumlahGudangPusat = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', 'gudangpusat')
                ->distinct('barangs.nama_barang')
                ->count('barangs.nama_barang');

            $jumlahBanjarbaru = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', 'banjarbaru')
                ->distinct('barangs.nama_barang')
                ->count('barangs.nama_barang');

            $jumlahMartapura = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', 'martapura')
                ->distinct('barangs.nama_barang')
                ->count('barangs.nama_barang');

            $jumlahLiangAnggang = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', 'lianganggang')
                ->distinct('barangs.nama_barang')
                ->count('barangs.nama_barang');

            // Total stok per cabang
            $totalGudangPusat = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', 'gudangpusat')
                ->sum('barangs.stok');

            $totalBanjarbaru = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', 'banjarbaru')
                ->sum('barangs.stok');

            $totalMartapura = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', 'martapura')
                ->sum('barangs.stok');

            $totalLiangAnggang = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', 'lianganggang')
                ->sum('barangs.stok');

            return view('dashboard', compact(
                'jumlahGudangPusat', 'jumlahBanjarbaru', 'jumlahMartapura', 'jumlahLiangAnggang',
                'totalGudangPusat', 'totalBanjarbaru', 'totalMartapura', 'totalLiangAnggang'
            ));
        }

        // Jika admin cabang, tampilkan hanya cabangnya sendiri
        $jumlahJenis = DB::table('barangs')
            ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
            ->where('cabangs.nama_cabang', $role)
            ->distinct('barangs.nama_barang')
            ->count('barangs.nama_barang');

        $totalStok = DB::table('barangs')
            ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
            ->where('cabangs.nama_cabang', $role)
            ->sum('barangs.stok');

        return view('dashboard', compact('role', 'jumlahJenis', 'totalStok'));
    }
}
