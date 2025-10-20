<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;
use App\Models\Cabang;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            $notifications = Pengiriman::with('barang')
                ->where(function ($q) {
                    $q->where('status_pengiriman', 'Dikirim')
                      ->orWhere('status_penerimaan', 'Diterima');
                })
                ->where('is_read', 0)
                ->orderByDesc('updated_at')
                ->take(10)
                ->get();
        } else {
            $cabang = Cabang::where('slug', $user->cabang)->first();
            $notifications = Pengiriman::with('barang')
                ->whereRaw('LOWER(tujuan_pengiriman) = ?', [$user->cabang])
                ->where('status_pengiriman', 'Dikirim')
                ->where('is_read', 0)
                ->orderByDesc('updated_at')
                ->take(10)
                ->get();
        }

        return response()->json([
            'count' => $notifications->count(),
            'items' => $notifications
        ]);
    }

    // ✅ Tandai notifikasi telah dibaca
    public function markAsRead()
    {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            Pengiriman::where('is_read', 0)->update(['is_read' => 1]);
        } else {
            Pengiriman::whereRaw('LOWER(tujuan_pengiriman) = ?', [$user->cabang])
                ->update(['is_read' => 1]);
        }

        return response()->json(['success' => true]);
    }
}
