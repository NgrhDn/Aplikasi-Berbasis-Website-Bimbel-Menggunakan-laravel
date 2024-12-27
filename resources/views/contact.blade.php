<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Person - Bimbel Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <!-- Navbar -->
    <nav class="bg-[#FF2D20] shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-white text-2xl font-semibold">Bimbel Online</a>
            <div class="space-x-6">
                <a href="/" class="text-white hover:text-gray-300">Home</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-gray-300">Contact Person</a>
            </div>
        </div>
    </nav>

    <!-- Contact Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-semibold text-[#FF2D20]">Contact Person</h2>
            <p class="mt-4 text-lg">Berikut adalah informasi kontak kami. Jangan ragu untuk menghubungi kami:</p>

            <div class="mt-8 space-y-6">
                <div class="flex justify-center items-center">
                    <span class="mr-4 text-lg">📱 WhatsApp:</span>
                    <a href="https://wa.me/081234567890" target="_blank" class="text-blue-500 hover:underline">0812-3456-7890</a>
                </div>
                <div class="flex justify-center items-center">
                    <span class="mr-4 text-lg">📸 Instagram:</span>
                    <a href="https://www.instagram.com/bimbinganbelajar" target="_blank" class="text-blue-500 hover:underline">@bimbinganbelajar</a>
                </div>
                <div class="flex justify-center items-center">
                    <span class="mr-4 text-lg">📘 Facebook:</span>
                    <a href="https://www.facebook.com/bimbinganbelajar" target="_blank" class="text-blue-500 hover:underline">
                        <i class="fab fa-facebook-square mr-2"></i>Bimbingan Belajar
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-10 bg-[#FF2D20] text-white text-center">
        <p>&copy; 2024 Bimbel Online. All Rights Reserved.</p>
    </footer>

</body>
</html>
