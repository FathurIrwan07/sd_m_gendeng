@extends('layouts.app')

@section('title', 'Prestasi - SD Negeri Harapan Bangsa')

@section('meta_description', 'Berbagai prestasi membanggakan yang telah diraih siswa-siswi SD Negeri Harapan Bangsa')

@section('content')
<div class="pt-20">
    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-[#B91C1C] to-[#991B1B] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-white mb-4">Prestasi Sekolah</h1>
                <p class="text-red-100 max-w-2xl mx-auto">
                    Berbagai pencapaian membanggakan yang telah diraih siswa-siswi kami di tingkat kota, provinsi, dan nasional.
                </p>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-12 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                @foreach($stats as $index => $stat)
                <div class="text-center p-6 bg-gradient-to-br from-red-50 to-white rounded-xl border border-red-100" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
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
            <div class="space-y-12">
                @foreach($achievements as $index => $achievement)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                        <div class="grid lg:grid-cols-2 gap-0">
                            {{-- Image --}}
                            <div class="relative h-72 lg:h-auto overflow-hidden">
                                <img 
                                    src="{{ $achievement['image'] }}" 
                                    alt="{{ $achievement['title'] }}" 
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                
                                {{-- Badge --}}
                                <div class="absolute top-6 left-6">
                                    <div class="w-16 h-16 {{ $achievement['color'] }} rounded-xl flex items-center justify-center shadow-lg">
                                        <span class="text-3xl">{{ $achievement['icon'] }}</span>
                                    </div>
                                </div>

                                {{-- Year Badge --}}
                                <div class="absolute bottom-6 left-6">
                                    <span class="px-4 py-2 bg-white/90 backdrop-blur-sm text-[#B91C1C] rounded-full font-semibold">
                                        {{ $achievement['year'] }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-8 lg:p-10 flex flex-col justify-center">
                                <span class="inline-block px-3 py-1 bg-red-50 text-[#B91C1C] rounded-full text-sm mb-4 w-fit font-medium">
                                    {{ $achievement['level'] }}
                                </span>
                                <h3 class="text-gray-900 mb-3">{{ $achievement['title'] }}</h3>
                                <p class="text-gray-600 mb-4">{{ $achievement['description'] }}</p>
                                <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                                    <div class="w-10 h-10 bg-gradient-to-br from-[#B91C1C] to-[#991B1B] rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Peraih</p>
                                        <p class="text-gray-900 font-medium">{{ $achievement['student'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div data-aos="fade-up">
                <h2 class="text-gray-900 mb-4">Raih Prestasi Bersama Kami</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                    Bergabunglah dengan SD Harapan Bangsa dan kembangkan potensi terbaik putra-putri Anda untuk meraih prestasi gemilang.
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
