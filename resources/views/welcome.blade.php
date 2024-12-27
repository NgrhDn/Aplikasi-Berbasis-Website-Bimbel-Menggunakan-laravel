<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Bimbingan Belajar</title>
    <!-- Sertakan TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-[#FF2D20] shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-white text-2xl font-semibold">Bimbingan Belajar</a>
            <div class="space-x-6">
                <a href="#home" class="text-white hover:text-gray-300">Home</a>
                <a href="#about" class="text-white hover:text-gray-300">About</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-gray-300">Contact Person</a>
                <a href="{{ route('login') }}" class="text-white hover:text-gray-300">Login</a>
            </div>
        </div>
    </nav>

    <!-- Welcome Section -->
    <section class="flex items-center justify-center bg-cover bg-center h-screen relative"
        style="background-image: url('{{ asset('images/bimbel.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="text-center text-white z-10">
            <h1 class="text-4xl sm:text-5xl font-bold">Selamat Datang di Bimbingan Belajar</h1>
            <p class="mt-4 text-xl sm:text-2xl font-light">Tempat terbaik untuk membantu Anda meraih impian akademik Anda!</p>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-semibold text-center text-[#FF2D20]">Tentang Kami</h2>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold text-[#FF2D20]">Tentang Bimbingan Belajar</h3>
                    <p class="mt-4 text-lg">
                        Bimbingan Belajar adalah lembaga pendidikan yang menyediakan layanan bimbingan belajar untuk
                        membantu siswa mempersiapkan ujian dan meningkatkan pemahaman mereka dalam berbagai mata pelajaran.
                        Kami berkomitmen untuk memberikan pengalaman belajar yang menyenangkan dan efektif untuk setiap
                        siswa.
                    </p>
                    <p class="mt-4 text-lg">
                        Dengan pengajaran yang terstruktur, pengajaran yang berpengalaman, dan metode yang sudah terbukti
                        efektif, kami siap membantu siswa mencapai tujuan akademik mereka.
                    </p>
                </div>
                <div>
                    <img src="{{ asset('images/bimbel.jpg') }}" alt="Bimbingan Belajar" class="rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Login & Register Links -->
    <section id="login" class="py-20 bg-gray-100 relative">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-semibold text-[#FF2D20]">Siap Bergabung?</h2>
            <p class="mt-4 text-lg">Masuk untuk memulai belajar</p>
            <div class="mt-8 flex justify-center space-x-6">
                <a href="{{ route('login') }}"
                    class="px-6 py-3 bg-[#207dff] text-white rounded-lg shadow-lg hover:bg-[#207dff] transition duration-300">Login</a>
            </div>
            <!-- Contact Person di sebelah bawah kanan -->
            <div class="absolute right-6 bottom-6 text-gray-600 text-sm">
                <p>📞 <strong>Contact Person:</strong> 0812-3456-7890</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-10 bg-[#FF2D20] text-white text-center">
        <p>&copy; 2024 Bimbingan Belajar. All Rights Reserved.</p>
    </footer>

</body>

</html>
