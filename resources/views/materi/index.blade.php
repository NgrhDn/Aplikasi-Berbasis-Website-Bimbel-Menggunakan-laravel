@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Materi</h2>

    <!-- Tampilan untuk Pengajar -->
    @if ($role === 'pengajar')
        @forelse ($materis as $kelas => $materiGroup)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Kelas: {{ $kelas ?? 'Tanpa Kelas' }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($materiGroup as $materi)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $materi->judul }}</strong>
                                <br>
                                <small>Diunggah oleh: {{ $materi->user->name ?? 'Tidak diketahui' }}</small>
                            </div>
                            <div>
                                <a href="{{ route('materi.download', $materi->id) }}" class="btn btn-sm btn-primary">Download</a>
                                @if (auth()->id() === $materi->pengajar_id)
                                    <form action="{{ route('materi.destroy', $materi->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus materi ini?')">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @empty
            <p>Tidak ada materi yang diunggah.</p>
        @endforelse

    <!-- Tampilan untuk Siswa -->
    @elseif ($role === 'siswa')
        <ul class="list-group">
            @forelse ($materis as $materi)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $materi->judul }}</strong>
                        <br>
                        <small>Diunggah oleh: {{ $materi->user->name ?? 'Tidak diketahui' }}</small>
                    </div>
                    <a href="{{ route('materi.download', $materi->id) }}" class="btn btn-sm btn-primary">Download</a>
                </li>
            @empty
                <li class="list-group-item">Belum ada materi untuk kelas Anda.</li>
            @endforelse
        </ul>

    <!-- Jika Role Tidak Dikenali -->
    @else
        <p class="text-danger">Akses ditolak.</p>
    @endif
</div>
@endsection
