<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Cabang;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Pastikan panjang default string schema cukup (untuk MySQL versi lama)
        Schema::defaultStringLength(191);

        // ⚡ Sidebar dinamis: data cabang selalu diambil langsung dari database
        View::composer('*', function ($view) {
            try {
                // Ambil semua cabang (urut nama)
                $cabangs = Cabang::orderBy('nama_cabang', 'asc')->get();
            } catch (\Exception $e) {
                // Jika tabel belum ada (misal saat migrasi awal)
                $cabangs = collect();
            }

            // Kirim ke semua view supaya sidebar bisa pakai $global_cabangs
            $view->with('global_cabangs', $cabangs);
        });
    }
}
