@extends('layouts.app')

@section('title', 'Rekap Absensi')

@section('content')
<div class="container">
    <h1>Rekap Absensi Bulanan</h1>

    {{-- Check if we have the attendance summary for the selected month --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Total Hadir</th>
                <th>Total Sakit</th>
                <th>Total Tanpa Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ \Carbon\Carbon::create()->month($rekapAbsensi->bulan)->translatedFormat('F') }}</td>
                <td>{{ $rekapAbsensi->total_hadir }}</td>
                <td>{{ $rekapAbsensi->total_sakit }}</td>
                <td>{{ $rekapAbsensi->total_tanpa_keterangan }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Display a message if no data is available --}}
    @if($rekapAbsensi->total_hadir == 0 && $rekapAbsensi->total_sakit == 0 && $rekapAbsensi->total_tanpa_keterangan == 0)
        <p>Belum ada data absensi untuk bulan ini.</p>
    @endif
</div>
@endsection
