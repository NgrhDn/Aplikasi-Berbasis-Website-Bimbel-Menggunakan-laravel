@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Absensi</h1>

    <!-- Tautan untuk melihat rekapan absensi -->
    <a href="{{ route('absensi.rekap') }}" class="btn btn-info mb-3">Lihat Rekapan Absensi</a>

    <!-- Form untuk memilih kelas dan tanggal -->
    <form action="{{ route('absensi.index') }}" method="GET">
        <div class="mb-3">
            <label for="kelas" class="form-label">Pilih Kelas:</label>
            <select name="kelas" id="kelas" class="form-select" required>
                <option value="" disabled selected>Pilih kelas</option>
                @foreach ($kelas as $kls)
                    <option value="{{ $kls }}" {{ isset($selectedKelas) && $selectedKelas == $kls ? 'selected' : '' }}>
                        Kelas {{ $kls }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan Siswa</button>
    </form>

    <!-- Daftar siswa -->
    @if($siswa->isNotEmpty())
        <form action="{{ route('absensi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kelas" value="{{ $selectedKelas }}">
            <input type="hidden" name="tanggal" value="{{ request('tanggal') }}">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $sis)
                        <tr>
                            <td>{{ $sis->name }}</td>
                            <td>Kelas {{ $sis->kelas }}</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="absensi[{{ $sis->id }}]" value="hadir" required>
                                    <label class="form-check-label">Hadir</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="absensi[{{ $sis->id }}]" value="sakit" required>
                                    <label class="form-check-label">Sakit</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="absensi[{{ $sis->id }}]" value="tanpa_keterangan" required>
                                    <label class="form-check-label">Tanpa Keterangan</label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Simpan Absensi</button>
        </form>
    @else
        <p class="mt-3">Pilih kelas untuk melihat daftar siswa.</p>
    @endif
</div>
@endsection
