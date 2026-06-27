@extends('layout')

@section('eyebrow', 'Data Master / Produk')
@section('title', 'Detail Produk')

@section('content')

    <div class="card-panel" style="max-width: 820px;">
        <div class="card-panel-header">
            <span><i class="bi bi-box-seam" style="color:var(--burnt);"></i> Detail Produk</span>
            <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-navy"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>

        <div class="p-4">
            <div class="row">
                <div class="col-md-3 text-center">
                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="img-fluid rounded" style="border:1px solid var(--border);" alt="{{ $produk->nama_produk }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center rounded" style="height:160px; background:var(--canvas); border:1px solid var(--border);">
                            <i class="bi bi-image text-muted fs-1"></i>
                        </div>
                    @endif
                </div>

                <div class="col-md-9">
                    <div class="kode-produk mb-1" style="color:var(--burnt-dark); font-weight:700; font-size:1rem;">{{ $produk->kode_produk }}</div>
                    <h3 class="font-display mb-3">{{ $produk->nama_produk }}</h3>

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="font-mono" style="font-size:0.68rem; color:var(--ink-soft); text-transform:uppercase; letter-spacing:0.06em;">Kategori</div>
                            <span class="badge-kategori">{{ $produk->kategori->nama_kategori ?? '-' }}</span>
                        </div>
                        <div class="col-6">
                            <div class="font-mono" style="font-size:0.68rem; color:var(--ink-soft); text-transform:uppercase; letter-spacing:0.06em;">Supplier</div>
                            <div style="font-weight:500;">{{ $produk->supplier->nama_supplier ?? '-' }}</div>
                        </div>
                        <div class="col-6">
                            <div class="font-mono" style="font-size:0.68rem; color:var(--ink-soft); text-transform:uppercase; letter-spacing:0.06em;">Stok Tersedia</div>
                            @if ($produk->stok <= 10)
                                <span class="stok-tag menipis">{{ $produk->stok }} unit</span>
                            @else
                                <span class="stok-tag aman">{{ $produk->stok }} unit</span>
                            @endif
                        </div>
                        <div class="col-6"></div>
                        <div class="col-6">
                            <div class="font-mono" style="font-size:0.68rem; color:var(--ink-soft); text-transform:uppercase; letter-spacing:0.06em;">Harga Beli</div>
                            <div class="rp" style="font-size:1.05rem;">Rp{{ number_format($produk->harga_beli, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-6">
                            <div class="font-mono" style="font-size:0.68rem; color:var(--ink-soft); text-transform:uppercase; letter-spacing:0.06em;">Harga Jual</div>
                            <div class="rp" style="font-size:1.05rem; font-weight:700; color:var(--burnt-dark);">Rp{{ number_format($produk->harga_jual, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
