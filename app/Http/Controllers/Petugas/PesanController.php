<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    /**
     * Kirim pesan dari petugas ke user untuk pengaduan tertentu.
     * Dipanggil dari halaman detail pengaduan (petugas).
     */
    public function store(Request $request, $pengaduanId)
    {
        $request->validate([
            'isi' => 'required|string|min:1|max:2000',
        ], [
            'isi.required' => 'Pesan tidak boleh kosong.',
            'isi.max'      => 'Pesan maksimal 2000 karakter.',
        ]);

        $pengaduan = Pengaduan::findOrFail($pengaduanId);

        Pesan::create([
            'pengaduan_id'  => $pengaduan->id,
            'pengirim_id'   => Auth::id(),
            'isi'           => $request->isi,
            'role_pengirim' => 'petugas',
            'dibaca'        => false,
        ]);

        return redirect()
            ->route('petugas.pengaduan.show', $pengaduanId)
            ->with('success', 'Pesan berhasil dikirim ke siswa.');
    }

    /**
     * Hapus pesan (hanya petugas yang mengirim).
     */
    public function destroy($id)
    {
        $pesan = Pesan::where('id', $id)
                      ->where('pengirim_id', Auth::id())
                      ->firstOrFail();

        $pengaduanId = $pesan->pengaduan_id;
        $pesan->delete();

        return redirect()
            ->route('petugas.pengaduan.show', $pengaduanId)
            ->with('success', 'Pesan berhasil dihapus.');
    }
}