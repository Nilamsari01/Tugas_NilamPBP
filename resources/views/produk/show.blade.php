@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">Detail Produk</h1>
            <p class="text-muted">Informasi lengkap produk.</p>
        </div>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body row g-4">
            <div class="col-md-4">
                @if($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="img-fluid rounded">
                @else
                    <div class="border rounded p-5 text-center text-muted">Tidak ada gambar</div>
                @endif
            </div>
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr><th>Kode Produk</th><td>{{ $produk->kode_produk }}</td></tr>
                    <tr><th>Nama Produk</th><td>{{ $produk->nama_produk }}</td></tr>
                    <tr><th>Kategori</th><td>{{ $produk->kategori->nama_kategori }}</td></tr>
                    <tr><th>Supplier</th><td>{{ $produk->supplier->nama_supplier }}</td></tr>
                    <tr><th>Stok</th><td>{{ $produk->stok }}</td></tr>
                    <tr><th>Harga Beli</th><td>Rp {{ number_format($produk->harga_beli, 2, ',', '.') }}</td></tr>
                    <tr><th>Harga Jual</th><td>Rp {{ number_format($produk->harga_jual, 2, ',', '.') }}</td></tr>
                    <tr><th>Dibuat</th><td>{{ $produk->created_at->format('d F Y') }}</td></tr>
                </table>
            </div>
        </div>
    </div>
@endsection
