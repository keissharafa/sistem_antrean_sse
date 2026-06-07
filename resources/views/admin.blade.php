<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Antrian</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Mono:wght@500&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        :root {
            --ink:      #0f1117;
            --ink-2:    #3a3d4a;
            --ink-3:    #767b8a;
            --surface:  #f7f7f5;
            --panel:    #ffffff;
            --line:     #e8e7e3;
            --line-2:   #f0efeb;
            --lime:     #c9f53b;
            --lime-dim: #e8fba0;
            --red:      #f03e3e;
            --amber:    #f59f00;
            --blue:     #228be6;

            --r-sm: 10px;
            --r-md: 14px;
            --r-lg: 20px;

            --font-body: 'DM Sans', sans-serif;
            --font-mono: 'DM Mono', monospace;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-body);
            background: var(--surface);
            color: var(--ink);
            display: flex;
            min-height: 100vh;
            font-size: 14px;
            -webkit-font-smoothing: antialiased;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: 232px;
            flex-shrink: 0;
            background: var(--ink);
            display: flex;
            flex-direction: column;
            padding: 20px 12px;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 6px 10px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            margin-bottom: 8px;
        }

        .brand-mark {
            width: 30px;
            height: 30px;
            background: var(--lime);
            border-radius: 8px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .brand-mark i { color: var(--ink); }

        .brand-name {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            letter-spacing: -0.2px;
        }

        .nav-group-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.25);
            padding: 16px 10px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 10px;
            border-radius: var(--r-sm);
            color: rgba(255,255,255,0.45);
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
            text-decoration: none;
        }

        .nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.75); }

        .nav-item.active {
            background: var(--lime);
            color: var(--ink);
        }

        .nav-item i { flex-shrink: 0; }

        .sidebar-footer {
            margin-top: auto;
            padding: 12px 10px;
            border-top: 1px solid rgba(255,255,255,0.07);
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            background: var(--lime);
            border-radius: 50%;
            flex-shrink: 0;
            box-shadow: 0 0 0 2px rgba(201,245,59,0.25);
            animation: blink 2s ease infinite;
        }

        @keyframes blink {
            0%,100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        .status-text {
            font-size: 12px;
            color: rgba(255,255,255,0.35);
        }

        /* ─── MAIN ─── */
        .main {
            flex: 1;
            padding: 32px 36px;
            min-width: 0;
        }

        /* ─── TOPBAR ─── */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
        }

        .topbar-left h1 {
            font-size: 22px;
            font-weight: 600;
            letter-spacing: -0.4px;
            color: var(--ink);
            line-height: 1.25;
        }

        .topbar-left p {
            margin-top: 4px;
            color: var(--ink-3);
            font-size: 13px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--lime);
            color: var(--ink);
            border: none;
            padding: 10px 18px;
            border-radius: var(--r-sm);
            font-weight: 600;
            font-size: 13.5px;
            font-family: var(--font-body);
            cursor: pointer;
            transition: opacity 0.15s, transform 0.1s;
            white-space: nowrap;
        }

        .btn-primary:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-primary:active { transform: translateY(0); }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: var(--amber);
            border: 1px solid rgba(245,159,0,0.3);
            padding: 7px 12px;
            border-radius: var(--r-sm);
            font-size: 12.5px;
            font-weight: 500;
            font-family: var(--font-body);
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-danger:hover { background: rgba(245,159,0,0.08); }

        .btn-warning {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--lime);
            color: var(--ink);
            border: none;
            padding: 7px 14px;
            border-radius: var(--r-sm);
            font-size: 12.5px;
            font-weight: 600;
            font-family: var(--font-body);
            cursor: pointer;
            transition: opacity 0.15s;
        }

        .btn-warning:hover { opacity: 0.82; }

        /* ─── CURRENT BANNER ─── */
        .current {
            background: var(--ink);
            border-radius: var(--r-lg);
            padding: 24px 28px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 0;
        }

        .current-block {
            display: flex;
            flex-direction: column;
        }

        .current-eyebrow {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            margin-bottom: 6px;
        }

        .current-number {
            font-family: var(--font-mono);
            font-size: 56px;
            font-weight: 500;
            color: var(--lime);
            line-height: 1;
            letter-spacing: -1px;
        }

        .current-number.empty { color: rgba(255,255,255,0.15); }

        .current-sep {
            width: 1px;
            height: 60px;
            background: rgba(255,255,255,0.1);
            margin: 0 28px;
            flex-shrink: 0;
        }

        .current-name {
            font-size: 20px;
            font-weight: 600;
            color: #fff;
            letter-spacing: -0.3px;
            margin-bottom: 8px;
        }

        .current-name.empty { color: rgba(255,255,255,0.2); }

        .current-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(201,245,59,0.1);
            border: 1px solid rgba(201,245,59,0.15);
            color: var(--lime);
            font-size: 11.5px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            width: fit-content;
        }

        /* ─── GRID ─── */
        .grid {
            display: grid;
            grid-template-columns: 1.35fr 1fr;
            gap: 20px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: var(--r-lg);
            padding: 20px 20px 16px;
        }

        .card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .card-title {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--ink);
        }

        .chip {
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 500;
            color: var(--ink-3);
            background: var(--line-2);
            border: 1px solid var(--line);
            padding: 3px 9px;
            border-radius: 20px;
        }

        /* ─── QUEUE ITEM ─── */
        .queue-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 11px 13px;
            border-radius: var(--r-md);
            border: 1px solid var(--line);
            margin-bottom: 8px;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .queue-item:last-child { margin-bottom: 0; }

        .queue-item:hover {
            border-color: #d4d3cf;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .queue-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .badge-number {
            font-family: var(--font-mono);
            font-size: 13px;
            font-weight: 500;
            width: 38px;
            height: 38px;
            background: var(--surface);
            border: 1px solid var(--line);
            color: var(--ink);
            border-radius: var(--r-sm);
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .badge-number.late {
            background: rgba(240,62,62,0.06);
            border-color: rgba(240,62,62,0.2);
            color: var(--red);
        }

        .q-name {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.3;
        }

        .q-status {
            font-size: 11.5px;
            color: var(--ink-3);
            margin-top: 2px;
        }

        .actions {
            display: flex;
            gap: 6px;
        }

        .actions form {
    display: inline-flex;
}

        /* ─── EMPTY ─── */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            padding: 28px 16px;
            color: var(--ink-3);
            font-size: 13px;
        }

        .empty-state i { color: var(--line); }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 860px) {
            .sidebar { display: none; }
            .main { padding: 20px 16px; }
            .grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 520px) {
            .topbar { flex-direction: column; gap: 14px; }
            .current { flex-wrap: wrap; }
        }

        .alert {
    padding: 12px 16px;
    border-radius: var(--r-sm);
    margin-bottom: 18px;
    font-weight: 600;
    font-size: 13px;
}

