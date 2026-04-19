<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Suara Siswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root {
            --brand: #1A56DB; --brand-dark: #1341AB; --brand-light: #EBF2FF;
            --surface: #FFFFFF; --surface-2: #F8FAFF; --border: #E2E8F0;
            --text-1: #0F172A; --text-2: #475569; --text-3: #94A3B8;
            --success: #059669; --warning: #D97706; --danger: #DC2626;
            --radius: 16px; --radius-sm: 10px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #F4F7FF; color: var(--text-1); min-height: 100vh; }
        nav { position: sticky; top: 0; z-index: 100; background: #fff; border-bottom: 1px solid var(--border); }
        .nav-inner { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; height: 62px; display: flex; align-items: center; justify-content: space-between; }
        .brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon { width: 36px; height: 36px; background: var(--brand); border-radius: 10px; display: grid; place-items: center; }
        .brand-icon svg { width: 18px; height: 18px; }
        .brand-name { font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 600; color: var(--text-1); letter-spacing: -0.3px; }
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-link { padding: 7px 14px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; color: var(--text-2); transition: all 0.15s; }
        .nav-link:hover { background: var(--surface-2); color: var(--text-1); }
        .nav-link.active { background: var(--brand-light); color: var(--brand); }
        .btn-nav { padding: 8px 16px; border-radius: 8px; font-size: 14px; font-weight: 500; background: var(--brand); color: #fff; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: background 0.15s; margin-left: 8px; border: none; font-family: 'DM Sans', sans-serif; cursor: pointer; }
        .btn-nav:hover { background: var(--brand-dark); }
        .user-area { display: flex; align-items: center; gap: 12px; }
        .avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--brand-light); display: grid; place-items: center; font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 600; color: var(--brand); }
        .user-name { font-size: 14px; font-weight: 500; }
        .btn-logout { padding: 7px 14px; border-radius: 8px; border: 1.5px solid var(--border); background: #fff; font-family: 'DM Sans', sans-serif; font-size: 13.5px; font-weight: 500; color: #64748B; cursor: pointer; display: flex; align-items: center; gap: 6px; transition: all 0.15s; }
        .btn-logout:hover { border-color: #CBD5E1; background: var(--surface-2); }
        main { max-width: 1100px; margin: 0 auto; padding: 2.5rem 1.5rem; }
        /* Hero banner */
        .hero-banner {
            background: linear-gradient(120deg, #1A56DB 0%, #1E3A8A 100%);
            border-radius: 20px;
            padding: 2.5rem 3rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
            position: relative;
        }
        .hero-banner::before {
            content: '';
            position: absolute;
            right: -60px; top: -80px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .hero-content { position: relative; z-index: 1; }
        .hero-greeting { font-size: 14px; color: rgba(255,255,255,0.6); margin-bottom: 6px; }
        .hero-name { font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 700; color: #fff; letter-spacing: -0.5px; margin-bottom: 10px; }
        .hero-desc { font-size: 15px; color: rgba(255,255,255,0.7); line-height: 1.6; max-width: 420px; }
        .hero-actions { display: flex; gap: 12px; margin-top: 1.5rem; }
        .btn-hero-primary { padding: 10px 20px; border-radius: 10px; background: #fff; color: var(--brand); font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 7px; transition: transform 0.15s; }
        .btn-hero-primary:hover { transform: translateY(-1px); }
        .btn-hero-secondary { padding: 10px 20px; border-radius: 10px; background: rgba(255,255,255,0.12); color: #fff; font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500; text-decoration: none; display: flex; align-items: center; gap: 7px; border: 1px solid rgba(255,255,255,0.2); transition: background 0.15s; }
        .btn-hero-secondary:hover { background: rgba(255,255,255,0.18); }
        .hero-illustration { position: relative; z-index: 1; }
        .hero-illustration svg { width: 120px; height: 120px; opacity: 0.18; }
        /* Stats */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 2rem; }
        .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.25rem 1.5rem; transition: box-shadow 0.15s; }
        .stat-card:hover { box-shadow: 0 4px 16px rgba(15,23,42,0.08); }
        .stat-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
        .stat-icon { width: 38px; height: 38px; border-radius: 10px; display: grid; place-items: center; }
        .stat-icon svg { width: 18px; height: 18px; }
        .stat-badge { font-size: 11px; font-weight: 500; padding: 3px 9px; border-radius: 20px; }
        .stat-num { font-family: 'Sora', sans-serif; font-size: 30px; font-weight: 700; letter-spacing: -1px; margin-bottom: 2px; }
        .stat-label { font-size: 13px; color: var(--text-2); }
        /* Quick actions */
        .section-title { font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 600; color: var(--text-1); letter-spacing: -0.3px; margin-bottom: 1rem; }
        .actions-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 2rem; }
        .action-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.5rem; text-decoration: none; color: inherit; transition: all 0.15s; display: flex; flex-direction: column; gap: 10px; }
        .action-card:hover { box-shadow: 0 4px 16px rgba(15,23,42,0.08); transform: translateY(-2px); border-color: #CBD5E1; }
        .action-icon { width: 44px; height: 44px; border-radius: 12px; display: grid; place-items: center; }
        .action-icon svg { width: 20px; height: 20px; }
        .action-title { font-size: 15px; font-weight: 600; color: var(--text-1); }
        .action-desc { font-size: 13px; color: var(--text-2); line-height: 1.5; }
        /* Info box */
        .info-box { background: var(--brand-light); border: 1px solid #BFDBFE; border-radius: var(--radius); padding: 1.25rem 1.5rem; display: flex; align-items: flex-start; gap: 14px; margin-bottom: 2rem; }
        .info-box svg { width: 20px; height: 20px; color: var(--brand); flex-shrink: 0; margin-top: 1px; }
        .info-box-text h4 { font-size: 14px; font-weight: 600; color: var(--brand); margin-bottom: 4px; }
        .info-box-text p { font-size: 13.5px; color: #3B82F6; line-height: 1.5; }
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .actions-grid { grid-template-columns: 1fr; }
            .hero-banner { padding: 2rem 1.5rem; flex-direction: column; }
            .hero-illustration { display: none; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-inner">
            <a href="{{ route('user.dashboard') }}" class="brand">
                <div class="brand-icon"><svg fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg></div>
                <span class="brand-name">Suara Siswa</span>
            </a>
            <div class="nav-links">
                <a href="{{ route('user.dashboard') }}" class="nav-link active">Dashboard</a>
                <a href="{{ route('user.pengaduan.index') }}" class="nav-link">Pengaduan Saya</a>
                <a href="{{ route('user.pengaduan.create') }}" class="btn-nav">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Buat Pengaduan
                </a>
            </div>
            <div class="user-area">
                <div class="avatar">{{ strtoupper(substr(Auth::user()->nama ?? Auth::user()->username, 0, 1)) }}</div>
                <span class="user-name">{{ Auth::user()->nama ?? Auth::user()->username }}</span>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main>
        <!-- Flash messages -->
        @if(session('success'))
            <div style="background:#F0FDF4;border:1px solid #BBF7D0;color:#15803D;border-radius:10px;padding:12px 16px;margin-bottom:1.5rem;font-size:14px;display:flex;align-items:center;gap:10px;">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Hero Banner -->
        <div class="hero-banner">
            <div class="hero-content">
                <p class="hero-greeting">Halo, selamat datang kembali!</p>
                <h1 class="hero-name">{{ Auth::user()->nama ?? Auth::user()->username }} 👋</h1>
                <p class="hero-desc">Sampaikan pengaduanmu dan kami akan memastikan suaramu didengar oleh yang berwenang.</p>
                <div class="hero-actions">
                    <a href="{{ route('user.pengaduan.create') }}" class="btn-hero-primary">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Buat Pengaduan
                    </a>
                    <a href="{{ route('user.pengaduan.index') }}" class="btn-hero-secondary">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Lihat Riwayat
                    </a>
                </div>
            </div>
            <div class="hero-illustration">
                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" stroke="white" stroke-width="2"/>
                    <path d="M30 40h40M30 50h30M30 60h20" stroke="white" stroke-width="3" stroke-linecap="round"/>
                    <circle cx="70" cy="62" r="12" fill="white" fill-opacity="0.2" stroke="white" stroke-width="2"/>
                    <path d="M66 62l3 3 6-6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon" style="background:#EBF2FF;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="#1A56DB" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="stat-badge" style="background:#EBF2FF;color:#1A56DB;">Total</span>
                </div>
                <div class="stat-num" style="color:#1A56DB;">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Pengaduan</div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon" style="background:#FFFBEB;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="#D97706" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span class="stat-badge" style="background:#FFFBEB;color:#D97706;">Menunggu</span>
                </div>
                <div class="stat-num" style="color:#D97706;">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon" style="background:#EFF6FF;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="#3B82F6" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <span class="stat-badge" style="background:#EFF6FF;color:#3B82F6;">Diproses</span>
                </div>
                <div class="stat-num" style="color:#3B82F6;">{{ $stats['proses'] }}</div>
                <div class="stat-label">Dalam Proses</div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon" style="background:#F0FDF4;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="#059669" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span class="stat-badge" style="background:#F0FDF4;color:#059669;">Tuntas</span>
                </div>
                <div class="stat-num" style="color:#059669;">{{ $stats['selesai'] }}</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <p class="section-title">Aksi Cepat</p>
        <div class="actions-grid">
            <a href="{{ route('user.pengaduan.create') }}" class="action-card">
                <div class="action-icon" style="background:#EBF2FF;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="#1A56DB" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <div class="action-title">Buat Pengaduan Baru</div>
                    <div class="action-desc">Sampaikan keluhan atau masalah yang kamu hadapi di sekolah</div>
                </div>
            </a>
            <a href="{{ route('user.pengaduan.index') }}" class="action-card">
                <div class="action-icon" style="background:#F3F4F6;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="#374151" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <div class="action-title">Riwayat Pengaduan</div>
                    <div class="action-desc">Lihat semua pengaduan yang pernah kamu kirimkan</div>
                </div>
            </a>
            <div class="action-card" style="background:#FFFBEB;border-color:#FDE68A;cursor:default;">
                <div class="action-icon" style="background:#FEF3C7;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="#D97706" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <div class="action-title" style="color:#92400E;">Panduan Pengaduan</div>
                    <div class="action-desc" style="color:#B45309;">Pengaduan yang jelas dan detail akan lebih cepat ditangani petugas</div>
                </div>
            </div>
        </div>

        <!-- Info box -->
        <div class="info-box">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="info-box-text">
                <h4>Tentang Kerahasiaan Data</h4>
                <p>Semua pengaduan yang kamu kirimkan hanya dapat dilihat oleh petugas yang berwenang. Identitasmu terjaga dengan aman di sistem kami.</p>
            </div>
        </div>
    </main>
</body>
</html>