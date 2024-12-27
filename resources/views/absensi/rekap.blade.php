@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rekap Absensi</h1>

    <!-- Form untuk filter -->
    <form action="{{ route('absensi.rekap') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="kelas" class="form-label">Pilih Kelas:</label>
                <select name="kelas" id="kelas" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Kelas --</option>
                    @foreach ($kelas as $item)
                        <option value="{{ $item }}" {{ (isset($selectedKelas) && $selectedKelas == $item) ? 'selected' : '' }}>
                            Kelas {{ $item }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="tanggal" class="form-label">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $selectedTanggal ?? '' }}" required>
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary">Tampilkan Rekap</button>
            </div>
        </div>
    </form>

    <!-- Tombol untuk Export PDF -->
    @if(!empty($dataAbsensi))
    <form action="{{ route('absensi.export-pdf') }}" method="GET" class="mb-4">
        <input type="hidden" name="kelas" value="{{ $selectedKelas }}">
        <input type="hidden" name="tanggal" value="{{ $selectedTanggal }}">
        <button type="submit" class="btn btn-secondary">Export to PDF</button>
    </form>
    @endif

    <!-- Tabel rekapan absensi -->
    @if (!empty($dataAbsensi))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataAbsensi as $absensi)
                    <tr>
                        <td>{{ $absensi->user->name ?? 'Tidak Diketahui' }}</td>
                        <td>Kelas {{ $absensi->kelas }}</td>
                        <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ ucfirst($absensi->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data absensi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif
</div>
@endsection
