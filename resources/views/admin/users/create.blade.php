@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="card">
    <div class="card-header">
        Tambah {{ ucfirst($role->name) }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
        
            <!-- Role ID otomatis -->
            <input type="hidden" name="role_id" value="{{ $role->id }}">
        
            <!-- Nama -->
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Input Kelas (Hanya untuk Siswa) -->
            @if (isset($role) && $role->name === 'siswa')
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" name="kelas" id="kelas" class="form-control" value="{{ old('kelas') }}">
                    @error('kelas')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif
        
            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Tombol Simpan -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
        </form>
        
    </div>
</div>
@endsection
