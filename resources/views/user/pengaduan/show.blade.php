<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan — Suara Siswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root {
            --brand:#1A56DB; --brand-dark:#1341AB; --brand-light:#EBF2FF;
            --surface:#FFFFFF; --surface-2:#F8FAFF; --border:#E2E8F0;
            --text-1:#0F172A; --text-2:#475569; --text-3:#94A3B8;
            --radius:16px; --radius-sm:10px;
        }
        *{box-sizing:border-box;margin:0;padding:0;}
        body{font-family:'DM Sans',sans-serif;background:#F4F7FF;color:var(--text-1);min-height:100vh;}

        /* ── Nav ── */
        nav{position:sticky;top:0;z-index:100;background:#fff;border-bottom:1px solid var(--border);}
        .nav-inner{max-width:1100px;margin:0 auto;padding:0 1.5rem;height:62px;display:flex;align-items:center;justify-content:space-between;}
        .brand{display:flex;align-items:center;gap:10px;text-decoration:none;}
        .brand-icon{width:36px;height:36px;background:var(--brand);border-radius:10px;display:grid;place-items:center;}
        .brand-name{font-family:'Sora',sans-serif;font-size:16px;font-weight:600;color:var(--text-1);}
        .nav-links{display:flex;align-items:center;gap:4px;}
        .nav-link{padding:7px 14px;border-radius:8px;font-size:14px;font-weight:500;text-decoration:none;color:var(--text-2);transition:all .15s;}
        .nav-link:hover,.nav-link.active{background:var(--brand-light);color:var(--brand);}
        .btn-nav{padding:8px 16px;border-radius:8px;font-size:14px;font-weight:500;background:var(--brand);color:#fff;text-decoration:none;display:flex;align-items:center;gap:6px;transition:background .15s;margin-left:8px;border:none;font-family:'DM Sans',sans-serif;cursor:pointer;}
        .btn-nav:hover{background:var(--brand-dark);}
        .user-area{display:flex;align-items:center;gap:12px;}
        .avatar{width:34px;height:34px;border-radius:50%;background:var(--brand-light);display:grid;place-items:center;font-family:'Sora',sans-serif;font-size:13px;font-weight:600;color:var(--brand);}
        .btn-logout{padding:7px 14px;border-radius:8px;border:1.5px solid var(--border);background:#fff;font-family:'DM Sans',sans-serif;font-size:13.5px;font-weight:500;color:#64748B;cursor:pointer;display:flex;align-items:center;gap:6px;}

        /* ── Main ── */
        main{max-width:800px;margin:0 auto;padding:2.5rem 1.5rem 4rem;}

        /* ── Breadcrumb ── */
        .breadcrumb{display:flex;align-items:center;gap:8px;font-size:13.5px;color:var(--text-3);margin-bottom:1.5rem;}
        .breadcrumb a{color:var(--brand);text-decoration:none;}
        .breadcrumb svg{width:14px;height:14px;}

        /* ── Alert ── */
        .alert{border-radius:10px;padding:12px 16px;font-size:14px;margin-bottom:1.5rem;display:flex;align-items:center;gap:10px;}
        .alert svg{width:16px;height:16px;flex-shrink:0;}
        .alert-success{background:#F0FDF4;border:1px solid #BBF7D0;color:#15803D;}
        .alert-error{background:#FEF2F2;border:1px solid #FECACA;color:#B91C1C;}

        /* ── Cards ── */
        .card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;margin-bottom:1.25rem;}
        .card:last-child{margin-bottom:0;}
        .card-head{padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
        .card-head-title{font-family:'Sora',sans-serif;font-size:15px;font-weight:600;color:var(--text-1);display:flex;align-items:center;gap:10px;}
        .card-body{padding:1.5rem;}

        /* ── Pengaduan detail ── */
        .pd-title{font-family:'Sora',sans-serif;font-size:20px;font-weight:700;color:var(--text-1);letter-spacing:-.3px;margin-bottom:.75rem;}
        .pd-meta{display:flex;flex-wrap:wrap;gap:14px;margin-bottom:1.25rem;}
        .meta-item{display:flex;align-items:center;gap:5px;font-size:13px;color:var(--text-3);}
        .meta-item svg{width:13px;height:13px;}
        .section-lbl{font-size:11.5px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:var(--text-3);margin-bottom:10px;}
        .content-text{font-size:15px;color:var(--text-2);line-height:1.75;white-space:pre-line;}
        .foto-img{width:100%;border-radius:var(--radius-sm);cursor:pointer;max-height:360px;object-fit:contain;transition:opacity .15s;}
        .foto-img:hover{opacity:.9;}
        .foto-hint{font-size:12px;color:var(--text-3);margin-top:6px;}

        /* ── Status badge ── */
        .status-pill{padding:5px 13px;border-radius:20px;font-size:13px;font-weight:600;flex-shrink:0;}
        .pill-pending{background:#FFFBEB;color:#B45309;border:1px solid #FDE68A;}
        .pill-proses{background:#EFF6FF;color:#1D4ED8;border:1px solid #BFDBFE;}
        .pill-selesai{background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;}

        /* ── Progress track ── */
        .progress-track{padding:1.25rem 1.5rem;border-top:1px solid var(--border);display:flex;align-items:center;}
        .prog-step{display:flex;flex-direction:column;align-items:center;gap:6px;flex:1;}
        .prog-circle{width:32px;height:32px;border-radius:50%;display:grid;place-items:center;border:2px solid var(--border);background:#fff;}
        .prog-circle.done{background:var(--brand);border-color:var(--brand);}
        .prog-circle.active{background:var(--brand-light);border-color:var(--brand);}
        .prog-circle svg{width:14px;height:14px;}
        .prog-lbl{font-size:12px;font-weight:500;color:var(--text-3);text-align:center;}
        .prog-lbl.done{color:var(--brand);}
        .prog-line{flex:1;height:2px;background:var(--border);margin-bottom:18px;}
        .prog-line.done{background:var(--brand);}

        /* ── Unread badge ── */
        .unread-badge{display:inline-flex;align-items:center;justify-content:center;min-width:20px;height:20px;padding:0 6px;border-radius:10px;background:#EF4444;color:#fff;font-size:11px;font-weight:700;animation:pulse-badge .8s ease-in-out infinite alternate;}
        @keyframes pulse-badge{from{opacity:1;}to{opacity:.7;}}

        /* ── Petugas notice banner ── */
        .petugas-notice{background:var(--brand-light);border:1px solid #BFDBFE;border-radius:10px;padding:12px 16px;margin-bottom:.875rem;font-size:13.5px;color:#1E40AF;display:flex;align-items:center;gap:10px;}
        .petugas-notice svg{width:16px;height:16px;flex-shrink:0;}

        /* ── Message thread ── */
        .msg-thread{padding:1.25rem 1.5rem;display:flex;flex-direction:column;gap:16px;min-height:100px;max-height:440px;overflow-y:auto;scroll-behavior:smooth;}
        .msg-thread::-webkit-scrollbar{width:4px;}
        .msg-thread::-webkit-scrollbar-track{background:transparent;}
        .msg-thread::-webkit-scrollbar-thumb{background:var(--border);border-radius:4px;}

        /* Empty */
        .thread-empty{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;padding:2rem 1rem;text-align:center;}
        .thread-empty svg{width:36px;height:36px;color:var(--text-3);opacity:.5;}
        .thread-empty p{font-size:13.5px;color:var(--text-3);}

        /* Bubbles */
        .msg-bubble-wrap{display:flex;gap:10px;align-items:flex-end;}
        .msg-bubble-wrap.from-user{flex-direction:row-reverse;}

        .bubble-avatar{width:30px;height:30px;border-radius:50%;display:grid;place-items:center;font-family:'Sora',sans-serif;font-size:11px;font-weight:700;flex-shrink:0;margin-bottom:4px;}
        .ba-petugas{background:#1A56DB;color:#fff;}
        .ba-user{background:#E2E8F0;color:#475569;}

        .bubble-content{max-width:75%;}
        .bubble-name{font-size:11.5px;font-weight:600;color:var(--text-3);margin-bottom:4px;}
        .msg-bubble-wrap.from-user .bubble-name{text-align:right;}

        .bubble{padding:10px 14px;border-radius:16px;font-size:14px;line-height:1.6;word-break:break-word;}
        /* Petugas: biru */
        .bubble-petugas{background:var(--brand);color:#fff;border-bottom-left-radius:4px;}
        /* User: abu kanan */
        .bubble-user{background:#EEF2FF;color:var(--text-1);border-bottom-right-radius:4px;}

        /* New badge on unread petugas message */
        .bubble-new{position:relative;}
        .bubble-new::after{
            content:'Baru';position:absolute;top:-8px;right:-4px;
            background:#EF4444;color:#fff;font-size:10px;font-weight:700;
            padding:1px 7px;border-radius:10px;white-space:nowrap;
        }

        .bubble-time{font-size:11px;margin-top:4px;color:var(--text-3);}
        .msg-bubble-wrap.from-user .bubble-time{text-align:right;}

        /* Input area */
        .msg-input-area{padding:1rem 1.5rem;border-top:1px solid var(--border);background:var(--surface-2);}
        .msg-form{display:flex;gap:10px;align-items:flex-end;}
        .msg-textarea{flex:1;padding:10px 14px;border:1.5px solid var(--border);border-radius:12px;font-family:'DM Sans',sans-serif;font-size:14px;color:var(--text-1);background:#fff;resize:none;outline:none;min-height:44px;max-height:140px;transition:border-color .15s,box-shadow .15s;line-height:1.5;}
        .msg-textarea:focus{border-color:var(--brand);box-shadow:0 0 0 3px rgba(26,86,219,.08);}
        .msg-textarea::placeholder{color:var(--text-3);}
        .btn-send{width:44px;height:44px;border-radius:12px;background:var(--brand);border:none;cursor:pointer;display:grid;place-items:center;color:#fff;flex-shrink:0;transition:background .15s,transform .1s;}
        .btn-send:hover{background:var(--brand-dark);}
        .btn-send:active{transform:scale(.95);}
        .btn-send svg{width:18px;height:18px;}
        .send-hint{font-size:12px;color:var(--text-3);margin-bottom:8px;}

        /* ── Action buttons ── */
        .action-bar{display:flex;gap:12px;flex-wrap:wrap;margin-top:1.25rem;}
        .btn-back{padding:11px 20px;border-radius:var(--radius-sm);background:var(--surface-2);color:var(--text-2);border:1.5px solid var(--border);font-family:'DM Sans',sans-serif;font-size:14px;font-weight:500;text-decoration:none;display:flex;align-items:center;gap:7px;transition:all .15s;}
        .btn-back:hover{background:#EEF2FF;}
        .btn-delete{padding:11px 20px;border-radius:var(--radius-sm);background:#FEF2F2;color:#DC2626;border:1.5px solid #FECACA;font-family:'DM Sans',sans-serif;font-size:14px;font-weight:500;cursor:pointer;display:flex;align-items:center;gap:7px;transition:all .15s;}
        .btn-delete:hover{background:#FEE2E2;}

        /* ── Lightbox ── */
        .lightbox{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:999;align-items:center;justify-content:center;padding:2rem;}
        .lightbox.open{display:flex;}
        .lb-close{position:absolute;top:1.5rem;right:1.5rem;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,.12);border:none;cursor:pointer;display:grid;place-items:center;color:#fff;}
        .lightbox img{max-width:100%;max-height:85vh;border-radius:12px;object-fit:contain;}

        @media(max-width:768px){.nav-links{display:none;}main{padding:2rem 1rem;}.msg-thread{max-height:320px;}}
    </style>
</head>
<body>

{{-- ── Navbar ── --}}
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
            <span style="font-size:14px;font-weight:500;">{{ Auth::user()->nama ?? Auth::user()->username }}</span>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</nav>

<main>
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('user.dashboard') }}">Dashboard</a>
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('user.pengaduan.index') }}">Pengaduan Saya</a>
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span>Detail</span>
    </div>

    {{-- Flash messages --}}
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

    {{-- ── Header Card ── --}}
    <div class="card">
        <div class="card-head">
            <h1 class="pd-title" style="margin:0;font-size:18px;">{{ $pengaduan->judul }}</h1>
            @if($pengaduan->status === 'pending')
                <span class="status-pill pill-pending">⏳ Pending</span>
            @elseif($pengaduan->status === 'proses')
                <span class="status-pill pill-proses">🔄 Diproses</span>
            @else
                <span class="status-pill pill-selesai">✅ Selesai</span>
            @endif
        </div>
        {{-- Progress track --}}
        <div class="progress-track">
            <div class="prog-step">
                <div class="prog-circle done">
                    <svg fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="prog-lbl done">Terkirim</span>
            </div>
            <div class="prog-line {{ $pengaduan->status !== 'pending' ? 'done' : '' }}"></div>
            <div class="prog-step">
                <div class="prog-circle {{ $pengaduan->status==='proses' ? 'active' : ($pengaduan->status==='selesai' ? 'done':'') }}">
                    @if($pengaduan->status==='selesai')
                        <svg fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    @elseif($pengaduan->status==='proses')
                        <svg fill="none" viewBox="0 0 24 24" stroke="#1A56DB" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9"/></svg>
                    @else
                        <svg fill="none" viewBox="0 0 24 24" stroke="#CBD5E1" stroke-width="2"><circle cx="12" cy="12" r="3"/></svg>
                    @endif
                </div>
                <span class="prog-lbl {{ in_array($pengaduan->status,['proses','selesai']) ? 'done':'' }}">Diproses</span>
            </div>
            <div class="prog-line {{ $pengaduan->status==='selesai' ? 'done':'' }}"></div>
            <div class="prog-step">
                <div class="prog-circle {{ $pengaduan->status==='selesai' ? 'done':'' }}">
                    @if($pengaduan->status==='selesai')
                        <svg fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    @else
                        <svg fill="none" viewBox="0 0 24 24" stroke="#CBD5E1" stroke-width="2"><circle cx="12" cy="12" r="3"/></svg>
                    @endif
                </div>
                <span class="prog-lbl {{ $pengaduan->status==='selesai' ? 'done':'' }}">Selesai</span>
            </div>
        </div>
    </div>

    {{-- ── Isi Laporan Card ── --}}
    <div class="card">
        <div class="card-head"><span class="card-head-title">Isi Laporan</span></div>
        <div class="card-body">
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

    {{-- ── PERCAKAPAN / PESAN ── --}}
    @php
        $pesanList   = $pengaduan->pesan;
        $unreadCount = $pengaduan->pesanBelumDibaca();
    @endphp

    <div class="card">
        <div class="card-head">
            <span class="card-head-title">
                💬 Pesan dari Petugas
                @if($unreadCount > 0)
                    <span class="unread-badge">{{ $unreadCount }} baru</span>
                @elseif($pesanList->count() > 0)
                    <span style="font-size:12px;font-weight:500;color:var(--text-3);">({{ $pesanList->count() }} pesan)</span>
                @endif
            </span>
        </div>

        {{-- Thread --}}
        <div class="msg-thread" id="msg-thread">
            @if($pesanList->isEmpty())
                <div class="thread-empty">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p>Belum ada pesan dari petugas.</p>
                    <p style="font-size:12px;">Petugas akan mengirim update status di sini.</p>
                </div>
            @else
                @foreach($pesanList as $pesan)
                    @if($pesan->isPetugas())
                        {{-- Petugas bubble (kiri) --}}
                        <div class="msg-bubble-wrap">
                            <div class="bubble-avatar ba-petugas">
                                {{ strtoupper(substr($pesan->pengirim->nama ?? $pesan->pengirim->username, 0, 1)) }}
                            </div>
                            <div class="bubble-content">
                                <div class="bubble-name">{{ $pesan->pengirim->nama ?? $pesan->pengirim->username }} · Petugas</div>
                                <div class="bubble bubble-petugas {{ !$pesan->dibaca ? 'bubble-new' : '' }}">{{ $pesan->isi }}</div>
                                <div class="bubble-time">{{ $pesan->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                    @else
                        {{-- User bubble (kanan) --}}
                        <div class="msg-bubble-wrap from-user">
                            <div class="bubble-avatar ba-user">
                                {{ strtoupper(substr($pesan->pengirim->nama ?? $pesan->pengirim->username, 0, 1)) }}
                            </div>
                            <div class="bubble-content">
                                <div class="bubble-name">Kamu</div>
                                <div class="bubble bubble-user">{{ $pesan->isi }}</div>
                                <div class="bubble-time">{{ $pesan->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        {{-- Input balas --}}
        <div class="msg-input-area">
            <p class="send-hint">Kirim balasan atau pertanyaan kepada petugas terkait pengaduan ini</p>
            <form action="{{ route('user.pesan.store', $pengaduan->id) }}" method="POST" class="msg-form" id="msg-form">
                @csrf
                <textarea
                    name="isi"
                    id="msg-input"
                    class="msg-textarea"
                    placeholder="Tulis balasan… (Enter untuk kirim)"
                    rows="1"
                    required
                ></textarea>
                <button type="submit" class="btn-send" title="Kirim">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </button>
            </form>
        </div>
    </div>

    {{-- ── Actions ── --}}
    <div class="action-bar">
        <a href="{{ route('user.pengaduan.index') }}" class="btn-back">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        @if($pengaduan->status === 'pending')
            <form action="{{ route('user.pengaduan.destroy', $pengaduan->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')" style="margin:0;">
                @csrf @method('DELETE')
                <button type="submit" class="btn-delete">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Hapus Pengaduan
                </button>
            </form>
        @endif
    </div>
</main>

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
    // Scroll thread to bottom
    const thread = document.getElementById('msg-thread');
    if (thread) thread.scrollTop = thread.scrollHeight;

    // Auto-resize textarea
    const ta = document.getElementById('msg-input');
    if (ta) {
        ta.addEventListener('input', () => {
            ta.style.height = 'auto';
            ta.style.height = Math.min(ta.scrollHeight, 140) + 'px';
        });
        ta.addEventListener('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                if (ta.value.trim()) {
                    document.getElementById('msg-form').submit();
                }
            }
        });
    }

    // Mark petugas messages as read via fetch
    fetch('{{ route("user.pesan.markRead", $pengaduan->id) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    }).catch(() => {});

    // ESC lightbox
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            const lb = document.getElementById('lb');
            if (lb) lb.classList.remove('open');
        }
    });
</script>
</body>
</html>