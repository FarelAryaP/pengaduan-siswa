<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas — Suara Siswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root { --brand:#1A56DB;--brand-dark:#1341AB;--brand-light:#EBF2FF;--surface:#FFFFFF;--surface-2:#F8FAFF;--border:#E2E8F0;--text-1:#0F172A;--text-2:#475569;--text-3:#94A3B8;--radius:16px;--radius-sm:10px; }
        * { box-sizing:border-box;margin:0;padding:0; }
        body { font-family:'DM Sans',sans-serif;background:#F4F7FF;color:var(--text-1);min-height:100vh;display:flex;flex-direction:column; }
        /* Sidebar */
        .layout { display:grid;grid-template-columns:240px 1fr;min-height:100vh; }
        .sidebar { background:#0F172A;display:flex;flex-direction:column;padding:0; position:sticky;top:0;height:100vh;overflow-y:auto; }
        .sidebar-brand { padding:1.25rem 1.5rem;border-bottom:1px solid rgba(255,255,255,0.08);display:flex;align-items:center;gap:10px; }
        .sidebar-brand-icon { width:34px;height:34px;background:var(--brand);border-radius:9px;display:grid;place-items:center; }
        .sidebar-brand-name { font-family:'Sora',sans-serif;font-size:15px;font-weight:600;color:#fff;letter-spacing:-0.2px; }
        .sidebar-section { padding:1rem 1rem 0; }
        .sidebar-label { font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;color:rgba(255,255,255,0.25);padding:0 8px;margin-bottom:6px; }
        .sidebar-nav { display:flex;flex-direction:column;gap:2px; }
        .sidebar-link { display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:9px;text-decoration:none;font-size:14px;font-weight:500;color:rgba(255,255,255,0.55);transition:all 0.15s; }
        .sidebar-link:hover { background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.85); }
        .sidebar-link.active { background:rgba(26,86,219,0.25);color:#93C5FD; }
        .sidebar-link svg { width:17px;height:17px;flex-shrink:0; }
        .sidebar-badge { margin-left:auto;font-size:11px;font-weight:600;padding:2px 8px;border-radius:10px;background:rgba(255,255,255,0.1);color:rgba(255,255,255,0.5); }
        .sidebar-badge.warn { background:rgba(245,158,11,0.2);color:#FCD34D; }
        .sidebar-footer { margin-top:auto;padding:1rem;border-top:1px solid rgba(255,255,255,0.08); }
        .sidebar-user { display:flex;align-items:center;gap:10px; }
        .sidebar-avatar { width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,0.1);display:grid;place-items:center;font-family:'Sora',sans-serif;font-size:13px;font-weight:600;color:#93C5FD; }
        .sidebar-username { font-size:13.5px;font-weight:500;color:rgba(255,255,255,0.8);flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
        .btn-sidebar-logout { width:28px;height:28px;border-radius:7px;background:rgba(255,255,255,0.06);border:none;cursor:pointer;display:grid;place-items:center;color:rgba(255,255,255,0.4);transition:all 0.15s; }
        .btn-sidebar-logout:hover { background:rgba(220,38,38,0.2);color:#FCA5A5; }
        /* Main content */
        .main-content { overflow:auto; }
        .topbar { background:#fff;border-bottom:1px solid var(--border);padding:0 2rem;height:60px;display:flex;align-items:center;justify-content:space-between; }
        .topbar-title { font-family:'Sora',sans-serif;font-size:17px;font-weight:600;color:var(--text-1);letter-spacing:-0.3px; }
        .topbar-right { display:flex;align-items:center;gap:12px; }
        .topbar-date { font-size:13px;color:var(--text-3); }
        .badge-petugas { padding:4px 10px;border-radius:20px;background:var(--brand-light);color:var(--brand);font-size:12px;font-weight:600; }
        .content { padding:2rem; }
        /* Stats */
        .stats-grid { display:grid;grid-template-columns:repeat(5,1fr);gap:14px;margin-bottom:2rem; }
        .stat-card { background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:1.25rem;transition:box-shadow 0.15s; }
        .stat-card:hover { box-shadow:0 4px 16px rgba(15,23,42,0.08); }
        .stat-top { display:flex;align-items:center;gap:10px;margin-bottom:10px; }
        .stat-icon { width:36px;height:36px;border-radius:10px;display:grid;place-items:center; }
        .stat-num { font-family:'Sora',sans-serif;font-size:28px;font-weight:700;letter-spacing:-1px;line-height:1; }
        .stat-label { font-size:12.5px;color:var(--text-2);margin-top:2px; }
        /* Recent table */
        .section-header { display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem; }
        .section-title { font-family:'Sora',sans-serif;font-size:16px;font-weight:600;color:var(--text-1);letter-spacing:-0.2px; }
        .link-all { font-size:13.5px;font-weight:500;color:var(--brand);text-decoration:none;display:flex;align-items:center;gap:5px; }
        .link-all svg { width:14px;height:14px; }
        .table-card { background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden; }
        table { width:100%;border-collapse:collapse; }
        thead th { padding:10px 16px;text-align:left;font-size:12px;font-weight:600;color:var(--text-3);text-transform:uppercase;letter-spacing:0.4px;background:var(--surface-2);border-bottom:1px solid var(--border); }
        tbody tr { border-bottom:1px solid var(--border);transition:background 0.1s; }
        tbody tr:last-child { border-bottom:none; }
        tbody tr:hover { background:var(--surface-2); }
        td { padding:12px 16px;font-size:14px;color:var(--text-1); }
        .td-title { font-weight:500;max-width:220px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
        .td-user { color:var(--text-2);font-size:13px; }
        .td-date { color:var(--text-3);font-size:13px; }
        .status-chip { padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500; }
        .chip-pending { background:#FFFBEB;color:#B45309; }
        .chip-proses { background:#EFF6FF;color:#1D4ED8; }
        .chip-selesai { background:#F0FDF4;color:#15803D; }
        .btn-sm { padding:5px 12px;border-radius:7px;font-size:12.5px;font-weight:500;text-decoration:none;background:var(--brand-light);color:var(--brand);border:none;cursor:pointer;font-family:'DM Sans',sans-serif;transition:background 0.15s; }
        .btn-sm:hover { background:#DBEAFE; }
        @media(max-width:900px) { .layout{grid-template-columns:1fr;} .sidebar{display:none;} .stats-grid{grid-template-columns:repeat(2,1fr);} }
    </style>
</head>
<body>
    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-icon"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg></div>
                <span class="sidebar-brand-name">Suara Siswa</span>
            </div>
            <div class="sidebar-section" style="margin-top:1rem;">
                <p class="sidebar-label">Menu</p>
                <div class="sidebar-nav">
                    <a href="{{ route('petugas.dashboard') }}" class="sidebar-link active">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('petugas.pengaduan.index') }}" class="sidebar-link">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Kelola Pengaduan
                        @if($stats['pending'] > 0)
                            <span class="sidebar-badge warn">{{ $stats['pending'] }}</span>
                        @endif
                    </a>
                </div>
            </div>
            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->nama ?? Auth::user()->username, 0, 1)) }}</div>
                    <span class="sidebar-username">{{ Auth::user()->nama ?? Auth::user()->username }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-sidebar-logout" title="Logout">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main -->
        <div class="main-content">
            <div class="topbar">
                <span class="topbar-title">Dashboard Petugas</span>
                <div class="topbar-right">
                    <span class="topbar-date">{{ now()->translatedFormat('l, d F Y') }}</span>
                    <span class="badge-petugas">Petugas</span>
                </div>
            </div>
            <div class="content">
                <!-- Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon" style="background:#EBF2FF;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#1A56DB" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586l5.707 5.707V19a2 2 0 01-2 2z"/></svg></div>
                        </div>
                        <div class="stat-num" style="color:#1A56DB;">{{ $stats['total_pengaduan'] }}</div>
                        <div class="stat-label">Total Pengaduan</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon" style="background:#FFFBEB;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#D97706" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                        </div>
                        <div class="stat-num" style="color:#D97706;">{{ $stats['pending'] }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon" style="background:#EFF6FF;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#3B82F6" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9"/></svg></div>
                        </div>
                        <div class="stat-num" style="color:#3B82F6;">{{ $stats['proses'] }}</div>
                        <div class="stat-label">Dalam Proses</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon" style="background:#F0FDF4;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#059669" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                        </div>
                        <div class="stat-num" style="color:#059669;">{{ $stats['selesai'] }}</div>
                        <div class="stat-label">Selesai</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon" style="background:#F5F3FF;"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#7C3AED" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
                        </div>
                        <div class="stat-num" style="color:#7C3AED;">{{ $stats['total_users'] }}</div>
                        <div class="stat-label">Total Siswa</div>
                    </div>
                </div>

                <!-- Recent -->
                <div class="section-header">
                    <h2 class="section-title">Pengaduan Terbaru</h2>
                    <a href="{{ route('petugas.pengaduan.index') }}" class="link-all">
                        Lihat semua
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
                <div class="table-card">
                    @if($recentPengaduan->isEmpty())
                        <div style="text-align:center;padding:3rem 2rem;color:var(--text-3);font-size:14px;">Belum ada pengaduan masuk</div>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Siswa</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPengaduan as $p)
                                    <tr>
                                        <td class="td-title" title="{{ $p->judul }}">{{ $p->judul }}</td>
                                        <td class="td-user">{{ $p->user->nama ?? $p->user->username }}</td>
                                        <td class="td-date">{{ $p->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if($p->status === 'pending')
                                                <span class="status-chip chip-pending">⏳ Pending</span>
                                            @elseif($p->status === 'proses')
                                                <span class="status-chip chip-proses">🔄 Proses</span>
                                            @else
                                                <span class="status-chip chip-selesai">✅ Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('petugas.pengaduan.show', $p->id) }}" class="btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>