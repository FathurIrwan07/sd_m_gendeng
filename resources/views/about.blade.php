@extends('layouts.app')

@section('title', 'Tentang Kami - SD Muhammadiyah Gendeng')
@section('meta_description', 'Mengenal lebih dekat SD Muhammadiyah Gendeng, visi misi, dan komitmen kami dalam membentuk generasi unggul.')

@section('content')
<div class="pt-20">
    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-[#B91C1C] to-[#991B1B] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-white mb-4">Tentang Kami</h1>
                <p class="text-red-100 max-w-2xl mx-auto">
                    Mengenal lebih dekat SD Muhammadiyah Gendeng, visi misi, dan komitmen kami dalam membentuk generasi unggul.
                </p>
            </div>
        </div>
    </section>

    {{-- Sambutan Kepala Sekolah --}}
    @if($sambutan)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                {{-- Photo Kepala Sekolah --}}
                <div class="relative" data-aos="fade-right">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#B91C1C]/10 to-transparent rounded-2xl transform rotate-3"></div>
                    <div class="relative bg-white rounded-2xl overflow-hidden shadow-xl border border-gray-100">
                        <div class="aspect-[4/3] relative">
                            @if($sambutan->foto_kepsek_url)
                                <img src="{{ asset('storage/' . $sambutan->foto_kepsek_url) }}" 
                                     alt="Kepala Sekolah" 
                                     class="w-full h-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1736939678218-bd648b5ef3bb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwcm9mZXNzaW9uYWwlMjBwcmluY2lwYWwlMjBoZWFkbWFzdGVyfGVufDF8fHx8MTc2MzQ2MDYwNHww&ixlib=rb-4.1.0&q=80&w=1080" 
                                     alt="Kepala Sekolah" 
                                     class="w-full h-full object-cover">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        </div>
                        <div class="p-6 bg-gradient-to-br from-[#B91C1C] to-[#991B1B] text-white">
                            <h3 class="text-white mb-1">{{ $sambutan->judul_konten ?? 'Kepala Sekolah' }}</h3>
                            <p class="text-red-100">Kepala Sekolah</p>
                        </div>
                    </div>
                </div>

                {{-- Sambutan --}}
                <div data-aos="fade-left">
                    <h2 class="text-gray-900 mb-6">Sambutan Kepala Sekolah</h2>
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                        {!! nl2br(e($sambutan->isi_konten)) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Visi Misi Section --}}
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-gray-900 mb-4">Visi & Misi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Fondasi yang mendasari setiap kegiatan pendidikan di SD Muhammadiyah Gendeng.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                {{-- Visi --}}
                @if($visi)
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100" data-aos="fade-right">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#B91C1C] to-[#991B1B] rounded-xl flex items-center justify-center mb-6">
                        <svg class="text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $visi->isi_konten }}
                    </p>
                </div>
                @else
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100" data-aos="fade-right">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#B91C1C] to-[#991B1B] rounded-xl flex items-center justify-center mb-6">
                        <svg class="text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Data visi belum tersedia.
                    </p>
                </div>
                @endif

                {{-- Misi --}}
                @if($misi)
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100" data-aos="fade-left">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#B91C1C] to-[#991B1B] rounded-xl flex items-center justify-center mb-6">
                        <svg class="text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-gray-900 mb-4">Misi</h3>
                    <div class="space-y-3">
                        @php
                            // Split misi by newline or numbered list
                            $misiList = preg_split('/\r\n|\r|\n/', $misi->isi_konten);
                            $misiList = array_filter($misiList, fn($item) => !empty(trim($item)));
                        @endphp
                        @foreach($misiList as $misiItem)
                        <div class="flex items-start gap-3 text-gray-600">
                            <div class="w-6 h-6 bg-red-50 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <div class="w-2 h-2 bg-[#B91C1C] rounded-full"></div>
                            </div>
                            <span>{{ trim($misiItem) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100" data-aos="fade-left">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#B91C1C] to-[#991B1B] rounded-xl flex items-center justify-center mb-6">
                        <svg class="text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-gray-900 mb-4">Misi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Data misi belum tersedia.
                    </p>
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- About School --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
                <h2 class="text-gray-900 mb-6">SD Muhammadiyah Gendeng</h2>
                <p class="text-gray-600 leading-relaxed mb-8">
                    SD Muhammadiyah Gendeng adalah lembaga pendidikan dasar yang berdedikasi untuk membentuk generasi unggul dengan standar pendidikan nasional dan nilai-nilai karakter yang kuat. Dengan akreditasi A, kami telah dipercaya oleh ribuan orang tua untuk mendidik putra-putri mereka sejak tahun 1995.
                </p>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="p-6 bg-gradient-to-br from-red-50 to-white rounded-xl border border-red-100" data-aos="zoom-in" data-aos-delay="0">
                        <div class="text-[#B91C1C] font-bold text-3xl mb-2">1995</div>
                        <p class="text-gray-600">Tahun Berdiri</p>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-red-50 to-white rounded-xl border border-red-100" data-aos="zoom-in" data-aos-delay="100">
                        <div class="text-[#B91C1C] font-bold text-3xl mb-2">A</div>
                        <p class="text-gray-600">Akreditasi</p>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-red-50 to-white rounded-xl border border-red-100" data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-[#B91C1C] font-bold text-3xl mb-2">500+</div>
                        <p class="text-gray-600">Siswa Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection