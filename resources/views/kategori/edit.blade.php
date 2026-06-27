@extends('layout')

@section('eyebrow', 'Data Master / Kategori')
@section('title', 'Edit Kategori')

@section('content')

    <div class="card-panel" style="max-width: 600px;">
        <div class="card-panel-header"><span><i class="bi bi-pencil-square" style="color:var(--burnt);"></i> Edit Kategori</span></div>
        <div class="p-4">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                    @error('nama_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan (opsional)</label>
                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $kategori->keterangan) }}</textarea>
                    @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-burnt"><i class="bi bi-save"></i> Perbarui</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-navy">Batal</a>
                </div>
            </form>
        </div>
    </div>

@endsection
