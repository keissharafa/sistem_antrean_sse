<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Papan Antrian</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@500&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #0f1117;
            --ink-2: #292d38;
            --ink-3: #767b8a;
            --surface: #f7f7f5;
            --panel: #ffffff;
            --line: #e8e7e3;
            --lime: #c9f53b;
            --lime-soft: #efffba;
            --blue: #228be6;
            --red: #f03e3e;

            --font-body: 'DM Sans', sans-serif;
            --font-mono: 'DM Mono', monospace;

            --r-md: 18px;
            --r-lg: 28px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-body);
            background: var(--surface);
            color: var(--ink);
            min-height: 100vh;
            padding: 34px;
        }

        .board {
            min-height: calc(100vh - 68px);
            display: grid;
            grid-template-columns: 1.5fr 0.8fr;
            gap: 24px;
        }

        .main-panel {
            background: var(--ink);
            border-radius: var(--r-lg);
            padding: 42px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            position: relative;
        }

        .main-panel::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            background: rgba(201, 245, 59, 0.08);
            border-radius: 50%;
            right: -120px;
            bottom: -140px;
        }

        .top-label {
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.42);
            margin-bottom: 10px;
        }

        .title {
            font-size: 34px;
            font-weight: 700;
            letter-spacing: -0.8px;
        }

        .called-section {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 60px 0;
        }

        .called-label {
            color: rgba(255,255,255,0.45);
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .called-number {
            font-family: var(--font-mono);
            font-size: 180px;
            line-height: 0.95;
            color: var(--lime);
            letter-spacing: -8px;
        }

        .called-number.empty {
            color: rgba(255,255,255,0.12);
        }

        .called-name {
            margin-top: 22px;
            font-size: 42px;
            font-weight: 700;
            letter-spacing: -0.8px;
        }

        .called-name.empty {
            color: rgba(255,255,255,0.22);
        }

        .footer-info {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: rgba(255,255,255,0.42);
            font-size: 15px;
        }

        .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: rgba(201,245,59,0.1);
            border: 1px solid rgba(201,245,59,0.15);
            color: var(--lime);
            padding: 9px 14px;
            border-radius: 999px;
            font-weight: 700;
        }

        .dot {
            width: 8px;
            height: 8px;
            background: var(--lime);
            border-radius: 50%;
            box-shadow: 0 0 0 4px rgba(201,245,59,0.18);
            animation: pulse 1.6s ease infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.35;
            }
        }

        .side-panel {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: var(--r-lg);
            padding: 26px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 18px;
            color: var(--ink);
        }

        .queue-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .queue-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px;
            background: #fafafa;
            border: 1px solid var(--line);
            border-radius: var(--r-md);
        }

        .queue-number {
            font-family: var(--font-mono);
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: var(--lime-soft);
            display: grid;
            place-items: center;
            color: var(--ink);
            font-size: 18px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .queue-name {
            font-size: 16px;
            font-weight: 700;
        }

        .queue-status {
            font-size: 13px;
            color: var(--ink-3);
            margin-top: 3px;
        }

        .empty {
            padding: 28px 18px;
            text-align: center;
            color: var(--ink-3);
            border: 1px dashed var(--line);
            border-radius: var(--r-md);
            font-size: 15px;
        }

        .info-card {
            background: var(--lime);
            border: none;
        }

        .info-title {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .info-text {
            font-size: 14px;
            line-height: 1.55;
            color: rgba(15,17,23,0.72);
        }

        .sound-btn {
    border: 1px solid rgba(201,245,59,0.25);
    background: rgba(201,245,59,0.12);
    color: var(--lime);
    padding: 9px 14px;
    border-radius: 999px;
    font-family: var(--font-body);
    font-weight: 700;
    cursor: pointer;
}

.sound-btn.active {
    background: var(--lime);
    color: var(--ink);
}

        @media (max-width: 900px) {
            body {
                padding: 18px;
            }

            .board {
                grid-template-columns: 1fr;
            }

            .called-number {
                font-size: 120px;
            }

            .called-name {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="board">

        <section class="main-panel">
            <div class="top-label">
                <div class="eyebrow">Papan Antrian Digital</div>
                <div class="title">AntrianQ</div>
            </div>

            <div class="called-section">
                <div class="called-label">Nomor yang Dipanggil</div>

                <div id="calledNumber" class="called-number {{ $dipanggil ? '' : 'empty' }}">
    {{ $dipanggil ? str_pad($dipanggil->nomor, 3, '0', STR_PAD_LEFT) : '—' }}
</div>

<div id="calledName" class="called-name {{ $dipanggil ? '' : 'empty' }}">
    {{ $dipanggil ? $dipanggil->nama : 'Belum ada panggilan' }}
</div>
            </div>

            <div class="footer-info">
    <div>Silakan menunggu hingga nomor Anda dipanggil.</div>

    <div style="display: flex; gap: 10px; align-items: center;">
        <button id="enableSoundBtn" class="sound-btn" type="button">
            Aktifkan Suara
        </button>

        <div class="live-badge">
            <span class="dot"></span>
            LIVE
        </div>
    </div>
</div>
        </section>

        <aside class="side-panel">
            <div class="card">
                <div class="card-title">Antrian Berikutnya</div>

                <div id="waitingList" class="queue-list">
    @forelse ($menunggu as $item)
        <div class="queue-item">
            <div class="queue-number">
                {{ str_pad($item->nomor, 3, '0', STR_PAD_LEFT) }}
            </div>
            <div>
                <div class="queue-name">{{ $item->nama }}</div>
                <div class="queue-status">Menunggu dipanggil</div>
            </div>
        </div>
    @empty
        <div class="empty">
            Belum ada antrian berikutnya.
        </div>
    @endforelse
</div>
            </div>

            <div class="card info-card">
                <div class="info-title">Informasi</div>
                <div class="info-text">
                    Mohon tetap berada di area tunggu. Nomor antrian akan diperbarui secara real-time pada layar ini.
                </div>
            </div>
        </aside>

    </div>

    <script>
    let soundEnabled = false;
    let lastCalledId = null;
    let currentCalled = null;

    const enableSoundBtn = document.getElementById('enableSoundBtn');

    enableSoundBtn.addEventListener('click', function () {
    soundEnabled = true;
    enableSoundBtn.textContent = 'Suara Aktif';
    enableSoundBtn.classList.add('active');

    if (currentCalled) {
        callQueue(currentCalled);
    } else {
        speakText('Suara aktif. Belum ada nomor antrian yang dipanggil.');
    }
});

    const source = new EventSource("{{ route('sse.antrian') }}");

    source.addEventListener('queue-update', function(event) {
        const data = JSON.parse(event.data);

        currentCalled = data.dipanggil;

updateCalled(data.dipanggil);
updateWaitingList(data.menunggu);

        if (data.dipanggil && data.dipanggil.id !== lastCalledId) {
            lastCalledId = data.dipanggil.id;

            if (soundEnabled) {
                callQueue(data.dipanggil);
            }
        }
    });

    source.onerror = function(error) {
        console.error('SSE error di papan:', error);
    };

    function updateCalled(dipanggil) {
        const calledNumber = document.getElementById('calledNumber');
        const calledName = document.getElementById('calledName');

        if (dipanggil) {
            calledNumber.textContent = dipanggil.nomor_format;
            calledName.textContent = dipanggil.nama;

            calledNumber.classList.remove('empty');
            calledName.classList.remove('empty');
        } else {
            calledNumber.textContent = '—';
            calledName.textContent = 'Belum ada panggilan';

            calledNumber.classList.add('empty');
            calledName.classList.add('empty');
        }
    }

    function updateWaitingList(menunggu) {
        const waitingList = document.getElementById('waitingList');

        if (!menunggu || menunggu.length === 0) {
            waitingList.innerHTML = `
                <div class="empty">
                    Belum ada antrian berikutnya.
                </div>
            `;
            return;
        }

        waitingList.innerHTML = menunggu.slice(0, 5).map(item => `
            <div class="queue-item">
                <div class="queue-number">
                    ${escapeHtml(item.nomor_format)}
                </div>
                <div>
                    <div class="queue-name">${escapeHtml(item.nama)}</div>
                    <div class="queue-status">Menunggu dipanggil</div>
                </div>
            </div>
        `).join('');
    }

    function callQueue(dipanggil) {
        const pesan = `Nomor antrian ${dipanggil.nomor_format}. ${dipanggil.nama}. Silakan masuk.`;
        speakText(pesan);
    }

    function speakText(text) {
        if (!('speechSynthesis' in window)) {
            console.warn('Browser tidak mendukung Web Speech API');
            return;
        }

        window.speechSynthesis.cancel();

        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'id-ID';
        utterance.rate = 0.85;
        utterance.pitch = 1;
        utterance.volume = 1;

        window.speechSynthesis.speak(utterance);
    }

    function escapeHtml(text) {
        if (text === null || text === undefined) return '';

        return String(text)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }
</script>
</body>
</html>