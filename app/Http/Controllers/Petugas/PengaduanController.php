<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    // Tampilkan semua pengaduan untuk petugas
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = Pengaduan::with('user')->orderBy('created_at', 'desc');
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $pengaduanList = $query->get();
        
        // Statistik
        $stats = [
            'total' => Pengaduan::count(),
            'pending' => Pengaduan::where('status', 'pending')->count(),
            'proses' => Pengaduan::where('status', 'proses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
        ];

        return view('petugas.pengaduan.index', compact('pengaduanList', 'stats', 'status'));
    }

    // Tampilkan detail pengaduan
    public function show($id)
    {
        $pengaduan = Pengaduan::with('user')->findOrFail($id);
        return view('petugas.pengaduan.show', compact('pengaduan'));
    }

    // Update status pengaduan
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->save();

        return redirect()->back()->with('success', 'Status pengaduan berhasil diupdate!');
    }

    // Hapus pengaduan (petugas bisa hapus semua)
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        // Hapus foto jika ada
        if ($pengaduan->foto) {
            \Storage::disk('public')->delete($pengaduan->foto);
        }

        $pengaduan->delete();

        return redirect()->route('petugas.pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
