@extends('layout')

@section('eyebrow', 'Data Master')
@section('title', 'Produk')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0" style="color:var(--ink-soft); font-size:0.88rem;">Kelola seluruh item produk, stok, dan harga di gudang Anda.</p>
        <a href="{{ route('produk.create') }}" class="btn btn-primary-burnt">
            <i class="bi bi-plus-lg"></i> Tambah Produk
        </a>
    </div>

    <div class="card-panel">
        <div class="p-3" style="border-bottom: 1px solid var(--border);">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari kode atau nama produk...">
                </div>
                <div class="col-md-4">
                    <select name="kategori_id" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-navy flex-grow-1">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="{{ route('produk.index') }}" class="btn btn-outline-navy"><i class="bi bi-x-lg"></i></a>
                </div>
            </form>
            <div class="mt-3 d-flex flex-wrap gap-2">
                <a href="{{ route('produk.export.pdf', request()->query()) }}" class="btn btn-sm btn-outline-navy">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </a>
                <a href="{{ route('produk.export.excel', request()->query()) }}" class="btn btn-sm btn-outline-navy">
                    <i class="bi bi-file-earmark-spreadsheet"></i> Export Excel
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-gudang mb-0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Stok</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $produk)
                        <tr>
                            <td>
                                @if ($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" style="width:42px;height:42px;object-fit:cover;border-radius:6px; border:1px solid var(--border);">
                                @else
                                    <div class="d-flex align-items-center justify-content-center" style="width:42px;height:42px;border-radius:6px;background:var(--canvas); border:1px solid var(--border);">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="kode-produk" style="color:var(--burnt-dark); font-weight:600; font-size:0.82rem;">{{ $produk->kode_produk }}</td>
                            <td style="font-weight:500;">{{ $produk->nama_produk }}</td>
                            <td><span class="badge-kategori">{{ $produk->kategori->nama_kategori ?? '-' }}</span></td>
                            <td style="font-size:0.85rem; color:var(--ink-soft);">{{ $produk->supplier->nama_supplier ?? '-' }}</td>
                            <td>
                                @if ($produk->stok <= 10)
                                    <span class="stok-tag menipis">{{ $produk->stok }} unit</span>
                                @else
                                    <span class="stok-tag aman">{{ $produk->stok }} unit</span>
                                @endif
                            </td>
                            <td class="rp" style="font-size:0.85rem;">Rp{{ number_format($produk->harga_beli, 0, ',', '.') }}</td>
                            <td class="rp" style="font-size:0.85rem; font-weight:600;">Rp{{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-sm btn-outline-navy" title="Detail"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-outline-navy" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-navy" title="Hapus" style="color:var(--warn-red); border-color:#E3B8B3;"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center text-muted py-5">Belum ada data produk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center p-3">
            {{ $produks->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
