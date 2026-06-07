<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Antrian</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        :root {
            --bg:      #e8e8e6;
            --panel:   #ffffff;
            --ink:     #141417;
            --ink-2:   #3a3d4a;
            --ink-3:   #8a8a96;
            --line:    #e4e4e0;
            --lime:    #7ee040;
            --lime-bg: #f0fce8;
            --red:     #e53935;
            --red-bg:  #fff5f5;
            --r:       22px;
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

        .card {
            background: var(--panel);
            width: 100%;
            max-width: 440px;
            border-radius: var(--r);
            padding: 36px 32px 32px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04), 0 12px 40px rgba(0,0,0,0.08);
        }

        /* ── heading ── */
        h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -0.4px;
            line-height: 1.25;
            margin-bottom: 8px;
        }

        p {
            font-size: 13.5px;
            color: var(--ink-3);
            line-height: 1.6;
            margin-bottom: 28px;
        }

        /* ── field ── */
        .field-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--ink-2);
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 13px 16px;
            border: 1.5px solid var(--line);
            border-radius: 12px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            background: #fff;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            margin-bottom: 20px;
        }

        input::placeholder { color: var(--ink-3); }

        input:focus {
            border-color: var(--lime);
            box-shadow: 0 0 0 3px rgba(126,224,64,0.15);
        }

        /* ── error ── */
        .error {
            display: flex;
            align-items: center;
            gap: 7px;
            background: var(--red-bg);
            border: 1px solid rgba(229,57,53,0.2);
            color: var(--red);
            font-size: 13px;
            font-weight: 500;
            padding: 10px 13px;
            border-radius: 10px;
            margin-bottom: 16px;
        }

        /* ── actions ── */
        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 4px;
        }

        button {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 11px 22px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: opacity 0.15s, transform 0.1s;
        }

        button[type="submit"] {
            background: var(--lime);
            color: var(--ink);
        }

        button[type="submit"]:hover { opacity: 0.85; transform: translateY(-1px); }
        button[type="submit"]:active { transform: translateY(0); }
    </style>
</head>
<body>
    <div class="card">

        <h1>Daftar Antrian</h1>
        <p>Masukkan nama untuk mendapatkan nomor antrian.</p>

        @if ($errors->any())
            <div class="error">
                <i data-lucide="alert-circle" size="14" stroke-width="2.5"></i>
                {{ $errors->first('nama') }}
            </div>
        @endif

        <form action="{{ route('guest.daftar') }}" method="POST">
            @csrf
            <label class="field-label" for="nama">Nama lengkap</label>
            <input
                type="text"
                id="nama"
                name="nama"
                placeholder="cth. Budi Santoso"
                required
                autocomplete="off"
            >
            <div class="actions">
                <button type="submit">
                    Ambil Nomor
                    <i data-lucide="arrow-right" size="15" stroke-width="2.5"></i>
                </button>
            </div>
        </form>

    </div>
    <script>lucide.createIcons();</script>
</body>
</html>