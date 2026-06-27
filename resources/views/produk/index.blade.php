@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">Produk</h1>
            <p class="text-muted">Kelola daftar produk.</p>
        </div>
        <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('produk.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control" placeholder="Kode atau Nama Produk">
                </div>
                <div class="col-md-4">
                    <label for="kategori_id" class="form-label">Filter Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Stok</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $produk)
                        <tr>
                            <td style="width: 100px;">
                                @if($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="img-fluid rounded" style="max-height: 80px;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $produk->kode_produk }}</td>
                            <td>{{ $produk->nama_produk }}</td>
                            <td><span class="badge bg-secondary">{{ $produk->kategori->nama_kategori }}</span></td>
                            <td>{{ $produk->supplier->nama_supplier }}</td>
                            <td>
                                <span class="badge {{ $produk->stok <= 10 ? 'bg-danger' : 'bg-success' }}">{{ $produk->stok }}</span>
                            </td>
                            <td>Rp {{ number_format($produk->harga_beli, 2, ',', '.') }}</td>
                            <td>Rp {{ number_format($produk->harga_jual, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('produk.show', $produk) }}" class="btn btn-sm btn-info">Lihat</a>
                                <a href="{{ route('produk.edit', $produk) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('produk.destroy', $produk) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $produks->links('pagination::bootstrap-5') }}
    </div>
@endsection
