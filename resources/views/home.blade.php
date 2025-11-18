@extends('layouts.app')

@section('title', 'Beranda - SD Muhammadiyah Gendeng')
@section('meta_description', 'SD Muhammadiyah Gendeng - Membentuk Generasi Cerdas & Berkarakter dengan pendidikan berkualitas dan fasilitas modern.')

@section('content')
<div class="pt-20">
    {{-- Hero Section --}}
    <section class="relative min-h-[85vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-white via-red-50/30 to-white">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, #B91C1C 1px, transparent 0); background-size: 48px 48px;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid lg:grid-cols-2 gap-12 items-center">
            {{-- Text Content --}}
            <div class="text-center lg:text-left" data-aos="fade-right">
                <div class="inline-block mb-4 px-4 py-2 bg-red-50 rounded-full border border-red-100">
                    <span class="text-[#B91C1C]">Selamat Datang di SD Muhammadiyah Gendeng</span>
                </div>

                <h1 class="text-gray-900 leading-tight text-center md:text-left">
                    <span class="block text-5xl my-3 font-bold">Happy School</span>
                    <span class="block text-[#B91C1C] text-3xl font-semibold">
                        happy to learn and happy to grow
                    </span>
                </h1>
                <p class="text-gray-600 mb-8 max-w-lg mx-auto lg:mx-0">
                    Mengembangkan potensi anak dengan pembelajaran berkualitas, fasilitas modern, dan pendekatan yang penuh kasih sayang.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('ppdb') }}" class="px-8 py-4 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-all duration-300 shadow-lg shadow-red-200 hover:shadow-xl hover:shadow-red-300 text-center">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('about') }}" class="px-8 py-4 border-2 border-gray-200 text-gray-700 rounded-lg hover:border-[#B91C1C] hover:text-[#B91C1C] transition-all duration-300 text-center">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            {{-- Image --}}
            <div class="relative" data-aos="fade-left">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1565373086464-c8af0d586c0c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxoYXBweSUyMGNoaWxkcmVuJTIwc2Nob29sfGVufDF8fHx8MTc2MzI4MTYwOXww&ixlib=rb-4.1.0&q=80&w=1080" 
                         alt="Happy children at school" 
                         class="w-full h-[500px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>

                {{-- Floating Stats --}}
                <div class="absolute -bottom-8 left-8 right-8 bg-white rounded-xl shadow-xl p-6 grid grid-cols-3 gap-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center">
                        <div class="text-[#B91C1C] font-bold text-2xl">500+</div>
                        <div class="text-sm text-gray-600">Siswa</div>
                    </div>
                    <div class="text-center border-x border-gray-200">
                        <div class="text-[#B91C1C] font-bold text-2xl">25+</div>
                        <div class="text-sm text-gray-600">Guru</div>
                    </div>
                    <div class="text-center">
                        <div class="text-[#B91C1C] font-bold text-2xl">A</div>
                        <div class="text-sm text-gray-600">Akreditasi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Program Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-gray-900 mb-4">Program & Kegiatan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Beragam program yang dirancang untuk mengembangkan potensi siswa secara holistik
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                @php
                $programs = [
                    [
                        'icon' => '📚',
                        'title' => 'Literasi & Numerasi',
                        'description' => 'Program membaca dan berhitung yang menyenangkan dengan metode interaktif',
                        'image' => 'https://images.unsplash.com/photo-1607823477653-e2c3980acb86?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxjaGlsZHJlbiUyMHJlYWRpbmclMjBib29rcyUyMGxpYnJhcnl8ZW58MXx8fHwxNzYzNDYwNjA0fDA&ixlib=rb-4.1.0&q=80&w=1080'
                    ],
                    [
                        'icon' => '🏆',
                        'title' => 'Pendidikan Karakter',
                        'description' => 'Membentuk karakter siswa melalui kegiatan pembiasaan dan keteladanan',
                        'image' => 'https://images.unsplash.com/photo-1565373086464-c8af0d586c0c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxoYXBweSUyMGNoaWxkcmVuJTIwc2Nob29sfGVufDF8fHx8MTc2MzI4MTYwOXww&ixlib=rb-4.1.0&q=80&w=1080'
                    ],
                    [
                        'icon' => '🎨',
                        'title' => 'Ekstrakurikuler',
                        'description' => 'Seni, olahraga, musik, dan berbagai kegiatan pengembangan minat bakat',
                        'image' => 'https://images.unsplash.com/photo-1630077852169-3900cc6f4f37?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxjaGlsZHJlbiUyMGFydCUyMGNsYXNzJTIwcGFpbnRpbmd8ZW58MXx8fHwxNzYzMzMyODkwfDA&ixlib=rb-4.1.0&q=80&w=1080'
                    ]
                ];
                @endphp

                @foreach($programs as $index => $program)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $program['image'] }}" 
                             alt="{{ $program['title'] }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4">
                            <div class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-lg flex items-center justify-center text-2xl">
                                {{ $program['icon'] }}
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-gray-900 mb-2">{{ $program['title'] }}</h4>
                        <p class="text-gray-600 text-sm">{{ $program['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center" data-aos="fade-up">
                <a href="{{ route('programs') }}" class="inline-flex items-center px-8 py-3 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-all duration-300 shadow-lg shadow-red-200">
                    Lihat Semua Program
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Prestasi Section --}}
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-gray-900 mb-4">Prestasi Membanggakan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Berbagai pencapaian yang telah diraih siswa-siswi kami
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 text-center" data-aos="fade-up">
                    <div class="w-16 h-16 bg-yellow-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🏆</span>
                    </div>
                    <div class="text-[#B91C1C] font-bold text-3xl mb-2">50+</div>
                    <p class="text-gray-600">Total Prestasi</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-[#B91C1C] rounded-xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🥇</span>
                    </div>
                    <div class="text-[#B91C1C] font-bold text-3xl mb-2">15</div>
                    <p class="text-gray-600">Tingkat Nasional</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-amber-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🥈</span>
                    </div>
                    <div class="text-[#B91C1C] font-bold text-3xl mb-2">20</div>
                    <p class="text-gray-600">Tingkat Provinsi</p>
                </div>
            </div>

            <div class="text-center" data-aos="fade-up">
                <a href="{{ route('achievements') }}" class="inline-flex items-center px-8 py-3 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-all duration-300 shadow-lg shadow-red-200">
                    Lihat Semua Prestasi
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Fasilitas Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-gray-900 mb-4">Fasilitas Lengkap & Modern</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Mendukung proses pembelajaran yang optimal dan menyenangkan
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @php
                $facilities = [
                    ['name' => 'Perpustakaan Digital', 'icon' => '📚'],
                    ['name' => 'Lab IPA', 'icon' => '🔬'],
                    ['name' => 'Ruang Multimedia', 'icon' => '💻'],
                    ['name' => 'Kolam Renang', 'icon' => '🏊']
                ];
                @endphp

                @foreach($facilities as $index => $facility)
                <div class="bg-gradient-to-br from-red-50 to-white p-6 rounded-2xl border border-red-100 text-center hover:shadow-lg transition-shadow" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                    <div class="text-4xl mb-3">{{ $facility['icon'] }}</div>
                    <p class="text-gray-900">{{ $facility['name'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="text-center" data-aos="fade-up">
                <a href="{{ route('facilities') }}" class="inline-flex items-center px-8 py-3 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-all duration-300 shadow-lg shadow-red-200">
                    Lihat Semua Fasilitas
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- PPDB CTA Section --}}
    <section class="py-20 bg-gradient-to-br from-[#B91C1C] to-[#991B1B] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-aos="fade-up">
                <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <span class="text-5xl">👥</span>
                </div>
                <h2 class="text-white mb-4">Informasi PPDB </h2>
                <p class="text-red-50 mb-8 max-w-2xl mx-auto">
                    Daftarkan putra-putri Anda sekarang dan berikan mereka pendidikan terbaik untuk masa depan yang cerah.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('ppdb') }}" class="inline-flex items-center px-8 py-4 bg-white text-[#B91C1C] rounded-lg hover:bg-gray-50 transition-all duration-300 shadow-lg">
                        Informasi Lengkap PPDB
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="#" class="inline-flex items-center px-8 py-4 border-2 border-white text-white rounded-lg hover:bg-white/10 transition-all duration-300">
                        Download Brosur
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
