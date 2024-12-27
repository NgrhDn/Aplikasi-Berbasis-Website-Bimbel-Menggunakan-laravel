<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bimbel Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="d-flex flex-column min-vh-100">

    @if (!request()->is('login') && !request()->is('register'))
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand text-white" href="{{ url('/') }}">Bimbel Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    @auth
                        @if(auth()->user()->role->name === 'siswa')
                            <li class="nav-item"><a class="nav-link" href="{{ route('materi.index') }}">Materi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('absensi.rekap-siswa') }}">Rekap Absensi</a></li>
                        @elseif(auth()->user()->role->name === 'pengajar')
                            <li class="nav-item"><a class="nav-link" href="{{ route('materi.index') }}">Materi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('materi.create') }}">Upload Materi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('absensi.index') }}">Absensi</a></li>
                        @elseif(auth()->user()->role->name === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Manajemen Pengguna</a></li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>
    @endif

    <main class="flex-grow">
        <div class="container mt-4">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2024 Bimbel Online. All Rights Reserved.</p>
    </footer>

</body>
</html>
