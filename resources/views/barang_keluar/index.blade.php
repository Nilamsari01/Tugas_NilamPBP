@extends('layout')

@section('eyebrow', 'Transaksi')
@section('title', 'Barang Keluar')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Catatan Barang Keluar</h2>
            <p class="text-muted mb-0">Kelola pencatatan barang keluar dari gudang.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('barang_keluar.export.excel') }}" class="btn btn-outline-navy">Export Laporan</a>
            <a href="{{ route('barang_keluar.create') }}" class="btn btn-primary">Tambah Barang Keluar</a>
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
                        <th>Total Pendapatan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangKeluars as $item)
                        <tr>
                            <td>{{ $item->tanggal_keluar->format('d M Y') }}</td>
                            <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp{{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td>
                                <form action="{{ route('barang_keluar.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus catatan barang keluar?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Belum ada catatan barang keluar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $barangKeluars->links('pagination::bootstrap-5') }}</div>
    </div>
@endsection
