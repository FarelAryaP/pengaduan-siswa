<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    /**
     * Kirim balasan dari user ke petugas untuk pengaduan tertentu.
     * Dipanggil dari halaman detail pengaduan (user).
     */
    public function store(Request $request, $pengaduanId)
    {
        $request->validate([
            'isi' => 'required|string|min:1|max:2000',
        ], [
            'isi.required' => 'Pesan tidak boleh kosong.',
            'isi.max'      => 'Pesan maksimal 2000 karakter.',
        ]);

        // Pastikan pengaduan milik user yang login
        $pengaduan = Pengaduan::where('id', $pengaduanId)
                              ->where('id_user', Auth::id())
                              ->firstOrFail();

        Pesan::create([
            'pengaduan_id'  => $pengaduan->id,
            'pengirim_id'   => Auth::id(),
            'isi'           => $request->isi,
            'role_pengirim' => 'user',
            'dibaca'        => false, // belum dibaca petugas
        ]);

        return redirect()
            ->route('user.pengaduan.show', $pengaduanId)
            ->with('success', 'Balasan berhasil dikirim.');
    }

    /**
     * Tandai semua pesan dari petugas sebagai sudah dibaca.
     * Dipanggil otomatis saat user membuka halaman detail pengaduan.
     */
    public function markRead($pengaduanId)
    {
        Pengaduan::where('id', $pengaduanId)
                 ->where('id_user', Auth::id())
                 ->firstOrFail();

        Pesan::where('pengaduan_id', $pengaduanId)
             ->where('role_pengirim', 'petugas')
             ->where('dibaca', false)
             ->update(['dibaca' => true]);

        return response()->json(['ok' => true]);
    }
}