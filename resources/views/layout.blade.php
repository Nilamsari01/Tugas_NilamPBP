<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Produk App</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">{{ session('user_name') }}</span>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="sidebar bg-light border-end" style="width: 240px; padding-top: 5rem; position: fixed; height: 100vh;">
        <div class="list-group list-group-flush">
            <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="{{ route('produk.index') }}" class="list-group-item list-group-item-action">Produk</a>
            <a href="{{ route('kategori.index') }}" class="list-group-item list-group-item-action">Kategori</a>
            <a href="{{ route('supplier.index') }}" class="list-group-item list-group-item-action">Supplier</a>
            <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action">User</a>
        </div>
    </div>
    <main class="flex-grow-1" style="margin-left: 240px; padding: 5rem 2rem 2rem;">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
