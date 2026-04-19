<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan — Petugas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root { --brand:#1A56DB;--brand-dark:#1341AB;--brand-light:#EBF2FF;--surface:#FFFFFF;--surface-2:#F8FAFF;--border:#E2E8F0;--text-1:#0F172A;--text-2:#475569;--text-3:#94A3B8;--radius:16px;--radius-sm:10px; }
        * { box-sizing:border-box;margin:0;padding:0; }
        body { font-family:'DM Sans',sans-serif;background:#F4F7FF;color:var(--text-1);min-height:100vh; }
        .layout { display:grid;grid-template-columns:240px 1fr;min-height:100vh; }
        .sidebar { background:#0F172A;display:flex;flex-direction:column;padding:0;position:sticky;top:0;height:100vh;overflow-y:auto; }
        .sidebar-brand { padding:1.25rem 1.5rem;border-bottom:1px solid rgba(255,255,255,0.08);display:flex;align-items:center;gap:10px; }
        .sidebar-brand-icon { width:34px;height:34px;background:var(--brand);border-radius:9px;display:grid;place-items:center; }
        .sidebar-brand-name { font-family:'Sora',sans-serif;font-size:15px;font-weight:600;color:#fff; }
        .sidebar-section { padding:1rem 1rem 0; }
        .sidebar-label { font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;color:rgba(255,255,255,0.25);padding:0 8px;margin-bottom:6px; }
        .sidebar-nav { display:flex;flex-direction:column;gap:2px; }
        .sidebar-link { display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:9px;text-decoration:none;font-size:14px;font-weight:500;color:rgba(255,255,255,0.55);transition:all 0.15s; }
        .sidebar-link:hover { background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.85); }
        .sidebar-link.active { background:rgba(26,86,219,0.25);color:#93C5FD; }
        .sidebar-link svg { width:17px;height:17px;flex-shrink:0; }
        .sidebar-footer { margin-top:auto;padding:1rem;border-top:1px solid rgba(255,255,255,0.08); }
        .sidebar-user { display:flex;align-items:center;gap:10px; }
        .sidebar-avatar { width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,0.1);display:grid;place-items:center;font-family:'Sora',sans-serif;font-size:13px;font-weight:600;color:#93C5FD; }
        .sidebar-username { font-size:13.5px;font-weight:500;color:rgba(255,255,255,0.8);flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
        .btn-sidebar-logout { width:28px;height:28px;border-radius:7px;background:rgba(255,255,255,0.06);border:none;cursor:pointer;display:grid;place-items:center;color:rgba(255,255,255,0.4); }
        .btn-sidebar-logout:hover { background:rgba(220,38,38,0.2);color:#FCA5A5; }
        .main-content { overflow:auto; }
        .topbar { background:#fff;border-bottom:1px solid var(--border);padding:0 2rem;height:60px;display:flex;align-items:center;justify-content:space-between; }
        .topbar-title { font-family:'Sora',sans-serif;font-size:17px;font-weight:600;color:var(--text-1); }
        .badge-petugas { padding:4px 10px;border-radius:20px;background:var(--brand-light);color:var(--brand);font-size:12px;font-weight:600; }
        .content { padding:2rem; }
        /* Layout */
        .detail-grid { display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start; }
        /* Breadcrumb */
        .breadcrumb { display:flex;align-items:center;gap:8px;font-size:13.5px;color:var(--text-3);margin-bottom:1.5rem; }
        .breadcrumb a { color:var(--brand);text-decoration:none; }
        .breadcrumb svg { width:14px;height:14px; }
        /* Alert */
        .alert { border-radius:10px;padding:12px 16px;font-size:14px;margin-bottom:1.5rem;display:flex;align-items:center;gap:10px; }
        .alert svg { width:16px;height:16px; }
        .alert-success { background:#F0FDF4;border:1px solid #BBF7D0;color:#15803D; }
        /* Main card */
        .main-card { background:var(--surface);border:1px solid var(--border);border-radius:20px;overflow:hidden; }
        .card-head { padding:1.75rem 2rem;border-bottom:1px solid var(--border); }
        .card-title { font-family:'Sora',sans-serif;font-size:20px;font-weight:700;color:var(--text-1);letter-spacing:-0.3px;margin-bottom:10px; }
        .card-meta { display:flex;align-items:center;gap:14px;flex-wrap:wrap; }
        .meta-item { display:flex;align-items:center;gap:5px;font-size:13px;color:var(--text-3); }
        .meta-item svg { width:13px;height:13px; }
        .user-chip { display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--surface-2);border:1px solid var(--border);border-radius:10px;margin-top:1rem; }
        .user-chip-avatar { width:32px;height:32px;border-radius:50%;background:var(--brand-light);display:grid;place-items:center;font-family:'Sora',sans-serif;font-size:12px;font-weight:600;color:var(--brand); }
        .user-chip-name { font-size:14px;font-weight:500;color:var(--text-1); }
        .user-chip-sub { font-size:12.5px;color:var(--text-3); }
        .card-section { padding:1.5rem 2rem;border-bottom:1px solid var(--border); }
        .card-section:last-child { border-bottom:none; }
        .section-label { font-size:11.5px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:var(--text-3);margin-bottom:12px; }
        .content-text { font-size:15px;color:var(--text-2);line-height:1.75;white-space:pre-line; }
        .foto-img { width:100%;border-radius:var(--radius-sm);cursor:pointer;max-height:360px;object-fit:contain;transition:opacity 0.15s; }
        .foto-img:hover { opacity:0.9; }
        /* Sidebar cards */
        .side-card { background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;margin-bottom:1rem; }
        .side-card-head { padding:1rem 1.25rem;border-bottom:1px solid var(--border); }
        .side-card-title { font-size:14px;font-weight:600;color:var(--text-1); }
        .side-card-body { padding:1.25rem; }
        /* Status display */
        .status-display { border-radius:10px;padding:12px;text-align:center;font-size:14px;font-weight:600;margin-bottom:1rem; }
        .status-pending { background:#FFFBEB;color:#B45309;border:1px solid #FDE68A; }
        .status-proses { background:#EFF6FF;color:#1D4ED8;border:1px solid #BFDBFE; }
        .status-selesai { background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0; }
        /* Status form */
        .status-select { width:100%;height:44px;padding:0 12px;border:1.5px solid var(--border);border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:14.5px;color:var(--text-1);background:var(--surface-2);outline:none;margin-bottom:1rem;cursor:pointer; }
        .status-select:focus { border-color:var(--brand);box-shadow:0 0 0 3px rgba(26,86,219,0.08); }
        .btn-update { width:100%;height:44px;background:var(--brand);color:#fff;border:none;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:14px;font-weight:500;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:7px;transition:background 0.15s;margin-bottom:10px; }
        .btn-update:hover { background:var(--brand-dark); }
        .btn-back { width:100%;height:40px;background:var(--surface-2);color:var(--text-2);border:1.5px solid var(--border);border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:14px;font-weight:500;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:7px;text-decoration:none;transition:all 0.15s;margin-bottom:8px; }
        .btn-back:hover { background:#EEF2FF; }
        .btn-delete { width:100%;height:40px;background:#FEF2F2;color:#DC2626;border:1.5px solid #FECACA;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:14px;font-weight:500;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:7px;transition:all 0.15s; }
        .btn-delete:hover { background:#FEE2E2; }
        /* Lightbox */
        .lightbox { display:none;position:fixed;inset:0;background:rgba(0,0,0,0.88);z-index:999;align-items:center;justify-content:center;padding:2rem; }
        .lightbox.open { display:flex; }
        .lightbox-close { position:absolute;top:1.5rem;right:1.5rem;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.12);border:none;cursor:pointer;display:grid;place-items:center;color:#fff; }
        .lightbox img { max-width:100%;max-height:85vh;border-radius:12px;object-fit:contain; }
        @media(max-width:900px) { .layout{grid-template-columns:1fr;} .sidebar{display:none;} .detail-grid{grid-template-columns:1fr;} }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-icon"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg></div>
                <span class="sidebar-brand-name">Suara Siswa</span>
            </div>
            <div class="sidebar-section" style="margin-top:1rem;">
                <p class="sidebar-label">Menu</p>
                <div class="sidebar-nav">
                    <a href="{{ route('petugas.dashboard') }}" class="sidebar-link">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('petugas.pengaduan.index') }}" class="sidebar-link active">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586l5.707 5.707V19a2 2 0 01-2 2z"/></svg>
                        Kelola Pengaduan
                    </a>
                </div>
            </div>
            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->nama ?? Auth::user()->username, 0, 1)) }}</div>
                    <span class="sidebar-username">{{ Auth::user()->nama ?? Auth::user()->username }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-sidebar-logout"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg></button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="main-content">
            <div class="topbar">
                <span class="topbar-title">Detail Pengaduan</span>
                <span class="badge-petugas">Petugas</span>
            </div>
            <div class="content">
                @if(session('success'))
                    <div class="alert alert-success"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ session('success') }}</div>
                @endif

                <div class="breadcrumb">
                    <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    <a href="{{ route('petugas.pengaduan.index') }}">Pengaduan</a>
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    <span>Detail</span>
                </div>

                <div class="detail-grid">
                    <!-- Main content -->
                    <div>
                        <div class="main-card">
                            <div class="card-head">
                                <h1 class="card-title">{{ $pengaduan->judul }}</h1>
                                <div class="card-meta">
                                    <span class="meta-item"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>{{ $pengaduan->tanggal_lapor->format('d F Y') }}</span>
                                    <span class="meta-item"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $pengaduan->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="user-chip">
                                    <div class="user-chip-avatar">{{ strtoupper(substr($pengaduan->user->nama ?? $pengaduan->user->username, 0, 1)) }}</div>
                                    <div>
                                        <div class="user-chip-name">{{ $pengaduan->user->nama ?? $pengaduan->user->username }}</div>
                                        <div class="user-chip-sub">@{{ $pengaduan->user->username }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-section">
                                <p class="section-label">Isi Laporan</p>
                                <p class="content-text">{{ $pengaduan->isi_laporan }}</p>
                            </div>
                            @if($pengaduan->foto)
                                <div class="card-section">
                                    <p class="section-label">Foto Pendukung</p>
                                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" class="foto-img" alt="Foto Pengaduan" onclick="document.getElementById('lb').classList.add('open')">
                                    <p style="font-size:12.5px;color:var(--text-3);margin-top:8px;">Klik gambar untuk memperbesar</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div>
                        <!-- Status Update -->
                        <div class="side-card">
                            <div class="side-card-head">
                                <p class="side-card-title">Update Status</p>
                            </div>
                            <div class="side-card-body">
                                <p style="font-size:12.5px;color:var(--text-3);margin-bottom:8px;">Status saat ini:</p>
                                @if($pengaduan->status === 'pending')
                                    <div class="status-display status-pending">⏳ Pending</div>
                                @elseif($pengaduan->status === 'proses')
                                    <div class="status-display status-proses">🔄 Sedang Diproses</div>
                                @else
                                    <div class="status-display status-selesai">✅ Selesai</div>
                                @endif
                                <form action="{{ route('petugas.pengaduan.updateStatus', $pengaduan->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <p style="font-size:12.5px;color:var(--text-3);margin-bottom:8px;">Ubah status:</p>
                                    <select name="status" class="status-select" required>
                                        <option value="pending" {{ $pengaduan->status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                        <option value="proses" {{ $pengaduan->status === 'proses' ? 'selected' : '' }}>🔄 Sedang Diproses</option>
                                        <option value="selesai" {{ $pengaduan->status === 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                    </select>
                                    <button type="submit" class="btn-update">
                                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                        Simpan Perubahan
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="side-card">
                            <div class="side-card-head"><p class="side-card-title">Aksi</p></div>
                            <div class="side-card-body">
                                <a href="{{ route('petugas.pengaduan.index') }}" class="btn-back">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                                    Kembali ke Daftar
                                </a>
                                <form action="{{ route('petugas.pengaduan.destroy', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini secara permanen?')" style="margin:0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus Pengaduan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($pengaduan->foto)
        <div class="lightbox" id="lb" onclick="this.classList.remove('open')">
            <button class="lightbox-close" onclick="document.getElementById('lb').classList.remove('open')"><svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="" onclick="event.stopPropagation()">
        </div>
        <script>document.addEventListener('keydown',e=>{ if(e.key==='Escape') document.getElementById('lb').classList.remove('open'); });</script>
    @endif
</body>
</html>