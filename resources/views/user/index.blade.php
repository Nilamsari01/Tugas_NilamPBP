@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">User</h1>
            <p class="text-muted">Kelola akun pengguna.</p>
        </div>
        <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah User</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('user.index') }}" method="GET" class="row g-3 mb-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label">Cari User</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Nama atau email">
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-primary">Cari</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('user.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
