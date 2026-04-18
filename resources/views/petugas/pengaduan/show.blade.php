<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan - {{ $pengaduan->judul }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen font-inter antialiased">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <a href="{{ route('petugas.pengaduan.index') }}" class="flex items-center gap-3 hover:opacity-80 transition">
                        <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-primary to-blue-600 rounded-xl shadow-md">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-gray-800">Detail Pengaduan</h1>
                            <p class="text-xs text-gray-500">Management Sistem</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg px-4 py-3 text-sm flex items-start gap-3">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-primary to-blue-600 p-8 text-white">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h1 class="text-3xl font-bold mb-2">{{ $pengaduan->judul }}</h1>
                                <div class="flex items-center gap-4 text-blue-100">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-sm">{{ $pengaduan->tanggal_lapor->format('d F Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-sm">{{ $pengaduan->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- User Info -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 flex items-center gap-3">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-blue-100">Dilaporkan oleh:</p>
                                <p class="font-semibold text-lg">{{ $pengaduan->user->nama ?? $pengaduan->user->username }}</p>
                                <p class="text-xs text-blue-100">@{{ $pengaduan->user->username }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-8">
                        <!-- Foto -->
                        @if($pengaduan->foto)
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Foto Pendukung
                                </h3>
                                <div class="relative group">
                                    <img 
                                        src="{{ asset('storage/' . $pengaduan->foto) }}" 
                                        alt="Foto Pengaduan" 
                                        class="w-full h-auto rounded-2xl shadow-lg cursor-pointer hover:shadow-2xl transition-all duration-300"
                                        onclick="openModal()"
                                    >
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 rounded-2xl transition-all duration-300 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Isi Laporan -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Isi Laporan
                            </h3>
                            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->isi_laporan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Status Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Update Status
                    </h3>

                    <form action="{{ route('petugas.pengaduan.updateStatus', $pengaduan->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Saat Ini:</label>
                            @if($pengaduan->status === 'pending')
                                <div class="px-4 py-3 bg-yellow-50 border border-yellow-200 rounded-xl text-yellow-700 font-semibold text-center">
                                    ⏳ Pending
                                </div>
                            @elseif($pengaduan->status === 'proses')
                                <div class="px-4 py-3 bg-blue-50 border border-blue-200 rounded-xl text-blue-700 font-semibold text-center">
                                    🔄 Sedang Diproses
                                </div>
                            @else
                                <div class="px-4 py-3 bg-green-50 border border-green-200 rounded-xl text-green-700 font-semibold text-center">
                                    ✅ Selesai
                                </div>
                            @endif
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Ubah Status:</label>
                            <select 
                                name="status" 
                                id="status" 
                                required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary transition-all duration-200"
                            >
                                <option value="pending" {{ $pengaduan->status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                <option value="proses" {{ $pengaduan->status === 'proses' ? 'selected' : '' }}>🔄 Sedang Diproses</option>
                                <option value="selesai" {{ $pengaduan->status === 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                            </select>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-primary to-blue-600 hover:from-blue-600 hover:to-primary text-white font-semibold py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            <span>Update Status</span>
                        </button>
                    </form>
                </div>

                <!-- Timeline Status -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Timeline
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">Pengaduan Dikirim</p>
                                <p class="text-sm text-gray-500">{{ $pengaduan->created_at->format('d F Y, H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 {{ $pengaduan->status === 'proses' || $pengaduan->status === 'selesai' ? 'bg-green-100' : 'bg-gray-100' }} rounded-full flex items-center justify-center">
                                @if($pengaduan->status === 'proses' || $pengaduan->status === 'selesai')
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">Sedang Diproses</p>
                                <p class="text-sm text-gray-500">
                                    @if($pengaduan->status === 'proses' || $pengaduan->status === 'selesai')
                                        Pengaduan sedang ditangani
                                    @else
                                        Menunggu proses
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 {{ $pengaduan->status === 'selesai' ? 'bg-green-100' : 'bg-gray-100' }} rounded-full flex items-center justify-center">
                                @if($pengaduan->status === 'selesai')
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">Selesai</p>
                                <p class="text-sm text-gray-500">
                                    @if($pengaduan->status === 'selesai')
                                        Pengaduan telah diselesaikan
                                    @else
                                        Belum selesai
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
                    <div class="space-y-3">
                        <a href="{{ route('petugas.pengaduan.index') }}" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            <span>Kembali</span>
                        </a>
                        <form action="{{ route('petugas.pengaduan.destroy', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-semibold py-3 rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                <span>Hapus Pengaduan</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal for Image -->
    @if($pengaduan->foto)
        <div id="imageModal" class="hidden fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4" onclick="closeModal()">
            <div class="relative max-w-7xl max-h-full">
                <button onclick="closeModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" class="max-w-full max-h-screen rounded-lg">
            </div>
        </div>

        <script>
            function openModal() {
                document.getElementById('imageModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('imageModal').classList.add('hidden');
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        </script>
    @endif
</body>
</html>
