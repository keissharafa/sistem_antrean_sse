<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nomor Antrian</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@500&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        :root {
            --bg:     #e8e8e6;
            --panel:  #ffffff;
            --ink:    #141417;
            --ink-2:  #3a3d4a;
            --ink-3:  #8a8a96;
            --line:   #e4e4e0;
            --lime:   #7ee040;
            --lime-dim: rgba(126,224,64,0.12);
            --r:      22px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
            -webkit-font-smoothing: antialiased;
        }

        /* ── ticket card ── */
        .ticket {
            background: var(--panel);
            width: 100%;
            max-width: 400px;
            border-radius: var(--r);
            box-shadow: 0 2px 4px rgba(0,0,0,0.04), 0 12px 40px rgba(0,0,0,0.08);
            overflow: hidden;
            text-align: center;
        }

        /* top half */
        .ticket-top {
            padding: 32px 32px 28px;
        }

        .org-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -0.2px;
            margin-bottom: 3px;
        }

        .org-sub {
            font-size: 12.5px;
            color: var(--lime);
            font-weight: 600;
        }

        .number-wrap {
            margin: 28px 0 6px;
        }

        .number {
            font-family: 'DM Mono', monospace;
            font-size: 80px;
            font-weight: 500;
            color: var(--ink);
            line-height: 1;
            letter-spacing: -3px;
        }

        .number sup {
            font-family: 'DM Sans', sans-serif;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0;
            color: var(--lime);
            vertical-align: super;
        }

        .queue-label {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--ink-3);
            margin-bottom: 20px;
        }

        .name {
            font-size: 17px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 12px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--lime-dim);
            color: #3a8a1a;
            border: 1px solid rgba(126,224,64,0.25);
            padding: 6px 14px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        /* tear line */
        .tear {
            display: flex;
            align-items: center;
            margin: 0 -1px;
            position: relative;
        }

        .tear-circle {
            width: 22px;
            height: 22px;
            background: var(--bg);
            border-radius: 50%;
            flex-shrink: 0;
        }

        .tear-line {
            flex: 1;
            border-top: 2px dashed var(--line);
        }

        /* bottom half */
        .ticket-bottom {
            padding: 22px 32px 28px;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            text-align: left;
            padding: 12px 0;
            border-bottom: 1px solid var(--line);
        }

        .info-row:last-of-type { border-bottom: none; }

        .info-icon {
            width: 34px;
            height: 34px;
            background: var(--lime-dim);
            border-radius: 9px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            color: #3a8a1a;
            margin-top: 1px;
        }

        .info-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--ink-3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
        }

        /* footer action */
        .ticket-footer {
            padding: 0 32px 28px;
        }

        a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            width: 100%;
            padding: 13px;
            background: var(--lime);
            color: var(--ink);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: opacity 0.15s, transform 0.1s;
        }

        a:hover { opacity: 0.85; transform: translateY(-1px); }
        a:active { transform: translateY(0); }
    </style>
</head>
<body>
    <div class="ticket">

        <div class="ticket-top">
            <div class="org-name">Dashboard Antrian</div>
            <div class="org-sub">Nomor antrian Anda</div>

            <div class="number-wrap">
                <div class="number">{{ $antrian->nomor }}<sup>th</sup></div>
            </div>
            <div class="queue-label">Posisi dalam antrian</div>

            <div class="name">{{ $antrian->nama }}</div>
            <div class="status">
                <i data-lucide="check-circle" size="12" stroke-width="2.5"></i>
                {{ strtoupper($antrian->status) }}
            </div>
        </div>

        <div class="tear">
            <div class="tear-circle"></div>
            <div class="tear-line"></div>
            <div class="tear-circle"></div>
        </div>

        <div class="ticket-bottom">
            <div class="info-row">
                <div class="info-icon">
                    <i data-lucide="map-pin" size="15" stroke-width="2"></i>
                </div>
                <div>
                    <div class="info-label">Lokasi</div>
                    <div class="info-value">Loket Utama</div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-icon">
                    <i data-lucide="clock" size="15" stroke-width="2"></i>
                </div>
                <div>
                    <div class="info-label">Jam Operasional</div>
                    <div class="info-value">08.00 — 16.00</div>
                </div>
            </div>
        </div>

        <div class="ticket-footer">
            <a href="{{ route('guest') }}">
                <i data-lucide="plus" size="15" stroke-width="2.5"></i>
                Ambil Nomor Lain
            </a>
        </div>

    </div>
    <script>lucide.createIcons();</script>
</body>
</html>