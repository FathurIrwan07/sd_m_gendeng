<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SD Muhammadiyah Gendeng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Custom styles for smooth scroll behavior */
        html {
            scroll-behavior: smooth;
            font-family: 'Inter', sans-serif;
        }

        /* Ensure the body and elements use rounded corners */
        .rounded-element {
            border-radius: 0.5rem;
            /* Equivalent to rounded-lg */
        }
    </style>
</head>

<body class="relative min-h-screen bg-gray-100">

    <nav class="sticky top-0 z-20 bg-gray-800/80 backdrop-blur-md shadow-lg">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <img src="https://placehold.co/40x40/4F46E5/FFFFFF/png?text=SD" alt="Logo"
                        class="h-8 w-auto rounded-full bg-indigo-500 p-1" />
                    <span class="ml-3 text-white font-extrabold text-xl tracking-wider">SD Muhammadiyah Gendeng</span>
                </div>

                <button id="mobile-menu-button" class="sm:hidden text-white hover:text-indigo-400 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <div class="hidden sm:flex space-x-2 lg:space-x-4">
                    <a href="#"
                        class="rounded-lg bg-indigo-600 px-3 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition">Home</a>
                    <a href="#program"
                        class="rounded-lg px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white transition">
                        Program Kegiatan
                    </a>

                    <div class="relative group flex items-center">
                        <a href="#informasi"
                            class="rounded-lg px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white transition">
                            Informasi <i
                                class="fas fa-chevron-down text-xs ml-1 transition-transform duration-300 group-hover:rotate-180"></i>
                        </a>
                        <div
                            class="absolute left-0 mt-32 w-48 bg-white rounded-lg shadow-xl opacity-0 group-hover:opacity-100 invisible group-hover:visible transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 z-50 overflow-hidden">
                            <a href="#prestasi"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">Prestasi</a>
                            <a href="#ppdb"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">Informasi
                                PPDB</a>
                        </div>
                    </div>


                    <a href="#tentang-kami"
                        class="rounded-lg px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white transition">
                        Tentang Kami
                    </a>
                    <a href="{{ route('login') }}"
                        class="rounded-lg bg-green-500 px-3 py-2 text-sm font-medium text-white shadow-md hover:bg-green-600 transition transform hover:scale-105">
                        Layanan Pengaduan
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div id="mobile-menu"
        class="sm:hidden absolute top-16 left-0 right-0 z-50 bg-gray-900/95 backdrop-blur-sm hidden pb-4 shadow-xl">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#"
                class="block rounded-lg bg-indigo-700 px-3 py-2 text-base font-medium text-white transition">Home</a>
            <a href="#program"
                class="block rounded-lg px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white transition">Program
                Kegiatan</a>
            <a href="#prestasi"
                class="block rounded-lg px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white transition ml-4">
                &mdash; Prestasi</a>
            <a href="#ppdb"
                class="block rounded-lg px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white transition ml-4">
                &mdash; Informasi PPDB</a>
            <a href="#tentang-kami"
                class="block rounded-lg px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white transition">Tentang
                Kami</a>
            {{-- Mengubah href agar mengarah ke halaman login --}}
            <a href="{{ route('login') }}"
                class="block rounded-lg bg-green-500 px-3 py-2 text-base font-medium text-white shadow-md mt-2 transition">Layanan
                Pengaduan</a>
        </div>
    </div>


    <main class="relative z-10 flex flex-col items-center justify-center text-center py-24 min-h-[70vh] px-4">
        <h1 class="text-7xl sm:text-8xl font-extrabold text-white drop-shadow-2xl animate-pulse">Selamat Datang</h1>
        <h2 class="mt-4 text-3xl sm:text-4xl font-semibold text-white drop-shadow-xl">SD MUHAMMADIYAH GENDENG</h2>
        <a href="#sambutan"
            class="mt-8 px-6 py-3 bg-indigo-500 text-white font-semibold rounded-full shadow-lg hover:bg-indigo-600 transition transform hover:scale-105">
            Jelajahi Sekarang <i class="fas fa-arrow-down ml-2"></i>
        </a>
    </main>

    <div class="absolute inset-0 -z-10">
        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
            alt="Background Sekolah" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <section id="sambutan" class="relative z-10 bg-white py-16 rounded-t-3xl -mt-10 shadow-2xl">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 flex flex-col md:flex-row items-center gap-10">
            <div class="flex-shrink-0 w-full md:w-1/3 flex justify-center">
                <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=500&q=80"
                    alt="Kepala Sekolah"
                    class="rounded-3xl shadow-xl w-72 h-72 object-cover border-4 border-indigo-500/50">
            </div>

            <div class="w-full md:w-2/3 text-gray-800">
                <h3 class="text-4xl font-extrabold mb-4 text-gray-900 border-b-4 border-indigo-500 pb-2 inline-block">
                    Sambutan Kepala Sekolah</h3>
                <p class="text-lg leading-relaxed mb-4">
                    Assalamu’alaikum warahmatullahi wabarakatuh.
                </p>
                <p class="text-lg leading-relaxed mb-4">
                    Puji syukur kita panjatkan ke hadirat Allah SWT atas limpahan rahmat dan karunia-Nya.
                    SD Muhammadiyah Gendeng berkomitmen untuk menjadi lembaga pendidikan yang **unggul dalam
                    pembentukan karakter Islami**, penguasaan ilmu pengetahuan, dan pengembangan potensi siswa.
                </p>
                <p class="text-lg leading-relaxed mb-4 italic text-indigo-700">
                    Kami berupaya menciptakan lingkungan belajar yang menyenangkan, kreatif, dan berakhlak
                    mulia agar setiap peserta didik dapat tumbuh menjadi generasi yang beriman, cerdas, dan peduli.
                </p>
                <p class="text-lg leading-relaxed font-semibold">
                    Wassalamu’alaikum warahmatullahi wabarakatuh.<br>
                    <span class="block mt-4 text-gray-700">Kepala Sekolah</span>
                    <span class="block text-indigo-700 font-extrabold text-xl">Nama Kepala Sekolah</span>
                </p>
            </div>
        </div>
    </section>

    <section id="tentang-kami" class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-12">VISI & MISI</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 text-left">
                <div
                    class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-indigo-500 transform transition hover:shadow-xl">
                    <h3 class="text-3xl font-bold text-indigo-600 mb-4 text-center"><i class="fas fa-eye mr-2"></i> VISI
                    </h3>
                    <p class="text-gray-700 leading-relaxed text-base">
                        **Unggul dalam Ilmu dan Amal, Berbasis Nilai Keislaman dan Kemasyarakatan.** Kami bercita-cita
                        menjadi sekolah dasar terdepan yang menghasilkan lulusan berkarakter mulia, menguasai
                        dasar-dasar ilmu pengetahuan modern, serta memiliki kepedulian tinggi terhadap lingkungan dan
                        masyarakat.
                    </p>
                </div>

                <div
                    class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-green-500 transform transition hover:shadow-xl">
                    <h3 class="text-3xl font-bold text-green-600 mb-4 text-center"><i
                            class="fas fa-hand-holding-heart mr-2"></i> MISI</h3>
                    <ul class="list-disc pl-5 space-y-2 text-gray-700 text-base">
                        <li>Mengembangkan kurikulum yang memadukan IPTEK dan IMTAQ secara seimbang.</li>
                        <li>Menciptakan lingkungan belajar yang Islami, inovatif, dan menyenangkan.</li>
                        <li>Meningkatkan kompetensi pendidik dan tenaga kependidikan secara berkelanjutan.</li>
                        <li>Mengoptimalkan potensi dan bakat peserta didik melalui kegiatan ekstrakurikuler.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16" id="program">
        <div class="max-w-7xl mx-auto px-6 text-left">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">SEJARAH & GALERI</h2>
            <div class="lg:flex lg:space-x-12">

                <div class="lg:w-1/2 mb-10 lg:mb-0">
                    <h3 class="text-3xl font-semibold text-indigo-800 mb-4 border-l-4 border-indigo-500 pl-3">
                        Perjalanan Sekolah Kami</h3>
                    <p class="text-gray-700 leading-relaxed mb-6">
                        SD Muhammadiyah Gendeng didirikan pada tahun 1950, berawal dari semangat para tokoh Muhammadiyah
                        lokal untuk menyediakan pendidikan dasar berbasis Islam yang modern di kawasan Yogyakarta.
                        Sekolah ini bertumbuh seiring waktu, melewati berbagai tantangan dan terus beradaptasi dengan
                        perkembangan kurikulum nasional.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        Sejak awal, komitmen kami adalah mencetak generasi yang tidak hanya cerdas secara akademis,
                        tetapi juga memiliki fondasi akhlak yang kuat. Pembangunan gedung permanen pertama pada tahun
                        1970 menandai era baru, memungkinkan sekolah untuk menampung lebih banyak siswa dan
                        memperluas program kegiatan keagamaan dan seni.
                    </p>
                </div>

                <div class="lg:w-1/2">
                    <h3 class="text-3xl font-semibold text-indigo-800 mb-4 border-l-4 border-indigo-500 pl-3">Galeri
                        Kegiatan</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="h-48 rounded-xl overflow-hidden shadow-lg transform hover:scale-[1.02] transition duration-300">
                            <img src="https://placehold.co/400x300/6366F1/FFFFFF/png?text=Kegiatan+Ekstra"
                                alt="Foto Sekolah 1"
                                class="w-full h-full object-cover filter brightness-90 hover:brightness-100">
                        </div>
                        <div
                            class="h-48 rounded-xl overflow-hidden shadow-lg transform hover:scale-[1.02] transition duration-300">
                            <img src="https://placehold.co/400x300/4F46E5/FFFFFF/png?text=Siswa+Belajar"
                                alt="Foto Sekolah 2"
                                class="w-full h-full object-cover filter brightness-90 hover:brightness-100">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="ppdb" class="bg-indigo-700 py-16 text-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-extrabold mb-10 text-center border-b-2 border-white/50 pb-4">INFORMASI PPDB &
                PRESTASI</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div id="informasi" class="p-6 bg-indigo-800 rounded-xl shadow-2xl">
                    <h3 class="text-3xl font-bold mb-4 flex items-center"><i
                            class="fas fa-user-plus mr-3 text-green-400"></i> Pendaftaran Siswa Baru (PPDB)</h3>
                    <p class="mb-4 text-indigo-100">
                        Tahun Ajaran 2025/2026 telah dibuka. Segera daftarkan putra/putri Anda!
                    </p>
                    <ul class="list-disc pl-5 space-y-2 text-indigo-100">
                        <li>**Jadwal Pendaftaran:** 1 November - 31 Desember</li>
                        <li>**Syarat Dokumen:** Akta Kelahiran, Kartu Keluarga, Fotokopi KTP Orang Tua.</li>
                        <li>**Kontak PPDB:** +62 811-000-1234 (Bu Siti)</li>
                    </ul>
                    <button
                        class="mt-6 px-6 py-3 bg-green-500 text-white font-bold rounded-lg shadow-md hover:bg-green-600 transition">
                        Unduh Brosur PPDB
                    </button>
                </div>

                <div id="prestasi" class="p-6 bg-indigo-800 rounded-xl shadow-2xl">
                    <h3 class="text-3xl font-bold mb-4 flex items-center"><i
                            class="fas fa-trophy mr-3 text-yellow-400"></i>
                        Prestasi Terbaru</h3>
                    <div class="space-y-4">
                        <div class="bg-indigo-700 p-4 rounded-lg flex items-center">
                            <i class="fas fa-medal text-2xl text-yellow-400 mr-4"></i>
                            <div>
                                <p class="font-semibold text-lg">Juara 1 Lomba Tahfidz Quran (Tingkat Kota)</p>
                                <p class="text-sm text-indigo-200">Diraih oleh Ananda Ahmad Zaki, Kelas V</p>
                            </div>
                        </div>
                        <div class="bg-indigo-700 p-4 rounded-lg flex items-center">
                            <i class="fas fa-medal text-2xl text-yellow-400 mr-4"></i>
                            <div>
                                <p class="font-semibold text-lg">Medali Perak Olimpiade Sains Nasional (OSN)</p>
                                <p class="text-sm text-indigo-200">Kategori Matematika, Ananda Budi, Kelas VI</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION LOGIN/PENGADUAN DI SINI TELAH DIHAPUS --}}

    <footer class="bg-gray-900 text-gray-300 py-10 rounded-t-lg">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">

            <div>
                <h3 class="text-xl font-extrabold text-white mb-4 border-b border-indigo-500 pb-2">Alamat Sekolah</h3>
                <p class="text-gray-400 leading-relaxed">
                    SD Muhammadiyah Gendeng<br>
                    Jl. Gendeng No. 15, Baciro, Gondokusuman,<br>
                    Kota Yogyakarta, Daerah Istimewa Yogyakarta 55225
                </p>
            </div>

            <div>
                <h3 class="text-xl font-extrabold text-white mb-4 border-b border-indigo-500 pb-2">Kontak Kami</h3>
                <p class="text-gray-400">Telepon: (0274) 123456</p>
                <p class="text-gray-400 mb-2">Email: <a href="mailto:info@sdmuhgendeng.sch.id"
                        class="text-indigo-400 hover:text-indigo-300">info@sdmuhgendeng.sch.id</a></p>
                <p class="text-gray-400 flex items-center">
                    <i class="fab fa-whatsapp text-green-400 mr-2"></i> WhatsApp:
                    <a href="https://wa.me/6281234567890" target="_blank"
                        class="text-green-400 hover:text-green-500 font-medium ml-1">
                        +62 812-3456-7890
                    </a>
                </p>
            </div>

            <div>
                <h3 class="text-xl font-extrabold text-white mb-4 border-b border-indigo-500 pb-2">Sosial Media</h3>
                <div class="flex space-x-6 text-3xl">
                    <a href="#" class="text-gray-400 hover:text-blue-500 transition transform hover:scale-110"
                        aria-label="Facebook">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-pink-500 transition transform hover:scale-110"
                        aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition transform hover:scale-110"
                        aria-label="Youtube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="mt-10 border-t border-gray-700 pt-6 text-center text-gray-500 text-sm">
            © 2025 SD Muhammadiyah Gendeng. All Rights Reserved.
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const button = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            button.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });

            // Hide menu when an item is clicked (for navigation)
            const menuLinks = menu.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    // Cek jika link tidak mengarah ke route login (agar login page tidak tertutup otomatis jika sudah terbuka)
                    if (!link.getAttribute('href').includes('/login')) {
                        menu.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</body>

</html>