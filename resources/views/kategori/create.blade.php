@extends('layout')

@section('eyebrow', 'Data Master / Kategori')
@section('title', 'Tambah Kategori')

@section('content')

    <div class="card-panel" style="max-width: 600px;">
        <div class="card-panel-header"><span><i class="bi bi-tags-fill" style="color:var(--burnt);"></i> Kategori Baru</span></div>
        <div class="p-4">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}" placeholder="Contoh: Elektronik">
                    @error('nama_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan (opsional)</label>
                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Deskripsi kategori">{{ old('keterangan') }}</textarea>
                    @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-burnt"><i class="bi bi-save"></i> Simpan</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-navy">Batal</a>
                </div>
            </form>
        </div>
    </div>

@endsection
