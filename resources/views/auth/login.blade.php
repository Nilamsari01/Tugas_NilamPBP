@extends('layout-auth')

@section('content')
    <h4 class="card-title mb-4">Login</h4>
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary w-100">Login</button>
        <div class="mt-3 text-center">
            <a href="{{ route('register') }}">Belum punya akun? Register</a>
        </div>
    </form>
@endsection
