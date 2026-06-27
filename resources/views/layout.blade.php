<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Gudang.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --navy-deep: #0F1B2D;
            --navy-mid: #16243B;
            --navy-line: #233852;
            --canvas: #F7F5F1;
            --paper: #FFFFFF;
            --ink: #1A2230;
            --ink-soft: #5B6B82;
            --burnt: #E8633B;
            --burnt-dark: #C94E2A;
            --ok-green: #2F6B4F;
            --ok-bg: #E7F2EC;
            --warn-red: #8A2E2E;
            --warn-bg: #FBEAE8;
            --border: #E4E1D8;
        }

        * { box-sizing: border-box; }

        body {
            background-color: var(--canvas);
            color: var(--ink);
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 0.94rem;
        }

        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -0.01em;
        }

        .font-mono, .stat-value, .kode-produk, .rp {
            font-family: 'JetBrains Mono', monospace;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 256px;
            min-height: 100vh;
            background-color: var(--navy-deep);
            background-image: repeating-linear-gradient(
                90deg,
                transparent 0px,
                transparent 31px,
                rgba(255,255,255,0.025) 32px
            );
            border-right: 1px solid var(--navy-line);
            position: sticky;
            top: 0;
        }

        .brand-mark {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 22px 20px;
            border-bottom: 1px solid var(--navy-line);
        }

        .brand-mark .crate-icon {
            width: 34px;
            height: 34px;
            background: var(--burnt);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        .brand-mark .brand-text {
            color: #fff;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            line-height: 1.1;
        }

        .brand-mark .brand-sub {
            color: #7E93B0;
            font-size: 0.7rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace;
        }

        .nav-section-label {
            color: #5C7295;
            font-size: 0.68rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 600;
            padding: 18px 20px 8px;
            font-family: 'JetBrains Mono', monospace;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            margin: 2px 10px;
            border-radius: 8px;
            color: #AEBCD4;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.15s ease;
            position: relative;
        }

        .sidebar-link i { font-size: 1.05rem; width: 20px; text-align: center; }

        .sidebar-link:hover {
            background-color: var(--navy-mid);
            color: #fff;
        }

        .sidebar-link.active {
            background-color: var(--burnt);
            color: #fff;
            font-weight: 600;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: -10px;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 18px;
            background: var(--burnt);
            border-radius: 2px;
        }

        /* ===== TOP BAR ===== */
        .topbar {
            background-color: var(--paper);
            border-bottom: 1px solid var(--border);
            padding: 14px 28px;
        }

        .page-eyebrow {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--burnt-dark);
            font-weight: 600;
        }

        .page-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin: 0;
            color: var(--navy-deep);
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px 6px 6px;
            background: var(--canvas);
            border: 1px solid var(--border);
            border-radius: 30px;
        }

        .user-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--navy-deep);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            font-family: 'Space Grotesk', sans-serif;
        }

        .role-tag {
            font-size: 0.62rem;
            font-family: 'JetBrains Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--ink-soft);
        }

        /* ===== CONTENT ===== */
        .content-area { padding: 26px 28px 40px; }

        .card-panel {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 10px;
        }

        .card-panel-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            color: var(--navy-deep);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* ===== BUTTONS ===== */
        .btn-primary-burnt {
            background-color: var(--burnt);
            border-color: var(--burnt);
            color: #fff;
            font-weight: 600;
            font-size: 0.88rem;
        }
        .btn-primary-burnt:hover {
            background-color: var(--burnt-dark);
            border-color: var(--burnt-dark);
            color: #fff;
        }

        .btn-outline-navy {
            border-color: var(--navy-line);
            color: var(--navy-deep);
            background: transparent;
            font-weight: 500;
        }
        .btn-outline-navy:hover {
            background-color: var(--navy-deep);
            color: #fff;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            background: var(--navy-deep);
            border-radius: 10px;
            padding: 18px 20px;
            position: relative;
            overflow: hidden;
            color: #fff;
        }
        .stat-card .stat-index {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            color: #6E84A8;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .stat-card .stat-value {
            font-size: 1.9rem;
            font-weight: 700;
            margin-top: 4px;
            font-family: 'Space Grotesk', sans-serif;
        }
        .stat-card .stat-label {
            color: #9FB0C9;
            font-size: 0.78rem;
            margin-top: 2px;
        }
        .stat-card.accent { background: var(--burnt); }
        .stat-card.accent .stat-index { color: rgba(255,255,255,0.65); }
        .stat-card.accent .stat-label { color: rgba(255,255,255,0.85); }

        /* ===== STATUS LABEL (signature element: warehouse tag) ===== */
        .stok-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.74rem;
            font-weight: 600;
            padding: 3px 10px 3px 8px;
            border-radius: 3px 8px 3px 8px;
            border: 1px dashed;
        }
        .stok-tag.aman {
            background: var(--ok-bg);
            color: var(--ok-green);
            border-color: #B7D9C5;
        }
        .stok-tag.menipis {
            background: var(--warn-bg);
            color: var(--warn-red);
            border-color: #E3B8B3;
        }
        .stok-tag::before { content: '●'; font-size: 0.55rem; }

        .badge-kategori {
            background: var(--navy-deep);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 500;
            padding: 4px 10px;
            border-radius: 5px;
            font-family: 'Inter', sans-serif;
        }

        table.table-gudang thead th {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--ink-soft);
            border-bottom: 2px solid var(--navy-deep);
            font-weight: 600;
            padding: 12px 14px;
        }
        table.table-gudang tbody td {
            padding: 12px 14px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border);
        }
        table.table-gudang tbody tr:hover { background-color: #FBFAF7; }

        .form-control:focus, .form-select:focus {
            border-color: var(--burnt);
            box-shadow: 0 0 0 3px rgba(232, 99, 59, 0.12);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--navy-deep);
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column">
        <div class="brand-mark">
            <div class="crate-icon"><i class="bi bi-box-seam-fill"></i></div>
            <div>
                <div class="brand-text">Gudang.id</div>
                <div class="brand-sub">Inventory System</div>
            </div>
        </div>

        <div class="nav-section-label">Menu Utama</div>
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>

        <div class="nav-section-label">Data Master</div>
        <a href="{{ route('produk.index') }}" class="sidebar-link {{ request()->routeIs('produk.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Produk
        </a>
        <a href="{{ route('kategori.index') }}" class="sidebar-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <i class="bi bi-tags-fill"></i> Kategori
        </a>
        <a href="{{ route('supplier.index') }}" class="sidebar-link {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
            <i class="bi bi-truck"></i> Supplier
        </a>

        <div class="nav-section-label">Transaksi</div>
        <a href="{{ route('barang_masuk.index') }}" class="sidebar-link {{ request()->routeIs('barang_masuk.*') ? 'active' : '' }}">
            <i class="bi bi-arrow-down-circle"></i> Barang Masuk
        </a>
        <a href="{{ route('barang_keluar.index') }}" class="sidebar-link {{ request()->routeIs('barang_keluar.*') ? 'active' : '' }}">
            <i class="bi bi-arrow-up-circle"></i> Barang Keluar
        </a>

        @if (session('user_role') === 'admin')
        <div class="nav-section-label">Administrasi</div>
        <a href="{{ route('user.index') }}" class="sidebar-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Pengguna
        </a>
        @endif

        <div class="mt-auto p-3">
            <div class="px-2 py-2" style="border-top: 1px solid var(--navy-line);">
                <span class="font-mono" style="font-size:0.65rem; color:#5C7295; letter-spacing:0.05em;">
                    v1.0 &middot; Sistem Gudang
                </span>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <div class="flex-grow-1" style="min-width:0;">
        <nav class="topbar d-flex justify-content-between align-items-center">
            <div>
                <div class="page-eyebrow">@yield('eyebrow', 'Modul')</div>
                <h1 class="page-title">@yield('title', 'Dashboard')</h1>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="user-chip">
                    <div class="user-avatar">{{ strtoupper(substr(session('user_name', 'U'), 0, 1)) }}</div>
                    <div>
                        <div style="font-size:0.82rem; font-weight:600; line-height:1.1;">{{ session('user_name') }}</div>
                        <div class="role-tag">{{ session('user_role') }}</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-navy">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </nav>

        <div class="content-area">
            @if (session('success'))
                <div class="alert d-flex align-items-center gap-2 mb-3" style="background:var(--ok-bg); border:1px solid #B7D9C5; color:var(--ok-green); border-radius:8px;">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert d-flex align-items-center gap-2 mb-3" style="background:var(--warn-bg); border:1px solid #E3B8B3; color:var(--warn-red); border-radius:8px;">
                    <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
