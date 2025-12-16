@extends('layouts.app')

@section('title', 'Beranda - SD Muhammadiyah Gendeng')
@section('meta_description', 'SD Muhammadiyah Gendeng - Membentuk Generasi Cerdas & Berkarakter dengan pendidikan berkualitas dan fasilitas modern.')

@section('content')
    <div class="pt-20">
        <section class="relative min-h-[85vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-white via-red-50/30 to-white">

            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle at 2px 2px, #B91C1C 1px, transparent 0); background-size: 48px 48px;">
                </div>
            </div>

            <div class="relative w-full max-w-[1400px] mx-auto px-6 sm:px-8 lg:px-12 py-16 lg:py-20">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                    {{-- TEXT SECTION --}}
                    <div class="text-center lg:text-left space-y-5" data-aos="fade-right">
                        <div class="inline-block mb-1 px-4 py-2 bg-red-50 rounded-full border border-red-100">
                            <span class="text-[#B91C1C] font-medium text-sm">Selamat Datang di SD Muhammadiyah Gendeng</span>
                        </div>

                        <h1 class="text-gray-900 leading-tight text-center lg:text-left">
                            <span class="block text-4xl lg:text-5xl xl:text-6xl my-3 font-bold">Happy School</span>
                            <span class="block text-[#B91C1C] text-2xl lg:text-3xl xl:text-4xl font-semibold">
                                happy to learn and happy to grow
                            </span>
                        </h1>

                        <p class="text-gray-600 text-sm lg:text-base mb-6 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Mengembangkan potensi anak dengan pembelajaran berkualitas, fasilitas modern, dan pendekatan
                            yang penuh kasih sayang.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start pt-2">
                            <a href="{{ route('ppdb') }}"
                                class="px-8 py-3 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-all duration-300 shadow-lg shadow-red-200 hover:shadow-xl hover:shadow-red-300 text-center font-semibold">
                                Daftar Sekarang
                            </a>
                            <a href="{{ route('about') }}"
                                class="px-8 py-3 border-2 border-gray-200 text-gray-700 rounded-lg hover:border-[#B91C1C] hover:text-[#B91C1C] transition-all duration-300 text-center font-semibold">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>

                    {{-- IMAGE SECTION --}}
                    <div class="relative lg:pl-8" data-aos="fade-left">

                        {{-- Main Image Container --}}
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                            <img src="{{ asset('template/img/sekolah.jpg') }}" alt="Gambar Bangunan Sekolah"
                                class="w-full h-[400px] lg:h-[450px] xl:h-[500px] object-cover object-center">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>

                        {{-- Stats Card Over Image --}}
                        <div class="absolute -bottom-6 lg:-bottom-8 left-1/2 -translate-x-1/2 w-[90%] lg:w-[85%]">
                            <div class="bg-white rounded-2xl shadow-2xl p-5 lg:p-6">
                                <div class="grid grid-cols-3 gap-3 lg:gap-5">

                                    <div class="text-center">
                                        <div class="text-[#B91C1C] font-bold text-xl lg:text-2xl mb-1">
                                            {{ $totalPrestasi }}+</div>
                                        <div class="text-xs lg:text-sm text-gray-600">Prestasi</div>
                                    </div>

                                    <div class="text-center border-x border-gray-200">
                                        <div class="text-[#B91C1C] font-bold text-xl lg:text-2xl mb-1">{{ $totalGuru }}+
                                        </div>
                                        <div class="text-xs lg:text-sm text-gray-600">Guru</div>
                                    </div>

                                    <div class="text-center">
                                        <div class="text-[#B91C1C] font-bold text-xl lg:text-2xl mb-1">A</div>
                                        <div class="text-xs lg:text-sm text-gray-600">Akreditasi</div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        {{-- Program Section - 3 Unggulan --}}
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-gray-900 mb-4">Program & Kegiatan Unggulan</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Beragam program yang dirancang untuk mengembangkan potensi siswa secara holistik
                    </p>
                </div>

                @if($programUnggulan->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                        @foreach($programUnggulan as $index => $program)
                            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300"
                                data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                <div class="relative h-48 overflow-hidden">
                                    @if($program->foto_program)
                                        <img src="{{ Storage::url($program->foto_program) }}" alt="{{ $program->nama_program }}"
                                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center">
                                            <span class="text-6xl">📚</span>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4">
                                        <div
                                            class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-lg flex items-center justify-center text-2xl">
                                            @if($program->kategori)
                                                {{ $program->kategori->icon ?? '📚' }}
                                            @else
                                                📚
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h4 class="text-gray-900 mb-2">{{ $program->nama_program }}</h4>
                                    <p class="text-gray-600 text-sm line-clamp-2">{{ Str::limit($program->deskripsi, 100) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500">Belum ada program yang ditampilkan</p>
                    </div>
                @endif

                <div class="text-center" data-aos="fade-up">
                    <a href="{{ route('programs') }}"
                        class="inline-flex items-center px-8 py-3 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-all duration-300 shadow-lg shadow-red-200">
                        Lihat Semua Program
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        {{-- Prestasi Section - Dynamic with Priority --}}
        <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-gray-900 mb-4">Prestasi Membanggakan</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Berbagai pencapaian yang telah diraih siswa-siswi kami
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6 mb-8">
                    @foreach($prestasiStats as $index => $stat)
                        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 text-center" data-aos="fade-up"
                            data-aos-delay="{{ $index * 100 }}">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <span class="text-3xl">{{ $stat['icon'] }}</span>
                            </div>
                            <div class="text-[#B91C1C] font-bold text-3xl mb-2">{{ $stat['value'] }}</div>
                            <p class="text-gray-600">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="text-center" data-aos="fade-up">
                    <a href="{{ route('achievements') }}"
                        class="inline-flex items-center px-8 py-3 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-all duration-300 shadow-lg shadow-red-200">
                        Lihat Semua Prestasi
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        {{-- Fasilitas Section - Dynamic (No Images) --}}
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-gray-900 mb-4">Fasilitas Lengkap & Modern</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Mendukung proses pembelajaran yang optimal dan menyenangkan
                    </p>
                </div>

                @if($fasilitas->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        @foreach($fasilitas as $index => $item)
                            <div class="bg-gradient-to-br from-red-50 to-white p-6 rounded-2xl border border-red-100 text-center hover:shadow-lg transition-shadow"
                                data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                                <div class="text-4xl mb-3">🏫</div>
                                <p class="text-gray-900 font-medium">{{ $item->nama_fasilitas }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500">Belum ada fasilitas yang ditampilkan</p>
                    </div>
                @endif

                <div class="text-center" data-aos="fade-up">
                    <a href="{{ route('facilities') }}"
                        class="inline-flex items-center px-8 py-3 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-all duration-300 shadow-lg shadow-red-200">
                        Lihat Semua Fasilitas
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        {{-- PPDB CTA Section - Dynamic with SweetAlert --}}
        <section class="py-20 bg-gradient-to-br from-[#B91C1C] to-[#991B1B] text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center" data-aos="fade-up">
                    <div
                        class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-5xl">👥</span>
                    </div>
                    <h2 class="text-white mb-4">Informasi PPDB</h2>
                    <p class="text-red-50 mb-8 max-w-2xl mx-auto">
                        Daftarkan putra-putri Anda sekarang dan berikan mereka pendidikan terbaik untuk masa depan yang
                        cerah.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('ppdb') }}"
                            class="inline-flex items-center px-8 py-4 bg-white text-[#B91C1C] rounded-lg hover:bg-gray-50 transition-all duration-300 shadow-lg">
                            Informasi Lengkap PPDB
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        @if($infoPpdb && $infoPpdb->gambar_brosur)
                            <a href="{{ Storage::url($infoPpdb->gambar_brosur) }}" download
                                class="inline-flex items-center px-8 py-4 border-2 border-white text-white rounded-lg hover:bg-white/10 transition-all duration-300">
                                Download Brosur
                            </a>
                        @else
                            <button onclick="showBrosurAlert()"
                                class="inline-flex items-center px-8 py-4 border-2 border-white text-white rounded-lg hover:bg-white/10 transition-all duration-300">
                                Download Brosur
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- SweetAlert Script --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function showBrosurAlert() {
                Swal.fire({
                    icon: 'info',
                    title: 'Brosur Tidak Tersedia',
                    text: 'Maaf, brosur PPDB belum tersedia untuk diunduh. Silakan hubungi admin untuk informasi lebih lanjut.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#B91C1C'
                });
            }
        </script>
    @endpush
@endsection