@extends('layout')

@section('eyebrow', 'Data Master')
@section('title', 'Kategori')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0" style="color:var(--ink-soft); font-size:0.88rem;">Klasifikasi produk untuk mempermudah pencarian dan pelaporan.</p>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary-burnt"><i class="bi bi-plus-lg"></i> Tambah Kategori</a>
    </div>

    <div class="card-panel">
        <div class="p-3" style="border-bottom: 1px solid var(--border);">
            <form method="GET" class="row g-2">
                <div class="col-md-7">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama kategori...">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-navy flex-grow-1"><i class="bi bi-search"></i> Cari</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-navy"><i class="bi bi-x-lg"></i></a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-gudang mb-0">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        <th>Jumlah Produk</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $kategori)
                        <tr>
                            <td style="font-weight:600;">{{ $kategori->nama_kategori }}</td>
                            <td style="color:var(--ink-soft); font-size:0.88rem;">{{ $kategori->keterangan ?? '-' }}</td>
                            <td><span class="stok-tag aman">{{ $kategori->produks_count }} produk</span></td>
                            <td class="text-center">
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-outline-navy"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-navy" style="color:var(--warn-red); border-color:#E3B8B3;"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-5">Belum ada data kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center p-3">
            {{ $kategoris->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
