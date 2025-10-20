<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cabang;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $role = strtolower($user->role ?? '');
        $cabangUser = strtolower($user->cabang ?? '');

        // === SUPERADMIN: TAMPILKAN SEMUA CABANG SECARA DINAMIS ===
        if ($role === 'superadmin') {
            // Ambil semua cabang dari tabel cabangs (kecuali gudangpusat, ditampilkan terpisah)
            $cabangs = Cabang::where('nama_cabang', '!=', 'gudangpusat')->get();

            // Gudang pusat
            $jumlahGudangPusat = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', 'gudangpusat')
                ->distinct('barangs.nama_barang')
                ->count('barangs.nama_barang');

            $totalGudangPusat = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', 'gudangpusat')
                ->sum('barangs.stok');

            // Simpan data tiap cabang dalam array dinamis
            $dataCabang = [];
            foreach ($cabangs as $cabang) {
                $nama = strtolower($cabang->nama_cabang);

                $jumlahJenis = DB::table('barangs')
                    ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                    ->where('cabangs.nama_cabang', $nama)
                    ->distinct('barangs.nama_barang')
                    ->count('barangs.nama_barang');

                $totalStok = DB::table('barangs')
                    ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                    ->where('cabangs.nama_cabang', $nama)
                    ->sum('barangs.stok');

                $dataCabang[$nama] = [
                    'nama' => ucfirst($nama),
                    'jumlahJenis' => $jumlahJenis,
                    'totalStok' => $totalStok
                ];
            }

            return view('dashboard', [
                'jumlahGudangPusat' => $jumlahGudangPusat,
                'totalGudangPusat' => $totalGudangPusat,
                'dataCabang' => $dataCabang,
                'cabangs' => $cabangs
            ]);
        }

        // === ADMIN CABANG: HANYA CABANGNYA SENDIRI ===
        if ($role === 'admin_cabang') {
            $jumlahJenis = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', $cabangUser)
                ->distinct('barangs.nama_barang')
                ->count('barangs.nama_barang');

            $totalStok = DB::table('barangs')
                ->join('cabangs', 'barangs.id_cabang', '=', 'cabangs.id_cabang')
                ->where('cabangs.nama_cabang', $cabangUser)
                ->sum('barangs.stok');

            return view('dashboard', compact('cabangUser', 'jumlahJenis', 'totalStok'));
        }

        // === DEFAULT: jika role tidak dikenal ===
        return redirect()->route('dashboard')->with('error', 'Akses tidak valid.');
    }
}
