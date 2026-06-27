@extends('layout')

@section('eyebrow', 'Data Master')
@section('title', 'Supplier')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0" style="color:var(--ink-soft); font-size:0.88rem;">Daftar mitra pemasok produk untuk gudang Anda.</p>
        <a href="{{ route('supplier.create') }}" class="btn btn-primary-burnt"><i class="bi bi-plus-lg"></i> Tambah Supplier</a>
    </div>

    <div class="card-panel">
        <div class="p-3" style="border-bottom: 1px solid var(--border);">
            <form method="GET" class="row g-2">
                <div class="col-md-7">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama supplier...">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-navy flex-grow-1"><i class="bi bi-search"></i> Cari</button>
                    <a href="{{ route('supplier.index') }}" class="btn btn-outline-navy"><i class="bi bi-x-lg"></i></a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-gudang mb-0">
                <thead>
                    <tr>
                        <th>Nama Supplier</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Jumlah Produk</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                        <tr>
                            <td style="font-weight:600;"><i class="bi bi-truck" style="color:var(--burnt); margin-right:6px;"></i>{{ $supplier->nama_supplier }}</td>
                            <td class="font-mono" style="font-size:0.85rem;">{{ $supplier->telepon ?? '-' }}</td>
                            <td style="color:var(--ink-soft); font-size:0.85rem;">{{ $supplier->alamat ?? '-' }}</td>
                            <td><span class="stok-tag aman">{{ $supplier->produks_count }} produk</span></td>
                            <td class="text-center">
                                <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-outline-navy"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-navy" style="color:var(--warn-red); border-color:#E3B8B3;"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-5">Belum ada data supplier.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center p-3">
            {{ $suppliers->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
