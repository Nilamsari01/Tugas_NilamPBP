<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Masuk') — Gudang.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --navy-deep: #0F1B2D;
            --navy-mid: #16243B;
            --burnt: #E8633B;
            --burnt-dark: #C94E2A;
            --canvas: #F7F5F1;
            --ink: #1A2230;
            --ink-soft: #5B6B82;
            --border: #E4E1D8;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            background-color: var(--navy-deep);
        }
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        .brand-panel {
            background: var(--navy-deep);
            background-image:
                repeating-linear-gradient(90deg, transparent 0px, transparent 39px, rgba(255,255,255,0.03) 40px),
                radial-gradient(circle at 75% 20%, rgba(232,99,59,0.18), transparent 45%);
            color: #fff;
            flex: 1.1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            position: relative;
        }
        .brand-panel .crate-icon {
            width: 52px; height: 52px;
            background: var(--burnt);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; margin-bottom: 28px;
        }
        .brand-panel h1 {
            font-size: 2.1rem; font-weight: 700; line-height: 1.2; max-width: 420px;
        }
        .brand-panel p {
            color: #9FB0C9; max-width: 380px; margin-top: 14px; font-size: 0.95rem;
        }
        .crate-stat {
            display: flex; gap: 28px; margin-top: 44px;
        }
        .crate-stat div .num {
            font-family: 'Space Grotesk', sans-serif; font-size: 1.4rem; font-weight: 700; color: var(--burnt);
        }
        .crate-stat div .lbl {
            font-size: 0.7rem; color: #7E93B0; text-transform: uppercase; letter-spacing: 0.08em; font-family: 'JetBrains Mono', monospace;
        }

        .form-panel {
            flex: 1;
            background: var(--canvas);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .form-card { max-width: 380px; width: 100%; }
        .form-card .eyebrow {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--burnt-dark); font-weight: 600; margin-bottom: 6px;
        }
        .form-card h2 { font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: var(--navy-deep); margin-bottom: 22px; }

        .form-label { font-weight: 600; font-size: 0.82rem; color: var(--navy-deep); }
        .form-control { border: 1px solid var(--border); padding: 10px 14px; border-radius: 7px; }
        .form-control:focus { border-color: var(--burnt); box-shadow: 0 0 0 3px rgba(232,99,59,0.12); }

        .btn-burnt {
            background: var(--burnt); border-color: var(--burnt); color: #fff; font-weight: 600;
            padding: 10px; border-radius: 7px;
        }
        .btn-burnt:hover { background: var(--burnt-dark); border-color: var(--burnt-dark); color:#fff; }

        @media (max-width: 860px) {
            .brand-panel { display: none; }
        }
    </style>
</head>
<body>

<div class="brand-panel">
    <div class="crate-icon"><i class="bi bi-box-seam-fill"></i></div>
    <h1 class="font-display">Kelola stok dan produk dari satu tempat.</h1>
    <p>Sistem manajemen produk untuk mencatat stok, kategori, dan supplier secara rapi dan akurat.</p>
    <div class="crate-stat">
        <div><div class="num">24/7</div><div class="lbl">Akses Real-time</div></div>
        <div><div class="num">100%</div><div class="lbl">Tercatat Rapi</div></div>
    </div>
</div>

<div class="form-panel">
    <div class="form-card">
        @if (session('success'))
            <div class="alert" style="background:#E7F2EC; border:1px solid #B7D9C5; color:#2F6B4F; border-radius:8px; font-size:0.88rem;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert" style="background:#FBEAE8; border:1px solid #E3B8B3; color:#8A2E2E; border-radius:8px; font-size:0.88rem;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
