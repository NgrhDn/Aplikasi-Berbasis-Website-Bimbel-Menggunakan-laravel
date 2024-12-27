<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Rekap Absensi Kelas {{ $kelas }}</h1>
    <p>Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataAbsensi as $absensi)
                <tr>
                    <td>{{ $absensi->user->name ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $absensi->kelas }}</td>
                    <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($absensi->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
