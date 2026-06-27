@extends('layout')

@section('eyebrow', 'Transaksi')
@section('title', 'Tambah Barang Keluar')

@section('content')
    <div class="card-panel">
        <h4 class="mb-3">Form Barang Keluar</h4>

        @if (session('error'))
            <div class="alert" style="background:#FBEAE8; border:1px solid #E3B8B3; color:#8A2E2E; border-radius:8px; margin-bottom:1rem;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('barang_keluar.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Produk</label>
                <select name="produk_id" class="form-select @error('produk_id') is-invalid @enderror">
                    <option value="">Pilih produk</option>
                    @foreach ($produks as $produk)
                        <option value="{{ $produk->id }}" {{ old('produk_id') == $produk->id ? 'selected' : '' }}>
                            {{ $produk->kode_produk }} - {{ $produk->nama_produk }} (Stok: {{ $produk->stok }})
                        </option>
                    @endforeach
                </select>
                @error('produk_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" min="1">
                @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror" value="{{ old('tanggal_keluar', date('Y-m-d')) }}">
                @error('tanggal_keluar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Keterangan</label>
                <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}">
                @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang_keluar.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
@endsection
