@extends('layout')

@section('eyebrow', 'Data Master / Produk')
@section('title', 'Edit Produk')

@section('content')

    <div class="card-panel" style="max-width: 760px;">
        <div class="card-panel-header">
            <span><i class="bi bi-pencil-square" style="color:var(--burnt);"></i> Edit Data Produk</span>
            <span class="kode-produk" style="color:var(--burnt-dark); font-weight:600;">{{ $produk->kode_produk }}</span>
        </div>
        <div class="p-4">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Kode Produk</label>
                        <input type="text" name="kode_produk" class="form-control font-mono @error('kode_produk') is-invalid @enderror" value="{{ old('kode_produk', $produk->kode_produk) }}">
                        @error('kode_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk', $produk->nama_produk) }}">
                        @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Supplier</label>
                        <select name="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id', $produk->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->nama_supplier }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control font-mono @error('stok') is-invalid @enderror" value="{{ old('stok', $produk->stok) }}" min="0">
                        @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Harga Beli</label>
                        <input type="number" step="0.01" name="harga_beli" class="form-control font-mono @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli', $produk->harga_beli) }}" min="0">
                        @error('harga_beli') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Harga Jual</label>
                        <input type="number" step="0.01" name="harga_jual" class="form-control font-mono @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual', $produk->harga_jual) }}" min="0">
                        @error('harga_jual') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Gambar Produk</label>
                        @if ($produk->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $produk->gambar) }}" style="width:70px;height:70px;object-fit:cover;border-radius:6px; border:1px solid var(--border);">
                            </div>
                        @endif
                        <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                        <small style="color:var(--ink-soft);">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary-burnt"><i class="bi bi-save"></i> Perbarui</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-outline-navy">Batal</a>
                </div>
            </form>
        </div>
    </div>

@endsection
