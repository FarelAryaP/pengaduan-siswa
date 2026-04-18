<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan - Sistem Pengaduan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen font-inter antialiased">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard.user') }}" class="flex items-center gap-3 hover:opacity-80 transition">
                        <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-primary to-blue-600 rounded-xl shadow-md">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-gray-800">Buat Pengaduan</h1>
                            <p class="text-xs text-gray-500">Sampaikan keluhan Anda</p>
                        </div>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->nama ?? Auth::user()->username }}</p>
                        <p class="text-xs text-gray-500">User</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-8 md:p-10">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-xl">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Form Pengaduan Baru</h2>
                        <p class="text-gray-500 text-sm">Isi form di bawah dengan lengkap dan jelas</p>
                    </div>
                </div>
            </div>

            <!-- Alert Errors -->
            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg px-4 py-3 text-sm">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div class="text-red-700">
                            @foreach($errors->all() as $error)
                                <div class="mb-1 last:mb-0">{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Judul -->
                <div class="group">
                    <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="judul" 
                            name="judul" 
                            value="{{ old('judul') }}"
                            required 
                            maxlength="255"
                            class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary focus:bg-white transition-all duration-200 text-gray-800 placeholder-gray-400" 
                            placeholder="Contoh: Fasilitas toilet rusak di lantai 2"
                        />
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Buat judul yang singkat dan jelas</p>
                </div>

                <!-- Isi Laporan -->
                <div class="group">
                    <label for="isi_laporan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Isi Laporan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="isi_laporan" 
                        name="isi_laporan" 
                        required 
                        rows="6"
                        minlength="10"
                        class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary focus:bg-white transition-all duration-200 text-gray-800 placeholder-gray-400 resize-none" 
                        placeholder="Jelaskan detail pengaduan Anda dengan lengkap..."
                    >{{ old('isi_laporan') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Minimal 10 karakter. Jelaskan kronologi, lokasi, dan dampak yang terjadi</p>
                </div>

                <!-- Upload Foto -->
                <div class="group">
                    <label for="foto" class="block text-sm font-semibold text-gray-700 mb-2">
                        Foto Pendukung <span class="text-gray-500 font-normal">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="file" 
                            id="foto" 
                            name="foto" 
                            accept="image/jpeg,image/jpg,image/png,image/gif"
                            class="hidden"
                            onchange="previewImage(event)"
                        />
                        <label 
                            for="foto" 
                            class="flex flex-col items-center justify-center w-full h-48 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-100 hover:border-primary transition-all duration-200"
                            id="dropzone"
                        >
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                                <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-600"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF (Max. 2MB)</p>
                            </div>
                            <img id="preview" class="hidden w-full h-full object-cover rounded-xl" alt="Preview">
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Upload foto untuk memperkuat pengaduan Anda</p>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Catatan Penting:</p>
                        <ul class="list-disc list-inside space-y-1 text-blue-700">
                            <li>Pastikan informasi yang Anda berikan akurat</li>
                            <li>Pengaduan akan diproses maksimal 3x24 jam</li>
                            <li>Anda akan mendapat notifikasi saat status berubah</li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button 
                        type="submit" 
                        class="flex-1 bg-gradient-to-r from-primary to-blue-600 hover:from-blue-600 hover:to-primary text-white font-semibold py-3.5 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        <span>Kirim Pengaduan</span>
                    </button>
                    <a 
                        href="{{ route('pengaduan.index') }}" 
                        class="flex-1 sm:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3.5 px-8 rounded-xl transition-all duration-200 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span>Batal</span>
                    </a>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('upload-placeholder');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        // Drag and drop functionality
        const dropzone = document.getElementById('dropzone');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropzone.classList.add('border-primary', 'bg-blue-50');
        }

        function unhighlight(e) {
            dropzone.classList.remove('border-primary', 'bg-blue-50');
        }

        dropzone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            document.getElementById('foto').files = files;
            previewImage({ target: { files: files } });
        }
    </script>
</body>
</html>
