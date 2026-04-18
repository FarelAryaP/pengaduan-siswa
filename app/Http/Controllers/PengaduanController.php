<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // Tampilkan form buat pengaduan
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'user') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai user.');
        }
        return view('pengaduan.create');
    }

    // Simpan pengaduan baru
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'user') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai user.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string|min:10',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048', // Max 2MB
        ], [
            'judul.required' => 'Judul pengaduan harus diisi.',
            'isi_laporan.required' => 'Isi laporan harus diisi.',
            'isi_laporan.min' => 'Isi laporan minimal 10 karakter.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $fotoPath = null;

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $fotoPath = $file->storeAs('pengaduan', $filename, 'public');
        }

        // Simpan pengaduan
        Pengaduan::create([
            'id_user' => Auth::id(),
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
            'foto' => $fotoPath,
            'status' => 'pending',
            'tanggal_lapor' => now()->toDateString(),
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim!');
    }

    // Tampilkan daftar pengaduan user
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'user') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai user.');
        }

        $pengaduanList = Pengaduan::where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengaduan.index', compact('pengaduanList'));
    }

    // Tampilkan detail pengaduan
    public function show($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'user') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai user.');
        }

        $pengaduan = Pengaduan::where('id', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        return view('pengaduan.show', compact('pengaduan'));
    }

    // Hapus pengaduan (hanya jika status pending)
    public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'user') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai user.');
        }

        $pengaduan = Pengaduan::where('id', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        // Hanya bisa hapus jika status pending
        if ($pengaduan->status !== 'pending') {
            return redirect()->route('pengaduan.index')->with('error', 'Pengaduan yang sudah diproses tidak dapat dihapus.');
        }

        // Hapus foto jika ada
        if ($pengaduan->foto) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
