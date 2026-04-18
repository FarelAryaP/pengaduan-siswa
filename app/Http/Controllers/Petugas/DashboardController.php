<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pengaduan' => Pengaduan::count(),
            'pending' => Pengaduan::where('status', 'pending')->count(),
            'proses' => Pengaduan::where('status', 'proses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
            'total_users' => User::where('role', 'user')->count(),
        ];

        $recentPengaduan = Pengaduan::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('petugas.dashboard', compact('stats', 'recentPengaduan'));
    }
}
