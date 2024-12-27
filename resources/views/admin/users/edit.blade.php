@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Pengguna</h1>

    <!-- Form Edit Pengguna -->
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="w-50 mx-auto">
        @csrf
        @method('PUT')

        <!-- Input Nama -->
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <!-- Input Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <!-- Input Password -->
        <div class="form-group">
            <label for="password">Password (Kosongkan jika tidak ingin mengubah):</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="kelas">Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control" value="{{ old('kelas', $user->kelas ?? '') }}">
        </div>        

        <!-- Select Role -->
        <div class="form-group">
            <label for="role_id">Role:</label>
            <select name="role_id" id="role_id" class="form-control" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->role_id === $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Submit -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
