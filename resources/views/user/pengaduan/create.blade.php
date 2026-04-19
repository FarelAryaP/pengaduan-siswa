<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan — Suara Siswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root {
            --brand: #1A56DB; --brand-dark: #1341AB; --brand-light: #EBF2FF;
            --surface: #FFFFFF; --surface-2: #F8FAFF; --border: #E2E8F0;
            --text-1: #0F172A; --text-2: #475569; --text-3: #94A3B8;
            --radius: 16px; --radius-sm: 10px; --bg-body: #F4F7FF;
            --danger-bg: #FEF2F2; --danger-text: #DC2626; --danger-border: #FECACA;
            --info-bg: #F0F7FF; --info-border: #BFDBFE; --info-text: #1D4ED8;
        }
        [data-theme="dark"] {
            --brand: #60A5FA; --brand-dark: #3B82F6; --brand-light: #1E3A8A;
            --surface: #1E293B; --surface-2: #0F172A; --border: #334155;
            --text-1: #F1F5F9; --text-2: #CBD5E1; --text-3: #64748B;
            --bg-body: #0F172A;
            --danger-bg: #7F1D1D; --danger-text: #FCA5A5; --danger-border: #991B1B;
            --info-bg: #1E3A8A; --info-border: #1E40AF; --info-text: #93C5FD;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg-body); color: var(--text-1); min-height: 100vh; transition: background 0.3s, color 0.3s; }
        nav { position: sticky; top: 0; z-index: 100; background: var(--surface); border-bottom: 1px solid var(--border); transition: background 0.3s; }
        .nav-inner { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; height: 62px; display: flex; align-items: center; justify-content: space-between; }
        .brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon { width: 36px; height: 36px; background: var(--brand); border-radius: 10px; display: grid; place-items: center; }
        .brand-name { font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 600; color: var(--text-1); }
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-link { padding: 7px 14px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; color: var(--text-2); }
        .nav-link:hover { background: var(--brand-light); color: var(--brand); }
        .btn-nav { padding: 8px 16px; border-radius: 8px; font-size: 14px; font-weight: 500; background: var(--brand); color: #fff; text-decoration: none; display: flex; align-items: center; gap: 6px; margin-left: 8px; border: none; font-family: 'DM Sans', sans-serif; cursor: pointer; }
        .user-area { display: flex; align-items: center; gap: 12px; }
        .avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--brand-light); display: grid; place-items: center; font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 600; color: var(--brand); }
        .btn-logout { padding: 7px 14px; border-radius: 8px; border: 1.5px solid var(--border); background: var(--surface); font-family: 'DM Sans', sans-serif; font-size: 13.5px; font-weight: 500; color: var(--text-2); cursor: pointer; display: flex; align-items: center; gap: 6px; }
        .btn-dark-toggle { width: 34px; height: 34px; border-radius: 8px; border: 1.5px solid var(--border); background: var(--surface); cursor: pointer; display: grid; place-items: center; color: var(--text-2); transition: all 0.15s; }
        .btn-dark-toggle:hover { background: var(--surface-2); }
        main { max-width: 760px; margin: 0 auto; padding: 2.5rem 1.5rem 4rem; }
        /* Breadcrumb */
        .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13.5px; color: var(--text-3); margin-bottom: 1.5rem; }
        .breadcrumb a { color: var(--brand); text-decoration: none; }
        .breadcrumb svg { width: 14px; height: 14px; }
        /* Form card */
        .form-card { background: var(--surface); border: 1px solid var(--border); border-radius: 20px; overflow: hidden; }
        .form-card-header { padding: 2rem 2rem 1.5rem; border-bottom: 1px solid var(--border); }
        .form-card-title { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; color: var(--text-1); letter-spacing: -0.4px; margin-bottom: 5px; }
        .form-card-sub { font-size: 14px; color: var(--text-2); }
        .form-body { padding: 1.75rem 2rem; }
        /* Fields */
        .field { margin-bottom: 1.5rem; }
        .field label { display: flex; align-items: center; gap: 6px; font-size: 14px; font-weight: 500; color: var(--text-1); margin-bottom: 8px; }
        .label-req { color: #EF4444; font-size: 12px; }
        .label-opt { font-size: 12px; color: var(--text-3); font-weight: 400; }
        .field input, .field textarea {
            width: 100%; padding: 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px; color: var(--text-1);
            background: var(--surface-2); outline: none;
            transition: border-color 0.15s, background 0.15s, box-shadow 0.15s;
        }
        .field input:focus, .field textarea:focus {
            border-color: var(--brand);
            background: var(--surface);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.08);
        }
        .field input::placeholder, .field textarea::placeholder { color: var(--text-3); }
        .field textarea { resize: vertical; min-height: 140px; line-height: 1.6; }
        .field-hint { font-size: 12.5px; color: var(--text-3); margin-top: 6px; }
        /* File upload */
        .upload-zone {
            border: 2px dashed var(--border); border-radius: var(--radius-sm);
            background: var(--surface-2); transition: all 0.15s;
            cursor: pointer; overflow: hidden;
        }
        .upload-zone:hover, .upload-zone.dragover { border-color: var(--brand); background: var(--brand-light); }
        .upload-placeholder { padding: 2rem; display: flex; flex-direction: column; align-items: center; text-align: center; gap: 8px; }
        .upload-icon { width: 44px; height: 44px; background: var(--surface); border: 1.5px solid var(--border); border-radius: 12px; display: grid; place-items: center; }
        .upload-icon svg { width: 20px; height: 20px; color: var(--text-3); }
        .upload-text { font-size: 14px; font-weight: 500; color: var(--text-1); }
        .upload-text span { color: var(--brand); }
        .upload-sub { font-size: 12.5px; color: var(--text-3); }
        #preview-img { width: 100%; max-height: 240px; object-fit: contain; padding: 1rem; display: none; }
        /* Divider */
        .form-divider { border: none; border-top: 1px solid var(--border); margin: 1.5rem 0; }
        /* Info box */
        .info-box { background: var(--info-bg); border: 1px solid var(--info-border); border-radius: var(--radius-sm); padding: 1rem 1.25rem; display: flex; gap: 12px; margin-bottom: 1.5rem; }
        .info-box svg { width: 18px; height: 18px; color: var(--brand); flex-shrink: 0; margin-top: 1px; }
        .info-box ul { padding-left: 16px; }
        .info-box li { font-size: 13.5px; color: var(--info-text); line-height: 1.6; }
        /* Buttons */
        .form-actions { display: flex; gap: 12px; align-items: center; }
        .btn-submit { flex: 1; height: 50px; background: var(--brand); color: #fff; border: none; border-radius: var(--radius-sm); font-family: 'DM Sans', sans-serif; font-size: 15px; font-weight: 500; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.15s, transform 0.1s; }
        .btn-submit:hover { background: var(--brand-dark); }
        .btn-submit:active { transform: scale(0.99); }
        .btn-cancel { padding: 0 24px; height: 50px; background: var(--surface-2); color: var(--text-2); border: 1.5px solid var(--border); border-radius: var(--radius-sm); font-family: 'DM Sans', sans-serif; font-size: 15px; font-weight: 500; cursor: pointer; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.15s; }
        .btn-cancel:hover { border-color: var(--border); background: var(--surface-2); opacity: 0.8; }
        /* Alert */
        .alert-error { background: var(--danger-bg); border: 1px solid var(--danger-border); color: var(--danger-text); border-radius: var(--radius-sm); padding: 12px 16px; font-size: 13.5px; margin-bottom: 1.5rem; }
        .alert-error ul { padding-left: 16px; }
        @media (max-width: 768px) { .nav-links { display: none; } main { padding: 2rem 1rem; } .form-body { padding: 1.25rem; } .form-card-header { padding: 1.25rem; } }
    </style>
    @vite('resources/js/app.js')
</head>
<body>
    <nav>
        <div class="nav-inner">
            <a href="{{ route('user.dashboard') }}" class="brand">
                <div class="brand-icon"><svg fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg></div>
                <span class="brand-name">Suara Siswa</span>
            </a>
            <div class="nav-links">
                <a href="{{ route('user.dashboard') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('user.pengaduan.index') }}" class="nav-link">Pengaduan Saya</a>
            </div>
            <div class="user-area">
                <button id="darkModeToggle" class="btn-dark-toggle" title="Toggle Dark Mode">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>
                <div class="avatar">{{ strtoupper(substr(Auth::user()->nama ?? Auth::user()->username, 0, 1)) }}</div>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn-logout"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <main>
        <div class="breadcrumb">
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('user.pengaduan.index') }}">Pengaduan Saya</a>
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span>Buat Pengaduan</span>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <h1 class="form-card-title">📝 Buat Pengaduan Baru</h1>
                <p class="form-card-sub">Isi form di bawah dengan detail yang jelas agar pengaduanmu bisa segera ditangani</p>
            </div>
            <div class="form-body">
                @if($errors->any())
                    <div class="alert-error"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>
                @endif

                <form method="POST" action="{{ route('user.pengaduan.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="field">
                        <label for="judul">Judul Pengaduan <span class="label-req">*</span></label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" maxlength="255" required placeholder="Contoh: Fasilitas toilet lantai 2 rusak dan bau">
                        <p class="field-hint">Buat judul yang singkat dan menggambarkan inti masalah</p>
                    </div>

                    <div class="field">
                        <label for="isi_laporan">Detail Pengaduan <span class="label-req">*</span></label>
                        <textarea id="isi_laporan" name="isi_laporan" required minlength="10" placeholder="Jelaskan masalah secara detail: kapan terjadi, di mana, apa dampaknya, siapa yang terlibat...">{{ old('isi_laporan') }}</textarea>
                        <p class="field-hint">Minimal 10 karakter. Semakin detail, semakin cepat ditangani.</p>
                    </div>

                    <div class="field">
                        <label for="foto">Foto Pendukung <span class="label-opt">(opsional)</span></label>
                        <div class="upload-zone" id="dropzone" onclick="document.getElementById('foto').click()">
                            <img id="preview-img" alt="Preview">
                            <div class="upload-placeholder" id="upload-placeholder">
                                <div class="upload-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg></div>
                                <p class="upload-text"><span>Klik untuk upload</span> atau drag & drop</p>
                                <p class="upload-sub">PNG, JPG, JPEG, GIF — Maks. 2MB</p>
                            </div>
                        </div>
                        <input type="file" id="foto" name="foto" accept="image/jpeg,image/jpg,image/png,image/gif" style="display:none;" onchange="previewImage(event)">
                        <p class="field-hint">Tambahkan foto untuk memperkuat pengaduanmu</p>
                    </div>

                    <hr class="form-divider">

                    <div class="info-box">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <ul>
                                <li>Pastikan informasi yang kamu berikan akurat dan dapat dipertanggungjawabkan</li>
                                <li>Pengaduan akan diproses maksimal 3×24 jam oleh petugas</li>
                                <li>Pengaduan yang masih pending dapat dihapus sewaktu-waktu</li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Kirim Pengaduan
                        </button>
                        <a href="{{ route('user.pengaduan.index') }}" class="btn-cancel">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        function previewImage(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = ev => {
                const img = document.getElementById('preview-img');
                const ph = document.getElementById('upload-placeholder');
                img.src = ev.target.result;
                img.style.display = 'block';
                ph.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
        const dz = document.getElementById('dropzone');
        ['dragenter','dragover'].forEach(e => dz.addEventListener(e, ev => { ev.preventDefault(); dz.classList.add('dragover'); }));
        ['dragleave','drop'].forEach(e => dz.addEventListener(e, ev => { ev.preventDefault(); dz.classList.remove('dragover'); }));
        dz.addEventListener('drop', e => {
            const dt = e.dataTransfer;
            if (dt.files.length) {
                document.getElementById('foto').files = dt.files;
                previewImage({ target: { files: dt.files } });
            }
        });
    </script>
</body>
</html>