<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SD Muhammadiyah Gendeng</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="relative min-h-screen">
    <!-- Navbar -->
    <nav class="relative z-20 bg-gray-800/50 backdrop-blur">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Logo"
                        class="h-8 w-auto" />
                    <span class="ml-3 text-white font-semibold text-lg">SD Muhammadiyah Gendeng</span>
                </div>

                <!-- Menu -->
                <div class="hidden sm:flex space-x-4">
                    <a href="#" class="rounded-md bg-gray-900/50 px-3 py-2 text-sm font-medium text-white">Home</a>
                    <a href="#"
                        class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                        Program Kegiatan
                    </a>

                    <!-- Dropdown Informasi -->
                    <div class="relative group flex items-center">
                        <a href="#"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                            Informasi
                        </a>
                        <!-- Dropdown -->
                        <div
                            class="absolute left-0 mt-16 w-48 bg-white rounded-md shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-200 z-50">
                            <a href="#prestasi"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Prestasi</a>
                            <a href="#ppdb" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Informasi
                                PPDB</a>
                        </div>
                    </div>


                    <a href="#"
                        class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                        Tentang Kami
                    </a>
                    <a href="#"
                        class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                        Layanan Pengaduan
                    </a>
                </div>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <main class="relative z-10 flex flex-col items-center justify-center text-center py-24 min-h-[70vh]">
        <h1 class="text-7xl font-extrabold text-white drop-shadow-lg">Selamat Datang</h1>
        <h2 class="mt-4 text-3xl font-semibold text-white drop-shadow-lg">SD MUHAMMADIYAH GENDENG</h2>
    </main>

    <!-- Background Image -->
    <div class="absolute inset-0 -z-10">
        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
            alt="Background Sekolah" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <!-- Sambutan Kepala Sekolah -->
    <section class="relative z-10 bg-white py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 flex flex-col md:flex-row items-center gap-10">
            <!-- Foto Kepala Sekolah -->
            <div class="flex-shrink-0 w-full md:w-1/3 flex justify-center">
                <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=500&q=80"
                    alt="Kepala Sekolah" class="rounded-2xl shadow-lg w-80 h-auto object-cover">
            </div>

            <!-- Teks Sambutan -->
            <div class="w-full md:w-2/3 text-gray-800">
                <h3 class="text-3xl font-bold mb-4 text-gray-900">Sambutan Kepala Sekolah</h3>
                <p class="text-lg leading-relaxed mb-4">
                    Assalamu’alaikum warahmatullahi wabarakatuh.
                </p>
                <p class="text-lg leading-relaxed mb-4">
                    Puji syukur kita panjatkan ke hadirat Allah SWT atas limpahan rahmat dan karunia-Nya.
                    SD Muhammadiyah Gendeng berkomitmen untuk menjadi lembaga pendidikan yang unggul dalam
                    pembentukan karakter Islami, penguasaan ilmu pengetahuan, dan pengembangan potensi siswa.
                </p>
                <p class="text-lg leading-relaxed mb-4">
                    Kami berupaya menciptakan lingkungan belajar yang menyenangkan, kreatif, dan berakhlak
                    mulia agar setiap peserta didik dapat tumbuh menjadi generasi yang beriman, cerdas, dan peduli.
                </p>
                <p class="text-lg leading-relaxed font-semibold">
                    Wassalamu’alaikum warahmatullahi wabarakatuh.<br>
                    <span class="block mt-2 text-gray-700">Kepala Sekolah</span>
                    <span class="block text-indigo-700 font-bold">Nama Kepala Sekolah</span>
                </p>
            </div>
        </div>
    </section>

    <!-- VISI & MISI Section -->
    <!-- VISI & MISI Section -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-10">VISI & MISI</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-left">
                <!-- VISI -->
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4 text-center md:text-left">VISI</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged.
                    </p>
                </div>

                <!-- MISI (geser sedikit ke kanan) -->
                <div class="md:pl-20">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4 text-center md:text-left">MISI</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries
                </div>
            </div>
        </div>
    </section>

    <!-- SEJARAH SEKOLAH Section -->
    <section class="bg-white py-16">
        <div class="max-w-6xl mx-auto px-6 text-left">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">SEJARAH SEKOLAH</h2>
            <p class="text-gray-700 leading-relaxed mb-10">
                Lorem Ipsum contrary to popular belief, Lorem Ipsum is not simply random text.
                It has roots in a piece of classical Latin literature from 45 BC, making it over
                2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College
                in Virginia, looked up one of the more obscure Latin words, consectetur, from a
                Lorem Ipsum passage, and going through the cites of the word in classical literature,
                discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33
                of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written
                in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.
                The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
            </p>

            <!-- Dua Foto -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div
                    class="bg-gray-300 flex items-center justify-center h-64 rounded-lg shadow-inner text-gray-700 font-semibold">
                    FOTO SEKOLAH
                </div>
                <div
                    class="bg-gray-300 flex items-center justify-center h-64 rounded-lg shadow-inner text-gray-700 font-semibold">
                    FOTO SEKOLAH
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->



    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-300 py-10">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">

            <!-- Alamat Sekolah -->
            <div>
                <h3 class="text-xl font-semibold text-white mb-4">Alamat Sekolah</h3>
                <p class="text-gray-400 leading-relaxed">
                    SD Muhammadiyah Gendeng<br>
                    Jl. Gendeng No. 15, Baciro, Gondokusuman,<br>
                    Kota Yogyakarta, Daerah Istimewa Yogyakarta 55225
                </p>
            </div>

            <!-- Kontak Kami -->
            <div>
                <h3 class="text-xl font-semibold text-white mb-4">Kontak Kami</h3>
                <p class="text-gray-400">Telepon: (0274) 123456</p>
                <p class="text-gray-400 mb-2">Email: info@sdmuhgendeng.sch.id</p>
                <p class="text-gray-400">
                    WhatsApp:
                    <a href="https://wa.me/6281234567890" target="_blank"
                        class="text-green-400 hover:text-green-500 font-medium">
                        +62 812-3456-7890
                    </a>
                </p>
            </div>

            <!-- Sosial Media -->
            <div>
                <h3 class="text-xl font-semibold text-white mb-4">Sosial Media</h3>
                <div class="flex space-x-6 text-2xl">
                    <a href="#" class="hover:text-blue-500 transition transform hover:scale-110">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                    <a href="#" class="hover:text-pink-500 transition transform hover:scale-110">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="hover:text-red-500 transition transform hover:scale-110">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="mt-10 border-t border-gray-700 pt-6 text-center text-gray-500 text-sm">
            © 2025 SD Muhammadiyah Gendeng. All Rights Reserved.
        </div>
    </footer>



</body>

</html>