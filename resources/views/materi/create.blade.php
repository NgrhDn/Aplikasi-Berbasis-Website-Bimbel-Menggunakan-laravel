@extends('layouts.app')

@section('title', 'Unggah Materi')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Unggah Materi Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Input Judul Materi -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Materi</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul materi" required>
                </div>

                <!-- Dropdown Kelas -->
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select class="form-select" id="kelas" name="kelas" required>
                        <option value="" selected disabled>Pilih Kelas</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class }}">{{ $class }}</option>
                        @endforeach
                    </select>                    
                </div>

                <!-- Input File -->
                <div class="mb-3">
                    <label for="file" class="form-label">File Materi (PDF)</label>
                    <input type="file" class="form-control" id="file" name="file" accept="application/pdf" required>
                </div>

                <!-- Tombol Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">Unggah Materi</button>
                    <a href="{{ route('materi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
