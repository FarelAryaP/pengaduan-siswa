<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Saya — Suara Siswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root {
            --brand: #1A56DB; --brand-dark: #1341AB; --brand-light: #EBF2FF;
            --surface: #FFFFFF; --surface-2: #F8FAFF; --border: #E2E8F0;
            --text-1: #0F172A; --text-2: #475569; --text-3: #94A3B8;
            --radius: 16px; --radius-sm: 10px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #F4F7FF; color: var(--text-1); min-height: 100vh; }
        nav { position: sticky; top: 0; z-index: 100; background: #fff; border-bottom: 1px solid var(--border); }
        .nav-inner { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; height: 62px; display: flex; align-items: center; justify-content: space-between; }
        .brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon { width: 36px; height: 36px; background: var(--brand); border-radius: 10px; display: grid; place-items: center; }
        .brand-name { font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 600; color: var(--text-1); }
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-link { padding: 7px 14px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; color: var(--text-2); transition: all 0.15s; }
        .nav-link:hover, .nav-link.active { background: var(--brand-light); color: var(--brand); }
        .btn-nav { padding: 8px 16px; border-radius: 8px; font-size: 14px; font-weight: 500; background: var(--brand); color: #fff; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: background 0.15s; margin-left: 8px; border: none; font-family: 'DM Sans', sans-serif; cursor: pointer; }
        .btn-nav:hover { background: var(--brand-dark); }
        .user-area { display: flex; align-items: center; gap: 12px; }
        .avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--brand-light); display: grid; place-items: center; font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 600; color: var(--brand); }
        .user-name { font-size: 14px; font-weight: 500; }
        .btn-logout { padding: 7px 14px; border-radius: 8px; border: 1.5px solid var(--border); background: #fff; font-family: 'DM Sans', sans-serif; font-size: 13.5px; font-weight: 500; color: #64748B; cursor: pointer; display: flex; align-items: center; gap: 6px; }
        main { max-width: 1100px; margin: 0 auto; padding: 2.5rem 1.5rem; }
        /* Page header */
        .page-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 2rem; }
        .page-title { font-family: 'Sora', sans-serif; font-size: 24px; font-weight: 700; color: var(--text-1); letter-spacing: -0.5px; margin-bottom: 4px; }
        .page-sub { font-size: 14px; color: var(--text-2); }
        .btn-create { padding: 10px 20px; border-radius: 10px; background: var(--brand); color: #fff; font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: background 0.15s; }
        .btn-create:hover { background: var(--brand-dark); }
        /* Stats row */
        .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 2rem; }
        .stat-chip { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 1rem 1.25rem; display: flex; align-items: center; gap: 12px; }
        .stat-chip-icon { width: 36px; height: 36px; border-radius: 8px; display: grid; place-items: center; flex-shrink: 0; }
        .stat-chip-num { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; line-height: 1; }
        .stat-chip-label { font-size: 12.5px; color: var(--text-2); margin-top: 2px; }
        /* Filter tabs */
        .filter-bar { display: flex; gap: 8px; margin-bottom: 1.5rem; flex-wrap: wrap; }
        .filter-tab { padding: 7px 16px; border-radius: 20px; font-size: 13.5px; font-weight: 500; border: 1.5px solid var(--border); background: var(--surface); color: var(--text-2); cursor: pointer; text-decoration: none; transition: all 0.15s; }
        .filter-tab:hover { border-color: var(--brand); color: var(--brand); }
        .filter-tab.active { background: var(--brand); border-color: var(--brand); color: #fff; }
        /* Cards */
        .cards-list { display: flex; flex-direction: column; gap: 14px; }
        .complaint-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; transition: box-shadow 0.15s, border-color 0.15s; }
        .complaint-card:hover { box-shadow: 0 4px 20px rgba(15,23,42,0.08); border-color: #CBD5E1; }
        .card-body { padding: 1.25rem 1.5rem; display: flex; gap: 1rem; align-items: flex-start; }
        .card-thumb { width: 80px; height: 72px; object-fit: cover; border-radius: 10px; flex-shrink: 0; }
        .card-content { flex: 1; min-width: 0; }
        .card-row1 { display: flex; align-items: center; gap: 10px; margin-bottom: 6px; flex-wrap: wrap; }
        .card-title { font-size: 16px; font-weight: 600; color: var(--text-1); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .status-badge { padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 500; flex-shrink: 0; }
        .badge-pending { background: #FFFBEB; color: #B45309; }
        .badge-proses { background: #EFF6FF; color: #1D4ED8; }
        .badge-selesai { background: #F0FDF4; color: #15803D; }
        .card-excerpt { font-size: 14px; color: var(--text-2); line-height: 1.55; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 12px; }
        .card-meta { display: flex; align-items: center; gap: 16px; }
        .meta-item { display: flex; align-items: center; gap: 5px; font-size: 12.5px; color: var(--text-3); }
        .meta-item svg { width: 13px; height: 13px; }
        .card-actions { display: flex; align-items: center; justify-content: flex-end; gap: 8px; padding: 0.75rem 1.5rem; border-top: 1px solid var(--border); background: #FAFBFF; }
        .btn-detail { padding: 7px 16px; border-radius: 8px; background: var(--brand-light); color: var(--brand); font-size: 13.5px; font-weight: 500; text-decoration: none; border: none; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.15s; }
        .btn-detail:hover { background: #DBEAFE; }
        .btn-delete { padding: 7px 16px; border-radius: 8px; background: #FEF2F2; color: #DC2626; font-size: 13.5px; font-weight: 500; border: none; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.15s; }
        .btn-delete:hover { background: #FEE2E2; }
        /* Empty state */
        .empty-state { text-align: center; padding: 5rem 2rem; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); }
        .empty-icon { width: 80px; height: 80px; background: var(--surface-2); border-radius: 50%; display: grid; place-items: center; margin: 0 auto 1.5rem; }
        .empty-icon svg { width: 36px; height: 36px; color: var(--text-3); }
        .empty-title { font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 600; color: var(--text-1); margin-bottom: 8px; }
        .empty-desc { font-size: 14px; color: var(--text-2); margin-bottom: 2rem; }
        .btn-empty { display: inline-flex; align-items: center; gap: 8px; padding: 11px 24px; border-radius: 10px; background: var(--brand); color: #fff; font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500; text-decoration: none; }
        /* Alert */
        .alert { border-radius: 10px; padding: 12px 16px; font-size: 14px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; }
        .alert svg { width: 16px; height: 16px; flex-shrink: 0; }
        .alert-success { background: #F0FDF4; border: 1px solid #BBF7D0; color: #15803D; }
        .alert-error { background: #FEF2F2; border: 1px solid #FECACA; color: #B91C1C; }
        @media (max-width: 768px) {
            .stats-row { grid-template-columns: 1fr 1fr; }
            .nav-links { display: none; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }
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
                <a href="{{ route('user.dashboard') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('user.pengaduan.index') }}" class="nav-link active">Pengaduan Saya</a>
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
                    <button type="submit" class="btn-logout"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="alert alert-success"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>{{ session('error') }}</div>
        @endif

        <div class="page-header">
            <div>
                <h1 class="page-title">Pengaduan Saya</h1>
                <p class="page-sub">Riwayat seluruh pengaduan yang telah kamu kirimkan</p>
            </div>
            <a href="{{ route('user.pengaduan.create') }}" class="btn-create">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Buat Pengaduan Baru
            </a>
        </div>

        <div class="stats-row">
            <div class="stat-chip">
                <div class="stat-chip-icon" style="background:#EBF2FF;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#1A56DB" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                <div><div class="stat-chip-num" style="color:#1A56DB;">{{ $pengaduanList->count() }}</div><div class="stat-chip-label">Total</div></div>
            </div>
            <div class="stat-chip">
                <div class="stat-chip-icon" style="background:#FFFBEB;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#D97706" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                <div><div class="stat-chip-num" style="color:#D97706;">{{ $pengaduanList->where('status','pending')->count() }}</div><div class="stat-chip-label">Pending</div></div>
            </div>
            <div class="stat-chip">
                <div class="stat-chip-icon" style="background:#EFF6FF;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#3B82F6" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg></div>
                <div><div class="stat-chip-num" style="color:#3B82F6;">{{ $pengaduanList->where('status','proses')->count() }}</div><div class="stat-chip-label">Diproses</div></div>
            </div>
            <div class="stat-chip">
                <div class="stat-chip-icon" style="background:#F0FDF4;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#059669" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                <div><div class="stat-chip-num" style="color:#059669;">{{ $pengaduanList->where('status','selesai')->count() }}</div><div class="stat-chip-label">Selesai</div></div>
            </div>
        </div>

        @if($pengaduanList->isEmpty())
            <div class="empty-state">
                <div class="empty-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                <h3 class="empty-title">Belum ada pengaduan</h3>
                <p class="empty-desc">Kamu belum mengirimkan pengaduan apapun. Sampaikan aspirasimu sekarang!</p>
                <a href="{{ route('user.pengaduan.create') }}" class="btn-empty">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Buat Pengaduan Pertama
                </a>
            </div>
        @else
            <div class="cards-list">
                @foreach($pengaduanList as $pengaduan)
                    <div class="complaint-card">
                        <div class="card-body">
                            @if($pengaduan->foto)
                                <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto" class="card-thumb">
                            @endif
                            <div class="card-content">
                                <div class="card-row1">
                                    <span class="card-title">{{ $pengaduan->judul }}</span>
                                    @if($pengaduan->status === 'pending')
                                        <span class="status-badge badge-pending">⏳ Pending</span>
                                    @elseif($pengaduan->status === 'proses')
                                        <span class="status-badge badge-proses">🔄 Diproses</span>
                                    @else
                                        <span class="status-badge badge-selesai">✅ Selesai</span>
                                    @endif
                                </div>
                                <p class="card-excerpt">{{ $pengaduan->isi_laporan }}</p>
                                <div class="card-meta">
                                    <span class="meta-item"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>{{ $pengaduan->tanggal_lapor->format('d M Y') }}</span>
                                    <span class="meta-item"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $pengaduan->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('user.pengaduan.show', $pengaduan->id) }}" class="btn-detail">Lihat Detail</a>
                            @if($pengaduan->status === 'pending')
                                <form action="{{ route('user.pengaduan.destroy', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')" style="margin:0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>