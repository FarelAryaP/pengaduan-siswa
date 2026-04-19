<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Suara Siswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root {
            --brand: #1A56DB;
            --brand-dark: #1341AB;
            --surface: #FFFFFF;
            --border: #E2E8F0;
            --text-1: #0F172A;
            --text-2: #475569;
            --text-3: #94A3B8;
            --radius-sm: 10px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: #F0F4FF;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .panel-left {
            background: linear-gradient(145deg, #0F172A 0%, #1E3A8A 50%, #1A56DB 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem;
            position: relative;
            overflow: hidden;
        }
        .panel-left::before {
            content: '';
            position: absolute;
            top: 30%; left: -100px;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
        }
        .brand-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 3rem;
            position: relative; z-index: 1;
        }
        .brand-icon {
            width: 44px; height: 44px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            display: grid; place-items: center;
        }
        .brand-icon svg { width: 22px; height: 22px; color: #fff; }
        .brand-name {
            font-family: 'Sora', sans-serif;
            font-size: 20px; font-weight: 600;
            color: #fff; letter-spacing: -0.3px;
        }
        .steps {
            position: relative; z-index: 1;
        }
        .steps h2 {
            font-family: 'Sora', sans-serif;
            font-size: 32px; font-weight: 700;
            color: #fff; letter-spacing: -0.8px;
            line-height: 1.25;
            margin-bottom: 2.5rem;
        }
        .step-item {
            display: flex;
            gap: 16px;
            margin-bottom: 1.5rem;
        }
        .step-num {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Sora', sans-serif;
            font-size: 13px; font-weight: 600;
            color: #93C5FD;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .step-content h4 {
            font-size: 15px; font-weight: 500;
            color: #fff; margin-bottom: 3px;
        }
        .step-content p {
            font-size: 13px;
            color: rgba(255,255,255,0.5);
            line-height: 1.5;
        }
        .panel-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            overflow-y: auto;
        }
        .form-card {
            width: 100%;
            max-width: 440px;
            padding: 2.5rem;
            background: var(--surface);
            border-radius: 20px;
            box-shadow: 0 8px 40px rgba(15,23,42,0.1);
        }
        .form-header { margin-bottom: 2rem; }
        .form-header h2 {
            font-family: 'Sora', sans-serif;
            font-size: 26px; font-weight: 700;
            color: var(--text-1); letter-spacing: -0.5px;
            margin-bottom: 6px;
        }
        .form-header p { font-size: 14px; color: var(--text-2); }
        .alert-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #B91C1C;
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            font-size: 13.5px;
            margin-bottom: 1.25rem;
        }
        .alert-error ul { padding-left: 16px; }
        .alert-error li { margin-bottom: 2px; }
        .field { margin-bottom: 1rem; }
        .field label {
            display: block; font-size: 13.5px;
            font-weight: 500; color: var(--text-1); margin-bottom: 6px;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute; left: 13px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-3); width: 17px; height: 17px;
            pointer-events: none;
        }
        .field input {
            width: 100%; height: 46px;
            padding: 0 14px 0 40px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 14.5px; color: var(--text-1);
            background: var(--surface); outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .field input:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.1);
        }
        .field input::placeholder { color: var(--text-3); }
        .hint { font-size: 12px; color: var(--text-3); margin-top: 5px; }
        .btn-primary {
            width: 100%; height: 48px;
            background: var(--brand); color: #fff;
            border: none; border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px; font-weight: 500;
            cursor: pointer; display: flex;
            align-items: center; justify-content: center;
            gap: 8px;
            transition: background 0.15s, transform 0.1s;
            margin-top: 1.25rem;
        }
        .btn-primary:hover { background: var(--brand-dark); }
        .btn-primary:active { transform: scale(0.99); }
        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 1.5rem 0; color: var(--text-3); font-size: 13px;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: var(--border);
        }
        .link-text { text-align: center; font-size: 14px; color: var(--text-2); }
        .link-text a { color: var(--brand); font-weight: 500; text-decoration: none; }
        .link-text a:hover { text-decoration: underline; }
        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 2rem 1.25rem; align-items: flex-start; padding-top: 3rem; }
            .form-card { box-shadow: none; padding: 0; background: transparent; }
        }
    </style>
</head>
<body>
    <div class="panel-left">
        <div class="brand-row">
            <div class="brand-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            </div>
            <span class="brand-name">Suara Siswa</span>
        </div>
        <div class="steps">
            <h2>Mulai dalam<br>3 langkah mudah</h2>
            <div class="step-item">
                <div class="step-num">1</div>
                <div class="step-content">
                    <h4>Buat akun gratis</h4>
                    <p>Daftar dengan username dan password pilihanmu sendiri</p>
                </div>
            </div>
            <div class="step-item">
                <div class="step-num">2</div>
                <div class="step-content">
                    <h4>Tulis pengaduanmu</h4>
                    <p>Sampaikan masalah secara detail, tambahkan foto jika perlu</p>
                </div>
            </div>
            <div class="step-item">
                <div class="step-num">3</div>
                <div class="step-content">
                    <h4>Pantau status real-time</h4>
                    <p>Lihat perkembangan pengaduan hingga selesai ditangani</p>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-right">
        <div class="form-card">
            <div class="form-header">
                <h2>Buat akun baru ✍️</h2>
                <p>Isi data di bawah untuk mendaftar</p>
            </div>

            @if($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                <div class="field">
                    <label for="username">Username</label>
                    <div class="input-wrap">
                        <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Pilih username unik" required>
                    </div>
                </div>
                <div class="field">
                    <label for="nama">Nama Lengkap</label>
                    <div class="input-wrap">
                        <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap kamu" required>
                    </div>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <input type="password" id="password" name="password" placeholder="Minimal 4 karakter" required>
                    </div>
                </div>
                <div class="field">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary">
                    Daftar Sekarang
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </button>
            </form>

            <div class="divider">atau</div>
            <p class="link-text">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </p>
        </div>
    </div>
</body>
</html>