<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'superadmin')->get();
        return view('superadmin.pengguna', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'cabang' => 'required|string',
        ]);

        $slug = Str::slug($request->cabang);

        // 🔹 1. Tambahkan ke tabel cabangs (jika belum ada)
        $cabang = Cabang::firstOrCreate(
            ['slug' => $slug],
            ['nama_cabang' => ucfirst($request->cabang), 'alamat' => '-']
        );

        // 🔹 2. Tambahkan user admin cabang
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin_cabang',
            'cabang' => $slug,
        ]);

        // 🔹 3. Buat folder view cabang (copy dari banjarbaru)
        $source = resource_path('views/banjarbaru');
        $target = resource_path('views/' . $slug);
        if (!File::exists($target)) {
            File::makeDirectory($target, 0777, true);
            File::copyDirectory($source, $target);
        }

        return redirect()->route('pengguna.index')
            ->with('success', '✅ Admin cabang dan tampilan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'cabang' => 'required|string',
        ]);

        $slug = Str::slug($request->cabang);

        // 🔹 Pastikan cabang ada
        Cabang::firstOrCreate(['slug' => $slug], ['nama_cabang' => ucfirst($request->cabang)]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'cabang' => $slug,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return back()->with('success', '✅ Data pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // ⛔ Tidak boleh hapus superadmin
        if ($user->role === 'superadmin') {
            return back()->with('error', 'Tidak dapat menghapus Superadmin!');
        }

        $slug = strtolower(trim($user->cabang));

        // 🔹 1. Hapus user
        $user->delete();

        // 🔹 2. Hapus data cabang dari tabel cabangs
        $cabang = Cabang::where('slug', $slug)->orWhere('nama_cabang', 'like', "%{$slug}%")->first();
        if ($cabang) {
            $cabang->delete();
        }

        // 🔹 3. Hapus folder view cabang (jika ada)
        $viewPath = resource_path('views/' . $slug);
        if (is_dir($viewPath)) {
            $this->deleteDirectory($viewPath);
        }

        // 🔹 4. Bersihkan cache agar sidebar update otomatis
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');

        return back()->with('success', '✅ Admin cabang, data cabang, dan tampilan berhasil dihapus.');
    }

    /**
     * 🔧 Helper untuk hapus folder cabang beserta isinya
     */
    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) return;
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                $this->deleteDirectory($path);
            } else {
                unlink($path);
            }
        }
        rmdir($dir);
    }
}
