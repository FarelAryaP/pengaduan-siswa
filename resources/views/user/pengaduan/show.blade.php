<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan — Suara Siswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root { --brand:#1A56DB;--brand-dark:#1341AB;--brand-light:#EBF2FF;--surface:#FFFFFF;--surface-2:#F8FAFF;--border:#E2E8F0;--text-1:#0F172A;--text-2:#475569;--text-3:#94A3B8;--radius:16px;--radius-sm:10px; }
        * { box-sizing:border-box;margin:0;padding:0; }
        body { font-family:'DM Sans',sans-serif;background:#F4F7FF;color:var(--text-1);min-height:100vh; }
        nav { position:sticky;top:0;z-index:100;background:#fff;border-bottom:1px solid var(--border); }
        .nav-inner { max-width:1100px;margin:0 auto;padding:0 1.5rem;height:62px;display:flex;align-items:center;justify-content:space-between; }
        .brand { display:flex;align-items:center;gap:10px;text-decoration:none; }
        .brand-icon { width:36px;height:36px;background:var(--brand);border-radius:10px;display:grid;place-items:center; }
        .brand-name { font-family:'Sora',sans-serif;font-size:16px;font-weight:600;color:var(--text-1); }
        .nav-links { display:flex;align-items:center;gap:4px; }
        .nav-link { padding:7px 14px;border-radius:8px;font-size:14px;font-weight:500;text-decoration:none;color:var(--text-2); }
        .nav-link:hover { background:var(--brand-light);color:var(--brand); }
        .user-area { display:flex;align-items:center;gap:12px; }
        .avatar { width:34px;height:34px;border-radius:50%;background:var(--brand-light);display:grid;place-items:center;font-family:'Sora',sans-serif;font-size:13px;font-weight:600;color:var(--brand); }
        .btn-logout { padding:7px 14px;border-radius:8px;border:1.5px solid var(--border);background:#fff;font-family:'DM Sans',sans-serif;font-size:13.5px;font-weight:500;color:#64748B;cursor:pointer;display:flex;align-items:center;gap:6px; }
        main { max-width:800px;margin:0 auto;padding:2.5rem 1.5rem 4rem; }
        .breadcrumb { display:flex;align-items:center;gap:8px;font-size:13.5px;color:var(--text-3);margin-bottom:1.5rem; }
        .breadcrumb a { color:var(--brand);text-decoration:none; }
        .breadcrumb svg { width:14px;height:14px; }
        /* Status header */
        .detail-header { background:#fff;border:1px solid var(--border);border-radius:20px;overflow:hidden;margin-bottom:1.5rem; }
        .header-top { padding:2rem; display:flex; justify-content:space-between;align-items:flex-start;gap:1rem; }
        .header-title { font-family:'Sora',sans-serif;font-size:22px;font-weight:700;color:var(--text-1);letter-spacing:-0.4px;margin-bottom:8px; }
        .header-meta { display:flex;align-items:center;gap:16px;flex-wrap:wrap; }
        .meta-item { display:flex;align-items:center;gap:5px;font-size:13px;color:var(--text-3); }
        .meta-item svg { width:14px;height:14px; }
        .status-pill { padding:6px 14px;border-radius:20px;font-size:13px;font-weight:600;flex-shrink:0; }
        .pill-pending { background:#FFFBEB;color:#B45309;border:1px solid #FDE68A; }
        .pill-proses { background:#EFF6FF;color:#1D4ED8;border:1px solid #BFDBFE; }
        .pill-selesai { background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0; }
        /* Progress track */
        .progress-track { padding:1.25rem 2rem;border-top:1px solid var(--border);display:flex;align-items:center;gap:0; }
        .prog-step { display:flex;flex-direction:column;align-items:center;gap:6px;flex:1; }
        .prog-circle { width:32px;height:32px;border-radius:50%;display:grid;place-items:center;border:2px solid var(--border);background:#fff; }
        .prog-circle.done { background:var(--brand);border-color:var(--brand); }
        .prog-circle.active { background:var(--brand-light);border-color:var(--brand); }
        .prog-circle svg { width:14px;height:14px; }
        .prog-label { font-size:12px;font-weight:500;color:var(--text-3);text-align:center; }
        .prog-label.done { color:var(--brand); }
        .prog-line { flex:1;height:2px;background:var(--border);margin-bottom:18px; }
        .prog-line.done { background:var(--brand); }
        /* Content card */
        .content-card { background:#fff;border:1px solid var(--border);border-radius:20px;overflow:hidden;margin-bottom:1.5rem; }
        .content-section { padding:1.5rem 2rem;border-bottom:1px solid var(--border); }
        .content-section:last-child { border-bottom:none; }
        .section-label { font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:var(--text-3);margin-bottom:12px; }
        .content-text { font-size:15px;color:var(--text-2);line-height:1.7;white-space:pre-line; }
        .foto-img { width:100%;max-height:400px;object-fit:contain;border-radius:var(--radius-sm);cursor:pointer;transition:opacity 0.15s; }
        .foto-img:hover { opacity:0.92; }
        /* Actions */
        .action-bar { display:flex;gap:12px;flex-wrap:wrap; }
        .btn-back { padding:11px 20px;border-radius:var(--radius-sm);background:var(--surface-2);color:var(--text-2);border:1.5px solid var(--border);font-family:'DM Sans',sans-serif;font-size:14px;font-weight:500;text-decoration:none;display:flex;align-items:center;gap:7px;transition:all 0.15s; }
        .btn-back:hover { background:#EEF2FF;border-color:#CBD5E1; }
        .btn-delete { padding:11px 20px;border-radius:var(--radius-sm);background:#FEF2F2;color:#DC2626;border:1.5px solid #FECACA;font-family:'DM Sans',sans-serif;font-size:14px;font-weight:500;cursor:pointer;display:flex;align-items:center;gap:7px;transition:all 0.15s; }
        .btn-delete:hover { background:#FEE2E2; }
        /* Lightbox */
        .lightbox { display:none;position:fixed;inset:0;background:rgba(0,0,0,0.88);z-index:999;align-items:center;justify-content:center;padding:2rem; }
        .lightbox.open { display:flex; }
        .lightbox-close { position:absolute;top:1.5rem;right:1.5rem;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.12);border:none;cursor:pointer;display:grid;place-items:center;color:#fff; }
        .lightbox-close svg { width:20px;height:20px; }
        .lightbox img { max-width:100%;max-height:85vh;border-radius:12px;object-fit:contain; }
        @media(max-width:768px) { .nav-links{display:none;} main{padding:2rem 1rem;} .header-top{flex-direction:column;} .progress-track{padding:1rem;} }
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
                <a href="{{ route('user.pengaduan.index') }}" class="nav-link">Pengaduan Saya</a>
            </div>
            <div class="user-area">
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
            <span>Detail</span>
        </div>

        <!-- Header card -->
        <div class="detail-header">
            <div class="header-top">
                <div>
                    <h1 class="header-title">{{ $pengaduan->judul }}</h1>
                    <div class="header-meta">
                        <span class="meta-item"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>{{ $pengaduan->tanggal_lapor->format('d F Y') }}</span>
                        <span class="meta-item"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $pengaduan->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @if($pengaduan->status === 'pending')
                    <span class="status-pill pill-pending">⏳ Pending</span>
                @elseif($pengaduan->status === 'proses')
                    <span class="status-pill pill-proses">🔄 Sedang Diproses</span>
                @else
                    <span class="status-pill pill-selesai">✅ Selesai</span>
                @endif
            </div>

            <!-- Progress track -->
            <div class="progress-track">
                <div class="prog-step">
                    <div class="prog-circle done">
                        <svg fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <span class="prog-label done">Terkirim</span>
                </div>
                <div class="prog-line {{ $pengaduan->status !== 'pending' ? 'done' : '' }}"></div>
                <div class="prog-step">
                    <div class="prog-circle {{ $pengaduan->status === 'proses' ? 'active' : ($pengaduan->status === 'selesai' ? 'done' : '') }}">
                        @if($pengaduan->status === 'selesai')
                            <svg fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        @elseif($pengaduan->status === 'proses')
                            <svg fill="none" viewBox="0 0 24 24" stroke="#1A56DB" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9"/></svg>
                        @else
                            <svg fill="none" viewBox="0 0 24 24" stroke="#CBD5E1" stroke-width="2"><circle cx="12" cy="12" r="3"/></svg>
                        @endif
                    </div>
                    <span class="prog-label {{ in_array($pengaduan->status, ['proses','selesai']) ? 'done' : '' }}">Diproses</span>
                </div>
                <div class="prog-line {{ $pengaduan->status === 'selesai' ? 'done' : '' }}"></div>
                <div class="prog-step">
                    <div class="prog-circle {{ $pengaduan->status === 'selesai' ? 'done' : '' }}">
                        @if($pengaduan->status === 'selesai')
                            <svg fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        @else
                            <svg fill="none" viewBox="0 0 24 24" stroke="#CBD5E1" stroke-width="2"><circle cx="12" cy="12" r="3"/></svg>
                        @endif
                    </div>
                    <span class="prog-label {{ $pengaduan->status === 'selesai' ? 'done' : '' }}">Selesai</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content-card">
            <div class="content-section">
                <p class="section-label">Isi Laporan</p>
                <p class="content-text">{{ $pengaduan->isi_laporan }}</p>
            </div>
            @if($pengaduan->foto)
                <div class="content-section">
                    <p class="section-label">Foto Pendukung</p>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" class="foto-img" onclick="document.getElementById('lightbox').classList.add('open')">
                    <p style="font-size:12.5px;color:var(--text-3);margin-top:8px;">Klik gambar untuk memperbesar</p>
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="action-bar">
            <a href="{{ route('user.pengaduan.index') }}" class="btn-back">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </a>
            @if($pengaduan->status === 'pending')
                <form action="{{ route('user.pengaduan.destroy', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')" style="margin:0;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Hapus Pengaduan
                    </button>
                </form>
            @endif
        </div>
    </main>

    @if($pengaduan->foto)
        <div class="lightbox" id="lightbox" onclick="this.classList.remove('open')">
            <button class="lightbox-close" onclick="document.getElementById('lightbox').classList.remove('open')"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" onclick="event.stopPropagation()">
        </div>
        <script>document.addEventListener('keydown', e => { if(e.key==='Escape') document.getElementById('lightbox').classList.remove('open'); });</script>
    @endif
</body>
</html>