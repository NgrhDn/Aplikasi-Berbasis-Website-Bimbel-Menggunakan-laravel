@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Manajemen Pengguna</h1>

    <!-- Tombol Tambah Pengguna -->
    <div class="d-flex mb-3">
        <a href="{{ route('admin.users.createPengajar') }}" class="btn btn-primary mr-2">
            Tambah Pengajar
        </a>
        <a href="{{ route('admin.users.createSiswa') }}" class="btn btn-success">
            Tambah Siswa
        </a>
    </div>

    <!-- Filter Role -->
    <div class="mb-3">
        <form method="GET" action="{{ route('admin.users.index') }}">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label for="roleFilter" class="sr-only">Filter Role</label>
                    <select name="role" id="roleFilter" class="form-control">
                        <option value="" {{ request('role') == '' ? 'selected' : '' }}>Semua Pengguna</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pengajar" {{ request('role') == 'pengajar' ? 'selected' : '' }}>Pengajar</option>
                        <option value="siswa" {{ request('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-info">Filter</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabel Pengguna -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Kelas</th> <!-- Tambahkan kolom Kelas -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role->name ?? '-') }}</td> <!-- Role pengguna -->
                    <td>{{ $user->kelas ?? '-' }}</td> <!-- Kelas pengguna -->
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada pengguna ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
