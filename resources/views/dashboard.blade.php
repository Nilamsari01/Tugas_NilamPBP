@extends('layout')

@section('content')
    <h1 class="mb-4">Dashboard</h1>
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Total Produk</h6>
                    <h3>{{ $totalProduk }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Total Kategori</h6>
                    <h3>{{ $totalKategori }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Total Supplier</h6>
                    <h3>{{ $totalSupplier }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Total Stok</h6>
                    <h3>{{ $totalStok }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Produk Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Supplier</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produkTerbaru as $produk)
                                    <tr>
                                        <td>{{ $produk->kode_produk }}</td>
                                        <td>{{ $produk->nama_produk }}</td>
                                        <td>{{ $produk->kategori->nama_kategori }}</td>
                                        <td>{{ $produk->supplier->nama_supplier }}</td>
                                        <td>{{ $produk->stok }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada produk terbaru.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Stok Menipis</h5>
                    <ul class="list-group list-group-flush">
                        @forelse($stokMenipis as $produk)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $produk->nama_produk }}</strong><br>
                                    <small class="text-muted">{{ $produk->kategori->nama_kategori }} / {{ $produk->supplier->nama_supplier }}</small>
                                </div>
                                <span class="badge bg-danger">{{ $produk->stok }}</span>
                            </li>
                        @empty
                            <li class="list-group-item">Tidak ada produk menipis.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
