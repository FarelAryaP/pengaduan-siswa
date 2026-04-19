<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan — Petugas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root {
            --brand:#1A56DB; --brand-dark:#1341AB; --brand-light:#EBF2FF;
            --surface:#FFFFFF; --surface-2:#F8FAFF; --border:#E2E8F0;
            --text-1:#0F172A; --text-2:#475569; --text-3:#94A3B8;
            --radius:16px; --radius-sm:10px;
            --sidebar-bg:#0F172A;
        }
        *{box-sizing:border-box;margin:0;padding:0;}
        body{font-family:'DM Sans',sans-serif;background:#F4F7FF;color:var(--text-1);min-height:100vh;}

        /* ── Layout ── */
        .layout{display:grid;grid-template-columns:240px 1fr;min-height:100vh;}

        /* ── Sidebar ── */
        .sidebar{background:var(--sidebar-bg);display:flex;flex-direction:column;position:sticky;top:0;height:100vh;overflow-y:auto;}
        .sb-brand{padding:1.25rem 1.5rem;border-bottom:1px solid rgba(255,255,255,0.08);display:flex;align-items:center;gap:10px;}
        .sb-brand-icon{width:34px;height:34px;background:var(--brand);border-radius:9px;display:grid;place-items:center;}
        .sb-brand-name{font-family:'Sora',sans-serif;font-size:15px;font-weight:600;color:#fff;}
        .sb-section{padding:1rem 1rem 0;}
        .sb-lbl{font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:.8px;color:rgba(255,255,255,.25);padding:0 8px;margin-bottom:6px;}
        .sb-nav{display:flex;flex-direction:column;gap:2px;}
        .sb-link{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:9px;text-decoration:none;font-size:14px;font-weight:500;color:rgba(255,255,255,.55);transition:all .15s;}
        .sb-link:hover{background:rgba(255,255,255,.07);color:rgba(255,255,255,.85);}
        .sb-link.active{background:rgba(26,86,219,.25);color:#93C5FD;}
        .sb-link svg{width:17px;height:17px;flex-shrink:0;}
        .sb-footer{margin-top:auto;padding:1rem;border-top:1px solid rgba(255,255,255,.08);}
        .sb-user{display:flex;align-items:center;gap:10px;}
        .sb-avatar{width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,.1);display:grid;place-items:center;font-family:'Sora',sans-serif;font-size:13px;font-weight:600;color:#93C5FD;}
        .sb-uname{font-size:13.5px;font-weight:500;color:rgba(255,255,255,.8);flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
        .sb-logout{width:28px;height:28px;border-radius:7px;background:rgba(255,255,255,.06);border:none;cursor:pointer;display:grid;place-items:center;color:rgba(255,255,255,.4);transition:all .15s;}
        .sb-logout:hover{background:rgba(220,38,38,.2);color:#FCA5A5;}

        /* ── Main ── */
        .main{overflow:auto;display:flex;flex-direction:column;}
        .topbar{background:#fff;border-bottom:1px solid var(--border);padding:0 2rem;height:60px;display:flex;align-items:center;justify-content:space-between;flex-shrink:0;}
        .topbar-title{font-family:'Sora',sans-serif;font-size:17px;font-weight:600;color:var(--text-1);}
        .badge-role{padding:4px 10px;border-radius:20px;background:var(--brand-light);color:var(--brand);font-size:12px;font-weight:600;}

        /* ── Content ── */
        .content{padding:2rem;flex:1;}
        .breadcrumb{display:flex;align-items:center;gap:8px;font-size:13.5px;color:var(--text-3);margin-bottom:1.5rem;}
        .breadcrumb a{color:var(--brand);text-decoration:none;}
        .breadcrumb svg{width:14px;height:14px;}

        /* ── Alert ── */
        .alert{border-radius:10px;padding:12px 16px;font-size:14px;margin-bottom:1.5rem;display:flex;align-items:center;gap:10px;}
        .alert svg{width:16px;height:16px;flex-shrink:0;}
        .alert-success{background:#F0FDF4;border:1px solid #BBF7D0;color:#15803D;}
        .alert-error{background:#FEF2F2;border:1px solid #FECACA;color:#B91C1C;}

        /* ── Two-column detail layout ── */
        .detail-grid{display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start;}

        /* ── Card base ── */
        .card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;margin-bottom:1.25rem;}
        .card:last-child{margin-bottom:0;}
        .card-head{padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
        .card-head-title{font-family:'Sora',sans-serif;font-size:15px;font-weight:600;color:var(--text-1);}
        .card-body{padding:1.5rem;}

        /* ── Pengaduan detail ── */
        .pd-title{font-family:'Sora',sans-serif;font-size:20px;font-weight:700;color:var(--text-1);letter-spacing:-.3px;margin-bottom:.75rem;}
        .pd-meta{display:flex;flex-wrap:wrap;gap:14px;margin-bottom:1rem;}
        .meta-item{display:flex;align-items:center;gap:5px;font-size:13px;color:var(--text-3);}
        .meta-item svg{width:13px;height:13px;}
        .user-chip{display:flex;align-items:center;gap:10px;padding:10px 14px;background:var(--surface-2);border:1px solid var(--border);border-radius:10px;margin-bottom:1.25rem;}
        .uc-avatar{width:36px;height:36px;border-radius:50%;background:var(--brand-light);display:grid;place-items:center;font-family:'Sora',sans-serif;font-size:13px;font-weight:600;color:var(--brand);flex-shrink:0;}
        .uc-name{font-size:14px;font-weight:500;color:var(--text-1);}
        .uc-sub{font-size:12px;color:var(--text-3);}
        .section-lbl{font-size:11.5px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:var(--text-3);margin-bottom:10px;}
        .content-text{font-size:15px;color:var(--text-2);line-height:1.75;white-space:pre-line;}
        .foto-img{width:100%;border-radius:var(--radius-sm);cursor:pointer;max-height:340px;object-fit:contain;transition:opacity .15s;}
        .foto-img:hover{opacity:.9;}
        .foto-hint{font-size:12px;color:var(--text-3);margin-top:6px;}

        /* ── Status badge ── */
        .status-pill{padding:5px 13px;border-radius:20px;font-size:13px;font-weight:600;flex-shrink:0;}
        .pill-pending{background:#FFFBEB;color:#B45309;border:1px solid #FDE68A;}
        .pill-proses{background:#EFF6FF;color:#1D4ED8;border:1px solid #BFDBFE;}
        .pill-selesai{background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;}

        /* ── Sidebar cards ── */
        /* Status update */
        .status-current{border-radius:10px;padding:11px;text-align:center;font-size:13.5px;font-weight:600;margin-bottom:.875rem;}
        .sc-pending{background:#FFFBEB;color:#B45309;border:1px solid #FDE68A;}
        .sc-proses{background:#EFF6FF;color:#1D4ED8;border:1px solid #BFDBFE;}
        .sc-selesai{background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;}
        .status-select{width:100%;height:42px;padding:0 12px;border:1.5px solid var(--border);border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:14px;color:var(--text-1);background:var(--surface-2);outline:none;margin-bottom:.875rem;cursor:pointer;appearance:auto;}
        .status-select:focus{border-color:var(--brand);box-shadow:0 0 0 3px rgba(26,86,219,.08);}
        .btn-full{width:100%;height:42px;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:14px;font-weight:500;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:7px;transition:all .15s;border:none;margin-bottom:8px;}
        .btn-brand{background:var(--brand);color:#fff;}
        .btn-brand:hover{background:var(--brand-dark);}
        .btn-ghost{background:var(--surface-2);color:var(--text-2);border:1.5px solid var(--border) !important;text-decoration:none;}
        .btn-ghost:hover{background:#EEF2FF;}
        .btn-danger{background:#FEF2F2;color:#DC2626;border:1.5px solid #FECACA !important;}
        .btn-danger:hover{background:#FEE2E2;}

        /* ── MESSAGING SECTION ── */
        .msg-section{display:flex;flex-direction:column;gap:0;}

        /* Thread */
        .msg-thread{padding:1.25rem 1.5rem;display:flex;flex-direction:column;gap:16px;min-height:120px;max-height:480px;overflow-y:auto;scroll-behavior:smooth;}
        .msg-thread::-webkit-scrollbar{width:4px;}
        .msg-thread::-webkit-scrollbar-track{background:transparent;}
        .msg-thread::-webkit-scrollbar-thumb{background:var(--border);border-radius:4px;}

        /* Empty thread */
        .thread-empty{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;padding:2.5rem 1rem;text-align:center;}
        .thread-empty svg{width:40px;height:40px;color:var(--text-3);opacity:.6;}
        .thread-empty p{font-size:13.5px;color:var(--text-3);}

        /* Bubble */
        .msg-bubble-wrap{display:flex;gap:10px;align-items:flex-end;}
        .msg-bubble-wrap.from-petugas{flex-direction:row-reverse;}

        .bubble-avatar{width:30px;height:30px;border-radius:50%;display:grid;place-items:center;font-family:'Sora',sans-serif;font-size:11px;font-weight:700;flex-shrink:0;margin-bottom:4px;}
        .ba-petugas{background:#1A56DB;color:#fff;}
        .ba-user{background:#E2E8F0;color:#475569;}

        .bubble-content{max-width:75%;}
        .bubble-name{font-size:11.5px;font-weight:600;color:var(--text-3);margin-bottom:4px;}
        .msg-bubble-wrap.from-petugas .bubble-name{text-align:right;}

        .bubble{padding:10px 14px;border-radius:16px;font-size:14px;line-height:1.6;position:relative;word-break:break-word;}
        /* Petugas bubble — biru, pojok kanan */
        .bubble-petugas{
            background:var(--brand);
            color:#fff;
            border-bottom-right-radius:4px;
        }
        /* User bubble — abu, pojok kiri */
        .bubble-user{
            background:#F1F5F9;
            color:var(--text-1);
            border-bottom-left-radius:4px;
        }

        .bubble-time{font-size:11px;margin-top:4px;color:var(--text-3);}
        .msg-bubble-wrap.from-petugas .bubble-time{text-align:right;}

        /* Delete btn on hover */
        .bubble-actions{display:none;gap:4px;align-items:center;margin-left:6px;margin-bottom:4px;}
        .msg-bubble-wrap:hover .bubble-actions{display:flex;}
        .msg-bubble-wrap.from-petugas .bubble-actions{order:-1;margin-left:0;margin-right:6px;}
        .btn-del-msg{background:none;border:none;cursor:pointer;width:26px;height:26px;border-radius:6px;display:grid;place-items:center;color:var(--text-3);transition:all .15s;}
        .btn-del-msg:hover{background:#FEE2E2;color:#DC2626;}
        .btn-del-msg svg{width:13px;height:13px;}

        /* System message */
        .msg-system{text-align:center;font-size:12px;color:var(--text-3);padding:4px 0;display:flex;align-items:center;gap:10px;}
        .msg-system::before,.msg-system::after{content:'';flex:1;height:1px;background:var(--border);}

        /* Input area */
        .msg-input-area{padding:1rem 1.5rem;border-top:1px solid var(--border);background:var(--surface-2);}
        .msg-input-hint{font-size:12px;color:var(--text-3);margin-bottom:8px;display:flex;align-items:center;gap:6px;}
        .msg-input-hint svg{width:13px;height:13px;}
        .msg-form{display:flex;gap:10px;align-items:flex-end;}
        .msg-textarea{flex:1;padding:10px 14px;border:1.5px solid var(--border);border-radius:12px;font-family:'DM Sans',sans-serif;font-size:14px;color:var(--text-1);background:#fff;resize:none;outline:none;min-height:44px;max-height:140px;transition:border-color .15s,box-shadow .15s;line-height:1.5;}
        .msg-textarea:focus{border-color:var(--brand);box-shadow:0 0 0 3px rgba(26,86,219,.08);}
        .msg-textarea::placeholder{color:var(--text-3);}
        .btn-send{width:44px;height:44px;border-radius:12px;background:var(--brand);border:none;cursor:pointer;display:grid;place-items:center;color:#fff;flex-shrink:0;transition:background .15s,transform .1s;}
        .btn-send:hover{background:var(--brand-dark);}
        .btn-send:active{transform:scale(.95);}
        .btn-send svg{width:18px;height:18px;}

        /* ── Lightbox ── */
        .lightbox{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:999;align-items:center;justify-content:center;padding:2rem;}
        .lightbox.open{display:flex;}
        .lb-close{position:absolute;top:1.5rem;right:1.5rem;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,.12);border:none;cursor:pointer;display:grid;place-items:center;color:#fff;}
        .lightbox img{max-width:100%;max-height:85vh;border-radius:12px;object-fit:contain;}

        @media(max-width:900px){
            .layout{grid-template-columns:1fr;}
            .sidebar{display:none;}
            .detail-grid{grid-template-columns:1fr;}
        }
    </style>
</head>
<body>
<div class="layout">

    {{-- ── Sidebar ── --}}
    <aside class="sidebar">
        <div class="sb-brand">
            <div class="sb-brand-icon">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
            </div>
            <span class="sb-brand-name">Suara Siswa</span>
        </div>
        <div class="sb-section" style="margin-top:1rem;">
            <p class="sb-lbl">Menu</p>
            <div class="sb-nav">
                <a href="{{ route('petugas.dashboard') }}" class="sb-link">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('petugas.pengaduan.index') }}" class="sb-link active">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586l5.707 5.707V19a2 2 0 01-2 2z"/></svg>
                    Kelola Pengaduan
                </a>
            </div>
        </div>
        <div class="sb-footer">
            <div class="sb-user">
                <div class="sb-avatar">{{ strtoupper(substr(Auth::user()->nama ?? Auth::user()->username, 0, 1)) }}</div>
                <span class="sb-uname">{{ Auth::user()->nama ?? Auth::user()->username }}</span>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="sb-logout" title="Logout">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ── Main Content ── --}}
    <div class="main">
        <div class="topbar">
            <span class="topbar-title">Detail Pengaduan</span>
            <span class="badge-role">Petugas</span>
        </div>

        <div class="content">
            {{-- Alerts --}}
            @if(session('success'))
                <div class="alert alert-success">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('petugas.pengaduan.index') }}">Pengaduan</a>
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span>Detail</span>
            </div>

            <div class="detail-grid">

                {{-- ═══ LEFT: Konten pengaduan + Thread pesan ═══ --}}
                <div>
                    {{-- Info Pengaduan --}}
                    <div class="card">
                        <div class="card-head">
                            <span class="card-head-title">Informasi Pengaduan</span>
                            @if($pengaduan->status === 'pending')
                                <span class="status-pill pill-pending">⏳ Pending</span>
                            @elseif($pengaduan->status === 'proses')
                                <span class="status-pill pill-proses">🔄 Diproses</span>
                            @else
                                <span class="status-pill pill-selesai">✅ Selesai</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h1 class="pd-title">{{ $pengaduan->judul }}</h1>
                            <div class="pd-meta">
                                <span class="meta-item">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $pengaduan->tanggal_lapor->format('d F Y') }}
                                </span>
                                <span class="meta-item">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $pengaduan->created_at->diffForHumans() }}
                                </span>
                            </div>

                            {{-- User chip --}}
                            <div class="user-chip">
                                <div class="uc-avatar">{{ strtoupper(substr($pengaduan->user->nama ?? $pengaduan->user->username, 0, 1)) }}</div>
                                <div>
                                    <div class="uc-name">{{ $pengaduan->user->nama ?? $pengaduan->user->username }}</div>
                                    <div class="uc-sub">{{ $pengaduan->user->username }}</div>
                                </div>
                            </div>

                            <p class="section-lbl">Isi Laporan</p>
                            <p class="content-text">{{ $pengaduan->isi_laporan }}</p>

                            @if($pengaduan->foto)
                                <div style="margin-top:1.25rem;">
                                    <p class="section-lbl">Foto Pendukung</p>
                                    <img src="{{ asset('storage/' . $pengaduan->foto) }}"
                                         class="foto-img" alt="Foto Pengaduan"
                                         onclick="document.getElementById('lb').classList.add('open')">
                                    <p class="foto-hint">Klik gambar untuk memperbesar</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- ═══ PESAN / THREAD ═══ --}}
                    <div class="card msg-section">
                        <div class="card-head">
                            <span class="card-head-title">
                                💬 Percakapan
                                @php $totalPesan = $pengaduan->pesan->count(); @endphp
                                @if($totalPesan > 0)
                                    <span style="font-size:12px;font-weight:500;color:var(--text-3);margin-left:6px;">({{ $totalPesan }} pesan)</span>
                                @endif
                            </span>
                        </div>

                        {{-- Thread --}}
                        <div class="msg-thread" id="msg-thread">
                            @if($pengaduan->pesan->isEmpty())
                                <div class="thread-empty">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <p>Belum ada pesan. Kirim pesan pertama ke siswa!</p>
                                </div>
                            @else
                                @foreach($pengaduan->pesan as $pesan)
                                    @if($pesan->isPetugas())
                                        {{-- Bubble petugas (kanan) --}}
                                        <div class="msg-bubble-wrap from-petugas">
                                            <div class="bubble-avatar ba-petugas">
                                                {{ strtoupper(substr($pesan->pengirim->nama ?? $pesan->pengirim->username, 0, 1)) }}
                                            </div>
                                            <div class="bubble-content">
                                                <div class="bubble-name">{{ $pesan->pengirim->nama ?? $pesan->pengirim->username }} (Petugas)</div>
                                                <div class="bubble bubble-petugas">{{ $pesan->isi }}</div>
                                                <div class="bubble-time">
                                                    {{ $pesan->created_at->format('d M Y, H:i') }}
                                                    @if($pesan->dibaca)
                                                        · <span style="color:#86EFAC;">✓ Sudah dibaca</span>
                                                    @else
                                                        · <span style="color:rgba(255,255,255,0.5);">Belum dibaca</span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- Delete button (hanya milik petugas yg login) --}}
                                            @if($pesan->pengirim_id === Auth::id())
                                                <div class="bubble-actions">
                                                    <form action="{{ route('petugas.pesan.destroy', [$pengaduan->id, $pesan->id]) }}" method="POST"
                                                          onsubmit="return confirm('Hapus pesan ini?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn-del-msg" title="Hapus pesan">
                                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        {{-- Bubble user (kiri) --}}
                                        <div class="msg-bubble-wrap from-user">
                                            <div class="bubble-avatar ba-user">
                                                {{ strtoupper(substr($pesan->pengirim->nama ?? $pesan->pengirim->username, 0, 1)) }}
                                            </div>
                                            <div class="bubble-content">
                                                <div class="bubble-name">{{ $pesan->pengirim->nama ?? $pesan->pengirim->username }} (Siswa)</div>
                                                <div class="bubble bubble-user">{{ $pesan->isi }}</div>
                                                <div class="bubble-time">{{ $pesan->created_at->format('d M Y, H:i') }}</div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>

                        {{-- Input kirim pesan --}}
                        <div class="msg-input-area">
                            <p class="msg-input-hint">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Pesan akan terlihat oleh siswa di halaman detail pengaduannya
                            </p>
                            <form action="{{ route('petugas.pesan.store', $pengaduan->id) }}" method="POST" class="msg-form" id="msg-form">
                                @csrf
                                <textarea
                                    name="isi"
                                    id="msg-input"
                                    class="msg-textarea"
                                    placeholder="Tulis pesan untuk siswa… (Enter untuk kirim, Shift+Enter untuk baris baru)"
                                    rows="1"
                                    required
                                ></textarea>
                                <button type="submit" class="btn-send" title="Kirim pesan">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- ═══ RIGHT: Sidebar aksi ═══ --}}
                <div>
                    {{-- Status Update --}}
                    <div class="card">
                        <div class="card-head"><span class="card-head-title">Update Status</span></div>
                        <div class="card-body">
                            <p style="font-size:12px;color:var(--text-3);margin-bottom:8px;">Status saat ini</p>
                            @if($pengaduan->status === 'pending')
                                <div class="status-current sc-pending">⏳ Pending</div>
                            @elseif($pengaduan->status === 'proses')
                                <div class="status-current sc-proses">🔄 Sedang Diproses</div>
                            @else
                                <div class="status-current sc-selesai">✅ Selesai</div>
                            @endif

                            <form action="{{ route('petugas.pengaduan.updateStatus', $pengaduan->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <p style="font-size:12px;color:var(--text-3);margin-bottom:8px;">Ubah status</p>
                                <select name="status" class="status-select" required>
                                    <option value="pending"  {{ $pengaduan->status==='pending'  ? 'selected':'' }}>⏳ Pending</option>
                                    <option value="proses"   {{ $pengaduan->status==='proses'   ? 'selected':'' }}>🔄 Sedang Diproses</option>
                                    <option value="selesai"  {{ $pengaduan->status==='selesai'  ? 'selected':'' }}>✅ Selesai</option>
                                </select>
                                <button type="submit" class="btn-full btn-brand">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    Simpan Status
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Quick Message Templates --}}
                    <div class="card">
                        <div class="card-head"><span class="card-head-title">Pesan Cepat</span></div>
                        <div class="card-body" style="display:flex;flex-direction:column;gap:8px;">
                            <p style="font-size:12px;color:var(--text-3);margin-bottom:4px;">Klik untuk mengisi kolom pesan</p>
                            @php
                                $templates = [
                                    ['icon'=>'🔄', 'label'=>'Sedang diproses',   'text'=>'Pengaduan Anda sedang kami proses. Mohon tunggu kabar selanjutnya.'],
                                    ['icon'=>'🔍', 'label'=>'Butuh investigasi', 'text'=>'Kami sedang melakukan investigasi lebih lanjut terkait pengaduan Anda. Kami akan segera memberikan update.'],
                                    ['icon'=>'✅', 'label'=>'Selesai ditangani', 'text'=>'Pengaduan Anda telah selesai kami tangani. Terima kasih telah menyampaikan aspirasimu!'],
                                    ['icon'=>'📋', 'label'=>'Butuh info tambahan','text'=>'Untuk menindaklanjuti pengaduan Anda, kami membutuhkan informasi tambahan. Mohon berikan detail lebih lanjut.'],
                                ];
                            @endphp
                            @foreach($templates as $t)
                                <button
                                    type="button"
                                    onclick="setTemplate({{ json_encode($t['text']) }})"
                                    style="
                                        padding:9px 12px;border-radius:9px;border:1.5px solid var(--border);
                                        background:var(--surface-2);text-align:left;cursor:pointer;
                                        font-family:'DM Sans',sans-serif;font-size:13px;color:var(--text-2);
                                        display:flex;align-items:center;gap:8px;transition:all .15s;
                                    "
                                    onmouseover="this.style.borderColor='#93C5FD';this.style.background='var(--brand-light)';this.style.color='var(--brand)'"
                                    onmouseout="this.style.borderColor='var(--border)';this.style.background='var(--surface-2)';this.style.color='var(--text-2)'"
                                >
                                    <span>{{ $t['icon'] }}</span>
                                    <span>{{ $t['label'] }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Aksi --}}
                    <div class="card">
                        <div class="card-head"><span class="card-head-title">Aksi</span></div>
                        <div class="card-body">
                            <a href="{{ route('petugas.pengaduan.index') }}" class="btn-full btn-ghost" style="text-decoration:none;">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                                Kembali ke Daftar
                            </a>
                            <form action="{{ route('petugas.pengaduan.destroy', $pengaduan->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus pengaduan ini secara permanen?')" style="margin:0;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-full btn-danger">
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

{{-- Lightbox --}}
@if($pengaduan->foto)
    <div class="lightbox" id="lb" onclick="this.classList.remove('open')">
        <button class="lb-close" onclick="document.getElementById('lb').classList.remove('open')">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="" onclick="event.stopPropagation()">
    </div>
@endif

<script>
    // Auto-scroll to bottom of thread
    const thread = document.getElementById('msg-thread');
    if (thread) thread.scrollTop = thread.scrollHeight;

    // Auto-resize textarea
    const ta = document.getElementById('msg-input');
    if (ta) {
        ta.addEventListener('input', () => {
            ta.style.height = 'auto';
            ta.style.height = Math.min(ta.scrollHeight, 140) + 'px';
        });
        // Enter to send, Shift+Enter for newline
        ta.addEventListener('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                if (ta.value.trim()) {
                    document.getElementById('msg-form').submit();
                }
            }
        });
    }

    // Set quick-reply template into textarea
    function setTemplate(text) {
        if (ta) {
            ta.value = text;
            ta.focus();
            ta.style.height = 'auto';
            ta.style.height = Math.min(ta.scrollHeight, 140) + 'px';
        }
    }

    // ESC to close lightbox
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            const lb = document.getElementById('lb');
            if (lb) lb.classList.remove('open');
        }
    });
</script>
</body>
</html>