@extends('layout-auth')

@section('title', 'Masuk')

@section('content')
    <div class="eyebrow">Selamat Datang</div>
    <h2>Masuk ke akun Anda</h2>

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@gudang.id" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Kata Sandi</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-burnt w-100">
            <i class="bi bi-box-arrow-in-right"></i> Masuk
        </button>

        <p class="text-center mt-4 mb-0" style="font-size:0.88rem; color:#5B6B82;">
            Belum punya akun? <a href="{{ route('register') }}" style="color:#C94E2A; font-weight:600; text-decoration:none;">Daftar sekarang</a>
        </p>
    </form>
@endsection
