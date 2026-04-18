<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Pengaduan::where('id_user', Auth::id())->count(),
            'pending' => Pengaduan::where('id_user', Auth::id())->where('status', 'pending')->count(),
            'proses' => Pengaduan::where('id_user', Auth::id())->where('status', 'proses')->count(),
            'selesai' => Pengaduan::where('id_user', Auth::id())->where('status', 'selesai')->count(),
        ];

        return view('user.dashboard', compact('stats'));
    }
}
