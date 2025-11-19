@extends('layouts.app')

@section('title', 'Prestasi - SD Muhammadiyah Gendeng')
@section('meta_description', 'Berbagai prestasi membanggakan yang telah diraih siswa-siswi SD Muhammadiyah Gendeng')

@section('content')
<div class="pt-20">
    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-[#B91C1C] to-[#991B1B] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-white mb-4">Prestasi Sekolah</h1>
                <p class="text-red-100 max-w-2xl mx-auto">
                    Berbagai pencapaian membanggakan yang telah diraih siswa-siswi kami di tingkat kecamatan, kota, provinsi, nasional, dan internasional.
                </p>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-12 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                @foreach($stats as $index => $stat)
                <div class="text-center p-6 bg-gradient-to-br from-red-50 to-white rounded-xl border border-red-100" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 100 }}">
                    <div class="text-[#B91C1C] mb-2 font-bold text-3xl">{{ $stat['value'] }}</div>
                    <div class="text-gray-600">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Achievements List --}}
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($prestasi->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada prestasi</h3>
                    <p class="mt-1 text-sm text-gray-500">Data prestasi akan segera ditambahkan.</p>
                </div>
            @else
                <div class="space-y-12">
                    @foreach($prestasi as $index => $achievement)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                            <div class="grid lg:grid-cols-2 gap-0">
                                {{-- Image --}}
                                <div class="relative h-72 lg:h-auto overflow-hidden">
                                    @if($achievement->gambar)
                                        <img 
                                            src="{{ asset('storage/' . $achievement->gambar) }}" 
                                            alt="{{ $achievement->judul_prestasi }}" 
                                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                        >
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    
                                    {{-- Badge Icon --}}
                                    <div class="absolute top-6 left-6">
                                        <div class="w-16 h-16 {{ $achievement->tingkat_prestasi === 'Internasional' ? 'bg-gradient-to-br from-yellow-400 to-yellow-600' : ($achievement->tingkat_prestasi === 'Nasional' ? 'bg-gradient-to-br from-blue-500 to-blue-700' : ($achievement->tingkat_prestasi === 'Provinsi' ? 'bg-gradient-to-br from-green-500 to-green-700' : 'bg-gradient-to-br from-purple-500 to-purple-700')) }} rounded-xl flex items-center justify-center shadow-lg">
                                            <span class="text-3xl">
                                                @if($achievement->tingkat_prestasi === 'Internasional')
                                                    🌍
                                                @elseif($achievement->tingkat_prestasi === 'Nasional')
                                                    🏆
                                                @elseif($achievement->tingkat_prestasi === 'Provinsi')
                                                    🥇
                                                @else
                                                    🎖️
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Year Badge --}}
                                    @if($achievement->tanggal)
                                    <div class="absolute bottom-6 left-6">
                                        <span class="px-4 py-2 bg-white/90 backdrop-blur-sm text-[#B91C1C] rounded-full font-semibold">
                                            {{ $achievement->tanggal->format('Y') }}
                                        </span>
                                    </div>
                                    @endif
                                </div>

                                {{-- Content --}}
                                <div class="p-8 lg:p-10 flex flex-col justify-center">
                                    <span class="inline-block px-3 py-1 bg-red-50 text-[#B91C1C] rounded-full text-sm mb-4 w-fit font-medium">
                                        {{ $achievement->tingkat_prestasi }}
                                    </span>
                                    <h3 class="text-gray-900 mb-3">{{ $achievement->judul_prestasi }}</h3>
                                    <p class="text-gray-600 mb-4">{{ $achievement->deskripsi }}</p>
                                    
                                    @if($achievement->tanggal)
                                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $achievement->tanggal->isoFormat('D MMMM Y') }}</span>
                                    </div>
                                    @endif

                                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                                        <div class="w-10 h-10 bg-gradient-to-br from-[#B91C1C] to-[#991B1B] rounded-full flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Peraih Prestasi</p>
                                            <p class="text-gray-900 font-medium">{{ $achievement->nama_peraih }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div data-aos="fade-up">
                <h2 class="text-gray-900 mb-4">Raih Prestasi Bersama Kami</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                    Bergabunglah dengan SD Muhammadiyah Gendeng dan kembangkan potensi terbaik putra-putri Anda untuk meraih prestasi gemilang.
                </p>
                <a href="{{ route('ppdb') }}" class="inline-flex items-center px-8 py-4 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-all duration-300 shadow-lg shadow-red-200">
                    Daftar Sekarang
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</div>
@endsection