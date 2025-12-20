@extends('layouts.app')

@section('content')
    <div class="pt-20">
        {{-- Page Header --}}
        <section class="bg-gradient-to-br from-[#B91C1C] to-[#991B1B] text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center" data-aos="fade-up">
                    <h1 class="text-white mb-4">Informasi PPDB {{ $infoPpdb->tahun_ajaran ?? " "}}</h1>
                    <p class="text-red-100 max-w-2xl mx-auto">
                        Bergabunglah dengan keluarga besar SD Muhammadiyah Gendeng dan wujudkan masa depan cemerlang
                        putra-putri Anda.
                    </p>

                    @if($activeGelombang)
                        <div class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full">
                            <span class="relative flex h-3 w-3">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                            </span>
                            <span class="text-white font-medium">
                                {{ $activeGelombang->nama_gelombang }} -
                                @if($activeGelombang->status == 'berlangsung')
                                    Sedang Berlangsung
                                @else
                                    Dibuka {{ $activeGelombang->tanggal_mulai_formatted }}
                                @endif
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- Timeline --}}
        @if(count($timeline) > 0)
            <section class="py-20 bg-gradient-to-b from-white to-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mb-16">
                        <h3 class="text-center text-gray-900 mb-10" data-aos="fade-up">Tahapan Pendaftaran</h3>
                        <div class="grid md:grid-cols-2 lg:grid-cols-{{ min(count($timeline), 4) }} gap-6">
                            @foreach($timeline as $index => $item)
                                <div class="relative" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-2
                                                                {{ $item['status'] == 'berlangsung' ? 'ring-2 ring-[#B91C1C]' : '' }}
                                                                {{ $item['status'] == 'selesai' ? 'opacity-75' : '' }}">

                                        <div
                                            class="absolute -top-4 -left-4 w-10 h-10 
                                                                    bg-[#B91C1C] 
                                                                    text-white rounded-full flex items-center justify-center shadow-lg font-semibold">
                                            {{ $index + 1 }}
                                        </div>


                                        {{-- Icon --}}
                                        <div class="mb-4 pt-2">
                                            <div
                                                class="w-14 h-14 bg-gradient-to-br from-red-50 to-red-100 rounded-xl flex items-center justify-center">
                                                <span class="text-2xl">{{ $item['icon'] }}</span>
                                            </div>
                                        </div>

                                        {{-- Content --}}
                                        <h4 class="text-gray-900 mb-2">{{ $item['title'] }}</h4>
                                        <p class="text-sm text-[#B91C1C] mb-3 font-medium">{{ $item['date'] }}</p>
                                        <p class="text-sm text-gray-600">{{ $item['description'] }}</p>
                                    </div>

                                    {{-- Connector Line (desktop only) --}}
                                    @if($index < count($timeline) - 1)
                                        <div class="hidden lg:block absolute top-1/2 -right-3 w-6 h-0.5 bg-gray-200 z-0"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- All Gelombang Info --}}
                    @if($infoPpdb && $infoPpdb->gelombang->count() > 0)
                        <div class="mb-16" data-aos="fade-up">
                            <h3 class="text-center text-gray-900 mb-10">Informasi Gelombang Pendaftaran</h3>
                            <div class="grid md:grid-cols-2 lg:grid-cols-{{ min($infoPpdb->gelombang->count(), 3) }} gap-6">
                                @foreach($infoPpdb->gelombang as $gelombang)
                                    <div
                                        class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 
                                                                        {{ $gelombang->status == 'berlangsung' ? 'ring-2 ring-green-500' : '' }}">

                                        {{-- Status Badge --}}
                                        <div class="flex justify-between items-start mb-4">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-semibold
                                                                                {{ $gelombang->status == 'berlangsung' ? 'bg-green-100 text-green-700' : '' }}
                                                                                {{ $gelombang->status == 'belum_mulai' ? 'bg-blue-100 text-blue-700' : '' }}
                                                                                {{ $gelombang->status == 'selesai' ? 'bg-gray-100 text-gray-700' : '' }}">
                                                @if($gelombang->status == 'berlangsung')
                                                    🔴 Sedang Berlangsung
                                                @elseif($gelombang->status == 'belum_mulai')
                                                    ⏳ Belum Dibuka
                                                @else
                                                    ✓ Selesai
                                                @endif
                                            </span>
                                        </div>

                                        <h4 class="text-gray-900 mb-2">{{ $gelombang->nama_gelombang }}</h4>
                                        <p class="text-sm text-[#B91C1C] mb-3 font-medium">
                                            {{ $gelombang->rentang_tanggal }}
                                        </p>

                                        @if($gelombang->keterangan)
                                            <p class="text-sm text-gray-600 mb-4">{{ $gelombang->keterangan }}</p>
                                        @endif

                                        @if($gelombang->tahapan->count() > 0)
                                            <div class="pt-4 border-t border-gray-100">
                                                <p class="text-xs text-gray-500 mb-2">Tahapan:</p>
                                                <ul class="space-y-1">
                                                    @foreach($gelombang->tahapan->take(3) as $tahapan)
                                                        <li class="text-xs text-gray-600 flex items-center gap-2">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-[#B91C1C]"></span>
                                                            {{ $tahapan->nama_tahapan }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Requirements & Registration --}}
                    <div class="grid lg:grid-cols-2 gap-12">
                        {{-- Requirements --}}
                        <div data-aos="fade-right">
                            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                                <h3 class="text-gray-900 mb-6">Persyaratan Pendaftaran</h3>

                                @if(count($requirements) > 0)
                                    <ul class="space-y-4">
                                        @foreach($requirements as $req)
                                            <li class="flex items-start gap-3">
                                                <svg class="w-5 h-5 text-[#B91C1C] flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-gray-600">{{ $req }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-600">Persyaratan akan diumumkan segera.</p>
                                @endif

                                <div class="mt-8 p-6 bg-gradient-to-br from-red-50 to-white rounded-xl border border-red-100">
                                    <h4 class="text-gray-900 mb-2">Biaya Pendaftaran</h4>
                                    <p class="text-[#B91C1C] mb-2 font-semibold text-xl">
                                        {{ $infoPpdb->biaya_pendaftaran ?? 'Gratis' }}
                                    </p>
                                    @if($infoPpdb->keterangan_biaya)
                                        <p class="text-sm text-gray-600">
                                            {{ $infoPpdb->keterangan_biaya }}
                                        </p>
                                    @endif
                                </div>

                                {{-- Brosur --}}
                                @if($infoPpdb->gambar_brosur)
                                    <div class="mt-6">
                                        <img src="{{ Storage::url($infoPpdb->gambar_brosur) }}" alt="Brosur PPDB"
                                            class="w-full rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Registration Form --}}
                        <div data-aos="fade-left">
                            <div
                                class="bg-gradient-to-br from-[#B91C1C] to-[#991B1B] rounded-2xl p-8 shadow-xl text-white sticky top-24">
                                <h3 class="text-white mb-6">Daftar Sekarang</h3>
                                <p class="text-red-50 mb-8">
                                    Dapatkan kesempatan terbaik untuk putra-putri Anda. Kuota terbatas!
                                </p>

                                <div class="space-y-6 mb-8">
                                    @foreach($contactInfo as $contact)
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0">
                                                <span class="text-xl">{{ $contact['icon'] }}</span>
                                            </div>
                                            <div>
                                                <p class="text-sm text-red-100">{{ $contact['type'] }}</p>
                                                <p class="text-white">{{ $contact['value'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @if($infoPpdb->link_pendaftaran)
                                    <a href="{{ $infoPpdb->link_pendaftaran }}" target="_blank"
                                        class="block w-full px-8 py-4 bg-white text-[#B91C1C] rounded-lg hover:bg-gray-50 transition-colors shadow-lg font-semibold text-center">
                                        Formulir Pendaftaran Online
                                    </a>
                                @else
                                    <button
                                        class="w-full px-8 py-4 bg-white text-[#B91C1C] rounded-lg hover:bg-gray-50 transition-colors shadow-lg font-semibold">
                                        Segera Dibuka
                                    </button>
                                @endif

                                @if($infoPpdb->lokasi_kantor)
                                    <p class="text-sm text-red-100 text-center mt-4">
                                        <a href="{{ $infoPpdb->lokasi_kantor }}" target="_blank" class="hover:text-white underline">
                                            📍 Lihat Lokasi di Google Maps
                                        </a>
                                    </p>
                                @else
                                    <p class="text-sm text-red-100 text-center mt-4">
                                        Atau kunjungi langsung kantor kami
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- FAQ Preview --}}
                    <div class="mt-16 bg-white rounded-2xl p-8 shadow-lg border border-gray-100 text-center" data-aos="fade-up">
                        <h3 class="text-gray-900 mb-4">Ada Pertanyaan?</h3>
                        <p class="text-gray-600 mb-6">
                            Tim kami siap membantu menjawab pertanyaan Anda seputar pendaftaran dan informasi sekolah.
                        </p>
                        <a href="{{ route('about') }}#kontak"
                            class="inline-flex items-center px-8 py-3 border-2 border-[#B91C1C] text-[#B91C1C] rounded-lg hover:bg-[#B91C1C] hover:text-white transition-all duration-300">
                            Hubungi Kami
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        @else
            {{-- No Timeline Available --}}
            <section class="py-20 bg-gradient-to-b from-white to-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div class="bg-white rounded-2xl p-12 shadow-lg border border-gray-100">
                        <div class="text-6xl mb-4">📅</div>
                        <h3 class="text-gray-900 mb-4">Informasi PPDB Segera Hadir</h3>
                        <p class="text-gray-600 mb-8">
                            Kami sedang mempersiapkan informasi lengkap mengenai Penerimaan Peserta Didik Baru.
                            Silakan hubungi kami untuk informasi lebih lanjut.
                        </p>
                        <a href="{{ route('about') }}#kontak"
                            class="inline-flex items-center px-8 py-3 bg-[#B91C1C] text-white rounded-lg hover:bg-[#991B1B] transition-all duration-300">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </section>
        @endif

        {{-- Benefits Section --}}
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-gray-900 mb-4">Mengapa Memilih Kami?</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Keunggulan yang akan didapatkan siswa di SD Muhammadiyah Gendeng
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @php
                        $benefits = [
                            [
                                'icon' => '👨‍🏫',
                                'title' => 'Guru Berkualitas',
                                'description' => 'Tenaga pendidik profesional dan bersertifikat'
                            ],
                            [
                                'icon' => '🏫',
                                'title' => 'Fasilitas Modern',
                                'description' => 'Sarana dan prasarana pembelajaran lengkap'
                            ],
                            [
                                'icon' => '🎯',
                                'title' => 'Kurikulum Terkini',
                                'description' => 'Kurikulum Merdeka yang inovatif dan relevan'
                            ],
                            [
                                'icon' => '🏆',
                                'title' => 'Prestasi Gemilang',
                                'description' => 'Berbagai penghargaan tingkat nasional'
                            ],
                            [
                                'icon' => '💰',
                                'title' => 'Biaya Terjangkau',
                                'description' => 'Pendidikan berkualitas dengan biaya yang wajar'
                            ],
                            [
                                'icon' => '🤝',
                                'title' => 'Lingkungan Kondusif',
                                'description' => 'Suasana belajar yang aman dan menyenangkan'
                            ]
                        ];
                    @endphp

                    @foreach($benefits as $index => $benefit)
                        <div class="bg-gradient-to-br from-gray-50 to-white p-6 rounded-2xl border border-gray-100 text-center hover:shadow-lg transition-all duration-300 hover:-translate-y-1"
                            data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                            <div class="text-5xl mb-4">{{ $benefit['icon'] }}</div>
                            <h4 class="text-gray-900 mb-2">{{ $benefit['title'] }}</h4>
                            <p class="text-sm text-gray-600">{{ $benefit['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection