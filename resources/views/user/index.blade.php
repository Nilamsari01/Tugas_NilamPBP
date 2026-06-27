@extends('layout')

@section('eyebrow', 'Administrasi')
@section('title', 'Pengguna')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0" style="color:var(--ink-soft); font-size:0.88rem;">Kelola akses admin dan staf yang dapat masuk ke sistem.</p>
        <a href="{{ route('user.create') }}" class="btn btn-primary-burnt"><i class="bi bi-plus-lg"></i> Tambah Pengguna</a>
    </div>

    <div class="card-panel">
        <div class="p-3" style="border-bottom: 1px solid var(--border);">
            <form method="GET" class="row g-2">
                <div class="col-md-7">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama atau email...">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-navy flex-grow-1"><i class="bi bi-search"></i> Cari</button>
                    <a href="{{ route('user.index') }}" class="btn btn-outline-navy"><i class="bi bi-x-lg"></i></a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-gudang mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td style="font-weight:600;">
                                <span class="user-avatar d-inline-flex align-items-center justify-content-center me-2" style="width:26px;height:26px;font-size:0.7rem;">{{ strtoupper(substr($user->name,0,1)) }}</span>
                                {{ $user->name }}
                            </td>
                            <td style="color:var(--ink-soft); font-size:0.88rem;">{{ $user->email }}</td>
                            <td>
                                @if ($user->role === 'admin')
                                    <span class="stok-tag menipis">admin</span>
                                @else
                                    <span class="stok-tag aman">staff</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-outline-navy"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-navy" style="color:var(--warn-red); border-color:#E3B8B3;"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-5">Belum ada data user.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center p-3">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
