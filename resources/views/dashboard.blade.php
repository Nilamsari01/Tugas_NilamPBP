@extends('layout')

@section('eyebrow', 'Ringkasan')
@section('title', 'Dashboard')

@section('content')

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-index">001 / Produk</div>
                <div class="stat-value">{{ $totalProduk }}</div>
                <div class="stat-label">Total item terdaftar</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-index">002 / Kategori</div>
                <div class="stat-value">{{ $totalKategori }}</div>
                <div class="stat-label">Klasifikasi produk</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-index">003 / Supplier</div>
                <div class="stat-value">{{ $totalSupplier }}</div>
                <div class="stat-label">Mitra pemasok</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card">
                <div class="stat-index">004 / Stok</div>
                <div class="stat-value">{{ $totalStok }}</div>
                <div class="stat-label">Unit tersedia di gudang</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card">
                <div class="stat-index">005 / Masuk</div>
                <div class="stat-value">{{ $totalBarangMasuk }}</div>
                <div class="stat-label">Total barang masuk</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card">
                <div class="stat-index">006 / Keluar</div>
                <div class="stat-value">{{ $totalBarangKeluar }}</div>
                <div class="stat-label">Total barang keluar</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-index">007 / Pengeluaran</div>
                <div class="stat-value">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                <div class="stat-label">Total biaya barang masuk</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-index">008 / Pendapatan</div>
                <div class="stat-value">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                <div class="stat-label">Total pemasukan barang keluar</div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-7">
            <div class="card-panel">
                <div class="card-panel-header">
                    <span><i class="bi bi-bar-chart-line-fill" style="color:var(--burnt);"></i> Produk per Kategori</span>
                </div>
                <div class="p-4">
                    <canvas id="kategoriChart" height="220"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card-panel">
                <div class="card-panel-header">
                    <span><i class="bi bi-arrow-down-right-circle" style="color:var(--burnt);"></i> Ringkasan Transaksi</span>
                </div>
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="font-mono">Total Masuk</span>
                        <span class="fw-bold">{{ $totalBarangMasuk }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-mono">Total Keluar</span>
                        <span class="fw-bold">{{ $totalBarangKeluar }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-7">
            <div class="card-panel">
                <div class="card-panel-header">
                    <span><i class="bi bi-clock-history" style="color:var(--burnt);"></i> Produk Terbaru</span>
                    <a href="{{ route('produk.index') }}" class="font-mono" style="font-size:0.72rem; color:var(--ink-soft); text-decoration:none;">LIHAT SEMUA &rarr;</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-gudang mb-0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkTerbaru as $produk)
                                <tr>
                                    <td class="kode-produk" style="color:var(--burnt-dark); font-weight:600; font-size:0.82rem;">{{ $produk->kode_produk }}</td>
                                    <td style="font-weight:500;">{{ $produk->nama_produk }}</td>
                                    <td><span class="badge-kategori">{{ $produk->kategori->nama_kategori ?? '-' }}</span></td>
                                    <td class="stat-value" style="font-size:0.95rem; font-weight:600;">{{ $produk->stok }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-muted py-4">Belum ada produk.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card-panel">
                <div class="card-panel-header">
                    <span><i class="bi bi-exclamation-triangle-fill" style="color:var(--warn-red);"></i> Stok Menipis</span>
                    <span class="font-mono" style="font-size:0.68rem; color:var(--ink-soft);">≤ 10 UNIT</span>
                </div>
                <div class="p-2">
                    @forelse ($stokMenipis as $produk)
                        <div class="d-flex justify-content-between align-items-center px-3 py-2" style="border-bottom: 1px solid var(--border);">
                            <div>
                                <div style="font-weight:600; font-size:0.88rem;">{{ $produk->nama_produk }}</div>
                                <div class="font-mono" style="font-size:0.7rem; color:var(--ink-soft);">{{ $produk->kategori->nama_kategori ?? '-' }}</div>
                            </div>
                            <span class="stok-tag menipis">{{ $produk->stok }} unit</span>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4" style="font-size:0.88rem;">
                            <i class="bi bi-check-circle" style="font-size:1.5rem; color:var(--ok-green);"></i>
                            <div class="mt-2">Semua stok dalam kondisi aman.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('kategoriChart');
        if (ctx) {
            const kategoriLabels = @json($grafikProduk->pluck('kategori.nama_kategori'));
            const kategoriData = @json($grafikProduk->pluck('total'));

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: kategoriLabels,
                    datasets: [{
                        label: 'Jumlah Produk',
                        data: kategoriData,
                        backgroundColor: 'rgba(232, 99, 59, 0.75)',
                        borderColor: 'rgba(232, 99, 59, 1)',
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(15, 27, 45, 0.05)' }
                        },
                        x: {
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    </script>
@endsection
