@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">Kategori</h1>
            <p class="text-muted">Kelola kategori produk.</p>
        </div>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('kategori.index') }}" method="GET" class="row g-3 mb-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label">Cari Kategori</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Nama kategori">
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-primary">Cari</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Jumlah Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $kategori)
                            <tr>
                                <td>{{ $kategori->nama_kategori }}</td>
                                <td>{{ $kategori->produks_count }}</td>
                                <td>
                                    <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $kategoris->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
