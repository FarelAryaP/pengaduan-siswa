<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Suara Siswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root {
            --brand: #1A56DB;
            --brand-dark: #1341AB;
            --brand-light: #EBF2FF;
            --surface: #FFFFFF;
            --surface-2: #F5F7FA;
            --border: #E2E8F0;
            --text-1: #0F172A;
            --text-2: #475569;
            --text-3: #94A3B8;
            --success: #059669;
            --danger: #DC2626;
            --radius: 16px;
            --radius-sm: 10px;
            --shadow: 0 4px 24px rgba(15,23,42,0.08), 0 1px 4px rgba(15,23,42,0.04);
            --bg-body: #F0F4FF;
            --danger-bg: #FEF2F2; --danger-text: #B91C1C; --danger-border: #FECACA;
            --success-bg: #F0FDF4; --success-text: #15803D; --success-border: #BBF7D0;
        }
        [data-theme="dark"] {
            --brand: #60A5FA;
            --brand-dark: #3B82F6;
            --brand-light: #1E3A8A;
            --surface: #1E293B;
            --surface-2: #0F172A;
            --border: #334155;
            --text-1: #F1F5F9;
            --text-2: #CBD5E1;
            --text-3: #64748B;
            --success: #34D399;
            --danger: #F87171;
            --bg-body: #0F172A;
            --danger-bg: #7F1D1D; --danger-text: #FCA5A5; --danger-border: #991B1B;
            --success-bg: #064E3B; --success-text: #6EE7B7; --success-border: #065F46;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-body);
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            transition: background 0.3s;
        }
        /* Left panel */
        .panel-left {
            background: linear-gradient(145deg, #1A56DB 0%, #1E3A8A 60%, #0F172A 100%);
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
            top: -80px; right: -80px;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }
        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
        }
        .panel-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 3rem;
            position: relative;
            z-index: 1;
        }
        .brand-icon {
            width: 44px; height: 44px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            display: grid;
            place-items: center;
        }
        .brand-icon svg { width: 22px; height: 22px; color: #fff; }
        .brand-name {
            font-family: 'Sora', sans-serif;
            font-size: 20px;
            font-weight: 600;
            color: #fff;
            letter-spacing: -0.3px;
        }
        .hero-text {
            position: relative;
            z-index: 1;
        }
        .hero-text h1 {
            font-family: 'Sora', sans-serif;
            font-size: 40px;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 1.25rem;
        }
        .hero-text h1 span {
            color: #93C5FD;
        }
        .hero-text p {
            font-size: 16px;
            color: rgba(255,255,255,0.65);
            line-height: 1.7;
            max-width: 360px;
        }
        .hero-stats {
            display: flex;
            gap: 2rem;
            margin-top: 3rem;
            position: relative;
            z-index: 1;
        }
        .stat {
            border-top: 1px solid rgba(255,255,255,0.15);
            padding-top: 1rem;
        }
        .stat-num {
            font-family: 'Sora', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: #fff;
        }
        .stat-label {
            font-size: 13px;
            color: rgba(255,255,255,0.5);
            margin-top: 2px;
        }
        /* Right panel */
        .panel-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            background: var(--bg-body);
            transition: background 0.3s;
        }
        .form-card {
            width: 100%;
            max-width: 420px;
        }
        .form-header {
            margin-bottom: 2rem;
        }
        .form-header h2 {
            font-family: 'Sora', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--text-1);
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }
        .form-header p {
            font-size: 15px;
            color: var(--text-2);
        }
        .alert-error {
            background: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: var(--danger-text);
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            font-size: 14px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-error svg { flex-shrink: 0; width: 16px; height: 16px; }
        .alert-success {
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            color: var(--success-text);
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            font-size: 14px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .field {
            margin-bottom: 1.25rem;
        }
        .field label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-1);
            margin-bottom: 8px;
        }
        .input-wrap {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-3);
            width: 18px; height: 18px;
            pointer-events: none;
        }
        .field input {
            width: 100%;
            height: 48px;
            padding: 0 16px 0 44px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            color: var(--text-1);
            background: var(--surface);
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .field input:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.1);
        }
        .field input::placeholder { color: var(--text-3); }
        .btn-primary {
            width: 100%;
            height: 50px;
            background: var(--brand);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.15s, transform 0.1s;
            margin-top: 1.5rem;
        }
        .btn-primary:hover { background: var(--brand-dark); }
        .btn-primary:active { transform: scale(0.99); }
        .btn-primary svg { width: 18px; height: 18px; }
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 1.5rem 0;
            color: var(--text-3);
            font-size: 13px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }
        .link-text {
            text-align: center;
            font-size: 14px;
            color: var(--text-2);
        }
        .link-text a {
            color: var(--brand);
            font-weight: 500;
            text-decoration: none;
        }
        .link-text a:hover { text-decoration: underline; }
        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 2rem 1.5rem; }
        }
    </style>
    @vite('resources/js/app.js')
</head>
<body>
    <!-- Dark mode toggle button -->
    <button id="darkModeToggle" style="position:fixed;top:1.5rem;right:1.5rem;width:44px;height:44px;border-radius:12px;border:1.5px solid var(--border);background:var(--surface);cursor:pointer;display:grid;place-items:center;color:var(--text-2);transition:all 0.15s;z-index:1000;box-shadow:var(--shadow);" title="Toggle Dark Mode">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
    </button>
    <!-- Left panel -->
    <div class="panel-left">
        <div class="panel-brand">
            <div class="brand-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            </div>
            <span class="brand-name">Suara Siswa</span>
        </div>
        <div class="hero-text">
            <h1>Sampaikan<br><span>aspirasimu</span><br>dengan berani.</h1>
            <p>Platform pengaduan siswa yang aman, cepat, dan ditangani dengan serius oleh petugas sekolah.</p>
        </div>
        <div class="hero-stats">
            <div class="stat">
                <div class="stat-num">3×24</div>
                <div class="stat-label">Jam respons</div>
            </div>
            <div class="stat">
                <div class="stat-num">100%</div>
                <div class="stat-label">Aman & rahasia</div>
            </div>
            <div class="stat">
                <div class="stat-num">Real-time</div>
                <div class="stat-label">Tracking status</div>
            </div>
        </div>
    </div>

    <!-- Right panel -->
    <div class="panel-right">
        <div class="form-card">
            <div class="form-header">
                <h2>Selamat datang 👋</h2>
                <p>Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            @if(session('error'))
                <div class="alert-error">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert-success">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="field">
                    <label for="username">Username</label>
                    <div class="input-wrap">
                        <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <input type="text" id="username" name="username" placeholder="Masukkan username" autofocus required>
                    </div>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary">
                    Masuk
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </button>
            </form>

            <div class="divider">atau</div>
            <p class="link-text">
                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
            </p>
        </div>
    </div>
</body>
</html>