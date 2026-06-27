@extends('layout')

@section('eyebrow', 'Transaksi')
@section('title', 'Barang Masuk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Catatan Barang Masuk</h2>
            <p class="text-muted mb-0">Kelola pencatatan barang masuk ke gudang.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('barang_masuk.export.excel') }}" class="btn btn-outline-navy">Export Laporan</a>
            <a href="{{ route('barang_masuk.create') }}" class="btn btn-primary">Tambah Barang Masuk</a>
        </div>
    </div>

    <div class="card-panel">
        <div class="table-responsive">
            <table class="table table-gudang mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total Biaya</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangMasuks as $item)
                        <tr>
                            <td>{{ $item->tanggal_masuk->format('d M Y') }}</td>
                            <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp{{ number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td>
                                <form action="{{ route('barang_masuk.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus catatan barang masuk?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Belum ada catatan barang masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $barangMasuks->links('pagination::bootstrap-5') }}</div>
    </div>
@endsection
