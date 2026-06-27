@extends('layout')

@section('eyebrow', 'Data Master / Supplier')
@section('title', 'Edit Supplier')

@section('content')

    <div class="card-panel" style="max-width: 600px;">
        <div class="card-panel-header"><span><i class="bi bi-pencil-square" style="color:var(--burnt);"></i> Edit Supplier</span></div>
        <div class="p-4">
            <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Supplier</label>
                    <input type="text" name="nama_supplier" class="form-control @error('nama_supplier') is-invalid @enderror" value="{{ old('nama_supplier', $supplier->nama_supplier) }}">
                    @error('nama_supplier') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Telepon (opsional)</label>
                    <input type="text" name="telepon" class="form-control font-mono @error('telepon') is-invalid @enderror" value="{{ old('telepon', $supplier->telepon) }}">
                    @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat (opsional)</label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat', $supplier->alamat) }}</textarea>
                    @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-burnt"><i class="bi bi-save"></i> Perbarui</button>
                    <a href="{{ route('supplier.index') }}" class="btn btn-outline-navy">Batal</a>
                </div>
            </form>
        </div>
    </div>

@endsection