.alert.success {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.alert.error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-mark">
                <i data-lucide="ticket" size="15" stroke-width="2.5"></i>
            </div>
            <span class="brand-name">AntrianQ</span>
        </div>

        <span class="nav-group-label">Menu</span>

        <a class="nav-item active" href="#">
            <i data-lucide="layout-dashboard" size="15" stroke-width="2"></i>
            Dashboard
        </a>
        <a class="nav-item" href="#">
            <i data-lucide="users" size="15" stroke-width="2"></i>
            Antrian
        </a>
        <a class="nav-item" href="#">
            <i data-lucide="bar-chart-2" size="15" stroke-width="2"></i>
            Statistik
        </a>
        <a class="nav-item" href="#">
            <i data-lucide="settings" size="15" stroke-width="2"></i>
            Pengaturan
        </a>

        <div class="sidebar-footer">
            <div class="status-dot"></div>
            <span class="status-text">Sistem aktif</span>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">

    @if (session('success'))
    <div class="alert success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert error">
        {{ session('error') }}
    </div>
@endif

        <!-- TOPBAR -->
        <div class="topbar">
            <div class="topbar-left">
                <h1>Dashboard Antrian</h1>
                <p>Kelola pemanggilan nomor antrian secara real-time.</p>
            </div>
            <form action="{{ route('admin.panggilBerikutnya') }}" method="POST">
    @csrf
    <button type="submit" class="btn-primary">
        <i data-lucide="chevron-right" size="15" stroke-width="2.5"></i>
        Panggil Berikutnya
    </button>
</form>
        </div>

        <!-- CURRENT BANNER -->
        <div class="current">
            <div class="current-block">
                <span class="current-eyebrow">Dipanggil sekarang</span>
                @if ($dipanggil)
                    <span class="current-number">{{ $dipanggil->nomor }}</span>
                @else
                    <span class="current-number empty">—</span>
                @endif
            </div>

            <div class="current-sep"></div>

            <div class="current-block">
                @if ($dipanggil)
                    <div class="current-name">{{ $dipanggil->nama }}</div>
                    <div class="current-pill">
                        <i data-lucide="radio" size="11" stroke-width="2.5"></i>
                        Sedang dilayani
                    </div>
                @else
                    <div class="current-name empty">Belum ada yang dipanggil</div>
                @endif
            </div>
        </div>

        <!-- QUEUE GRID -->
        <div class="grid">

            <!-- Menunggu -->
            <div class="card">
                <div class="card-head">
                    <span class="card-title">Antrian Menunggu</span>
                    <span class="chip">{{ $menunggu->count() }}</span>
                </div>

                @forelse ($menunggu as $item)
                    <div class="queue-item">
                        <div class="queue-left">
                            <div class="badge-number">{{ $item->nomor }}</div>
                            <div>
                                <div class="q-name">{{ $item->nama }}</div>
                                <div class="q-status">{{ $item->status }}</div>
                            </div>
                        </div>
                        <div class="actions">
                            <form action="{{ route('admin.terlambat', $item->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn-danger">
        <i data-lucide="clock" size="12" stroke-width="2"></i>
        Terlambat
    </button>
</form>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i data-lucide="inbox" size="28" stroke-width="1.5"></i>
                        Belum ada antrian menunggu.
                    </div>
                @endforelse
            </div>

            <!-- Terlambat -->
            <div class="card">
                <div class="card-head">
                    <span class="card-title">Terlambat</span>
                    <span class="chip">{{ $terlambat->count() }}</span>
                </div>

                @forelse ($terlambat as $item)
                    <div class="queue-item">
                        <div class="queue-left">
                            <div class="badge-number late">{{ $item->nomor }}</div>
                            <div>
                                <div class="q-name">{{ $item->nama }}</div>
                                <div class="q-status">{{ $item->status }}</div>
                            </div>
                        </div>
                        <div class="actions">
                            <form action="{{ route('admin.panggilTerlambat', $item->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn-warning">
        <i data-lucide="phone-call" size="12" stroke-width="2.5"></i>
        Panggil
    </button>
</form>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i data-lucide="check-circle" size="28" stroke-width="1.5"></i>
                        Tidak ada yang terlambat.
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>