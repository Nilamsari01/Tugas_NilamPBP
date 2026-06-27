@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">Supplier</h1>
            <p class="text-muted">Kelola supplier produk.</p>
        </div>
        <a href="{{ route('supplier.create') }}" class="btn btn-primary">Tambah Supplier</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('supplier.index') }}" method="GET" class="row g-3 mb-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label">Cari Supplier</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Nama supplier">
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-primary">Cari</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Nama Supplier</th>
                            <th>Jumlah Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->nama_supplier }}</td>
                                <td>{{ $supplier->produks_count }}</td>
                                <td>
                                    <a href="{{ route('supplier.edit', $supplier) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('supplier.destroy', $supplier) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus supplier ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada supplier.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $suppliers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
