@extends('layouts.app')

@section('title', 'Fasilitas - SD Muhammadiyah Gendeng')
@section('meta_description', 'Fasilitas lengkap dan modern SD Muhammadiyah Gendeng untuk mendukung proses pembelajaran yang optimal')

@section('content')
<div class="pt-20">
    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-[#B91C1C] to-[#991B1B] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-white mb-4">Fasilitas Sekolah</h1>
                <p class="text-red-100 max-w-2xl mx-auto">
                    Dilengkapi dengan fasilitas modern dan lengkap untuk mendukung proses pembelajaran yang optimal dan menyenangkan.
                </p>
            </div>
        </div>
    </section>

    {{-- Facilities Grid --}}
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($fasilitas->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada fasilitas</h3>
                    <p class="mt-1 text-sm text-gray-500">Data fasilitas akan segera ditambahkan.</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($fasilitas as $index => $facility)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                            {{-- Image --}}
                            <div class="relative h-48 overflow-hidden">
                                @if($facility->gambar)
                                    <img 
                                        src="{{ asset('storage/' . $facility->gambar) }}" 
                                        alt="{{ $facility->nama_fasilitas }}" 
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                    >
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            </div>

                            {{-- Content --}}
                            <div class="p-6">
                                <h4 class="text-gray-900 mb-2 text-lg font-semibold">{{ $facility->nama_fasilitas }}</h4>
                                <p class="text-gray-600 text-sm">{{ Str::limit($facility->deskripsi, 100) }}</p>
                            </div>

                            {{-- Hover Border --}}
                            <div class="absolute inset-0 border-2 border-transparent group-hover:border-[#B91C1C] rounded-2xl transition-colors duration-300 pointer-events-none"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

            {{-- Additional Features --}}
            @if(!empty($additionalFeatures))
            <div class="mt-16 grid md:grid-cols-3 gap-8" data-aos="fade-up" data-aos-delay="600">
                @foreach($additionalFeatures as $index => $feature)
                <div class="bg-white rounded-xl p-6 border-2 border-gray-100 text-center hover:shadow-lg transition-shadow" 
                     data-aos="zoom-in" 
                     data-aos-delay="{{ 700 + ($index * 100) }}">
                    <div class="text-[#B91C1C] mb-2 font-semibold text-lg">{{ $feature['name'] }}</div>
                    <p class="text-sm text-gray-600">{{ $feature['description'] }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- {{-- CTA Section --}}
    <section class="py-16 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 md:p-12 text-center border border-gray-100" data-aos="fade-up">
                <h3 class="text-gray-900 mb-4">Kunjungi Fasilitas Kami</h3>
                <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                    Lihat langsung fasilitas lengkap kami dan rasakan suasana belajar yang nyaman dan kondusif.
                </p>
                <a href="{{ route('ppdb') }}" class="inline-flex items-center px-8 py-3 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-colors shadow-lg shadow-red-200">
                    Jadwalkan Kunjungan
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section> -->
</div>
@endsection