@extends('layouts.app')

@section('title', 'Tenaga Pendidik - SD Muhammadiyah Gendeng')
@section('meta_description', 'Tenaga pendidik profesional dan berpengalaman SD Muhammadiyah Gendeng')

@section('content')
<div class="pt-20">
    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-[#B91C1C] to-[#991B1B] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-white mb-4">Tenaga Pendidik</h1>
                <p class="text-red-100 max-w-2xl mx-auto">
                    Didukung oleh tenaga pendidik profesional, berpengalaman, dan berdedikasi tinggi dalam mendidik generasi bangsa.
                </p>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="py-12 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($stats as $index => $stat)
                <div class="bg-gradient-to-br from-red-50 to-white p-8 rounded-2xl border border-red-100 text-center" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 100 }}">
                    <div class="text-[#B91C1C] mb-2 font-bold text-3xl">{{ $stat['value'] }}</div>
                    <p class="text-gray-600">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Teachers Grid --}}
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($tenagaPendidik->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data tenaga pendidik</h3>
                    <p class="mt-1 text-sm text-gray-500">Data tenaga pendidik akan segera ditambahkan.</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($tenagaPendidik as $index => $teacher)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ ($index % 6) * 50 }}">
                        <div class="relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                            {{-- Photo --}}
                            <div class="relative h-64 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                @if($teacher->foto_tenaga_pendidik)
                                    <img 
                                        src="{{ asset('storage/' . $teacher->foto_tenaga_pendidik) }}" 
                                        alt="{{ $teacher->nama_lengkap }}" 
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300">
                                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                
                                {{-- Position Badge --}}
                                <div class="absolute bottom-4 left-4 right-4">
                                    <span class="inline-block px-3 py-1 bg-[#B91C1C] text-white rounded-full text-sm">
                                        {{ $teacher->jabatan }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-6">
                                <h4 class="text-gray-900 mb-2">{{ $teacher->nama_lengkap }}</h4>
                                
                                @if($teacher->lulusan)
                                <p class="text-sm text-gray-600 mb-4">{{ $teacher->lulusan }}</p>
                                @endif

                                {{-- Details --}}
                                <div class="space-y-2 pt-4 border-t border-gray-100">
                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <svg class="w-4 h-4 text-[#B91C1C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $teacher->jabatan }}</span>
                                    </div>
                                    
                                    @if($teacher->lulusan)
                                    <div class="flex items-start gap-2 text-sm text-gray-600">
                                        <svg class="w-4 h-4 text-[#B91C1C] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                        </svg>
                                        <span class="line-clamp-2">{{ $teacher->lulusan }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Hover Border --}}
                            <div class="absolute inset-0 border-2 border-transparent group-hover:border-[#B91C1C] rounded-2xl transition-colors duration-300 pointer-events-none"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Leadership Section (Optional - Show Kepala Sekolah & Wakil) --}}
    @php
        $leadership = $tenagaPendidik->filter(function($item) {
            return str_contains(strtolower($item->jabatan), 'kepala sekolah') || 
                   str_contains(strtolower($item->jabatan), 'wakil');
        });
    @endphp

    @if($leadership->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-gray-900 mb-4">Pimpinan Sekolah</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Tim kepemimpinan yang berpengalaman dan berdedikasi untuk kemajuan pendidikan.
                </p>
            </div>

            <div class="grid md:grid-cols-{{ min($leadership->count(), 3) }} gap-8 max-w-5xl mx-auto">
                @foreach($leadership as $index => $leader)
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 border border-gray-100 text-center" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 100 }}">
                    <div class="relative w-32 h-32 mx-auto mb-4">
                        @if($leader->foto_tenaga_pendidik)
                            <img 
                                src="{{ asset('storage/' . $leader->foto_tenaga_pendidik) }}" 
                                alt="{{ $leader->nama_lengkap }}"
                                class="w-full h-full object-cover rounded-full border-4 border-white shadow-lg"
                            >
                        @else
                            <div class="w-full h-full rounded-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center border-4 border-white shadow-lg">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2">
                            <span class="px-3 py-1 bg-[#B91C1C] text-white rounded-full text-xs">
                                {{ $leader->jabatan }}
                            </span>
                        </div>
                    </div>
                    <h4 class="text-gray-900 mb-2 mt-4">{{ $leader->nama_lengkap }}</h4>
                    @if($leader->lulusan)
                    <p class="text-sm text-gray-600">{{ $leader->lulusan }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-16 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 md:p-12 text-center border border-gray-100" data-aos="fade-up">
                <h3 class="text-gray-900 mb-4">Bergabung dengan Tim Kami</h3>
                <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                    Kami selalu terbuka untuk tenaga pendidik berkualitas yang ingin berkontribusi dalam mencerdaskan generasi bangsa.
                </p>
                <a href="{{ route('about') }}" class="inline-flex items-center px-8 py-3 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-colors shadow-lg shadow-red-200">
                    Info Rekrutmen
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</div>
@endsection