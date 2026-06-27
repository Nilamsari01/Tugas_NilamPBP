@extends('layout')

@section('eyebrow', 'Transaksi')
@section('title', 'Tambah Barang Masuk')

@section('content')
    <div class="card-panel">
        <h4 class="mb-3">Form Barang Masuk</h4>

        <form action="{{ route('barang_masuk.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Produk</label>
                <select name="produk_id" class="form-select @error('produk_id') is-invalid @enderror">
                    <option value="">Pilih produk</option>
                    @foreach ($produks as $produk)
                        <option value="{{ $produk->id }}" {{ old('produk_id') == $produk->id ? 'selected' : '' }}>
                            {{ $produk->kode_produk }} - {{ $produk->nama_produk }}
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
                <label class="form-label">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk', date('Y-m-d')) }}">
                @error('tanggal_masuk') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Keterangan</label>
                <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}">
                @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang_masuk.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
@endsection
