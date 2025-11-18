@extends('layouts.app')

@section('title', 'Program & Kegiatan - SD Negeri Harapan Bangsa')
@section('meta_description', 'Beragam kegiatan yang dirancang untuk mengembangkan potensi siswa secara holistik, dari akademik hingga pengembangan karakter.')

@section('content')
<div class="pt-20">
    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-[#B91C1C] to-[#991B1B] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-white mb-4">Program & Kegiatan</h1>
                <p class="text-red-100 max-w-2xl mx-auto">
                    Beragam kegiatan yang dirancang untuk mengembangkan potensi siswa secara holistik, dari akademik hingga pengembangan karakter.
                </p>
            </div>
        </div>
    </section>

    {{-- Categories Filter --}}
    <section class="py-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-3 justify-center">
                @php
                $categories = ['Semua', 'Literasi', 'Numerasi', 'Karakter', 'Olahraga', 'Seni', 'Musik', 'Bahasa', 'Sains'];
                @endphp
                @foreach($categories as $index => $category)
                <button class="px-6 py-2 rounded-full transition-all {{ $index === 0 ? 'bg-[#B91C1C] text-white shadow-lg shadow-red-200' : 'bg-gray-100 text-gray-700 hover:bg-red-50 hover:text-[#B91C1C]' }}"
                        data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    {{ $category }}
                </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Activities Grid --}}
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                $activities = [
                    [
                        'name' => 'Pojok Baca Kelas',
                        'category' => 'Literasi',
                        'description' => 'Kegiatan membaca buku setiap pagi untuk menumbuhkan minat baca siswa. Setiap kelas memiliki pojok baca dengan koleksi buku yang menarik dan disesuaikan dengan tingkat usia.',
                        'image' => 'https://images.unsplash.com/photo-1607823477653-e2c3980acb86?w=1080'
                    ],
                    [
                        'name' => 'Program Menulis Kreatif',
                        'category' => 'Literasi',
                        'description' => 'Mengasah kemampuan menulis siswa melalui kegiatan membuat cerita, puisi, dan karangan. Hasil karya terbaik akan dipublikasikan dalam majalah dinding sekolah.',
                        'image' => 'https://images.unsplash.com/photo-1761208662552-4815d1aa7b1e?w=1080'
                    ],
                    [
                        'name' => 'Kuis Matematika Interaktif',
                        'category' => 'Numerasi',
                        'description' => 'Pembelajaran matematika yang menyenangkan melalui kuis dan permainan edukatif. Siswa belajar berhitung dengan cara yang tidak membosankan.',
                        'image' => 'https://images.unsplash.com/photo-1731834453355-df041245e7d7?w=1080'
                    ],
                    [
                        'name' => 'Upacara Bendera',
                        'category' => 'Karakter',
                        'description' => 'Kegiatan rutin setiap Senin untuk menanamkan nilai kedisiplinan, nasionalisme, dan rasa cinta tanah air kepada siswa.',
                        'image' => 'https://images.unsplash.com/photo-1565373086464-c8af0d586c0c?w=1080'
                    ],
                    [
                        'name' => 'Bakti Sosial',
                        'category' => 'Karakter',
                        'description' => 'Program kepedulian sosial dengan mengunjungi panti asuhan dan membagikan bantuan. Menumbuhkan empati dan kepedulian terhadap sesama.',
                        'image' => 'https://images.unsplash.com/photo-1565373086464-c8af0d586c0c?w=1080'
                    ],
                    [
                        'name' => 'Sepak Bola',
                        'category' => 'Olahraga',
                        'description' => 'Ekstrakurikuler sepak bola dengan pelatih profesional. Melatih kerjasama tim, sportivitas, dan kesehatan fisik siswa.',
                        'image' => 'https://images.unsplash.com/photo-1579156618441-0f9f420e2a25?w=1080'
                    ],
                    [
                        'name' => 'Renang',
                        'category' => 'Olahraga',
                        'description' => 'Pembelajaran berenang dengan instruktur bersertifikat di kolam renang sekolah. Meningkatkan kesehatan dan keselamatan di air.',
                        'image' => 'https://images.unsplash.com/photo-1759200135568-566eb9ecaa81?w=1080'
                    ],
                    [
                        'name' => 'Melukis & Mewarnai',
                        'category' => 'Seni',
                        'description' => 'Kegiatan seni melukis dan mewarnai untuk mengembangkan kreativitas dan imajinasi siswa. Menggunakan berbagai media seperti cat air, crayon, dan pensil warna.',
                        'image' => 'https://images.unsplash.com/photo-1630077852169-3900cc6f4f37?w=1080'
                    ],
                    [
                        'name' => 'Kerajinan Tangan',
                        'category' => 'Seni',
                        'description' => 'Membuat berbagai kerajinan tangan dari bahan sederhana seperti kertas, kardus, dan bahan daur ulang. Melatih keterampilan motorik halus.',
                        'image' => 'https://images.unsplash.com/photo-1630077852169-3900cc6f4f37?w=1080'
                    ],
                    [
                        'name' => 'Paduan Suara',
                        'category' => 'Musik',
                        'description' => 'Latihan menyanyi bersama dengan harmoni yang indah. Melatih kepekaan musik dan kekompakan antar siswa.',
                        'image' => 'https://images.unsplash.com/photo-1761243839303-618ae0906300?w=1080'
                    ],
                    [
                        'name' => 'Angklung',
                        'category' => 'Musik',
                        'description' => 'Pembelajaran alat musik tradisional angklung untuk melestarikan budaya Indonesia dan mengembangkan apresiasi seni tradisional.',
                        'image' => 'https://images.unsplash.com/photo-1761243839303-618ae0906300?w=1080'
                    ],
                    [
                        'name' => 'English Club',
                        'category' => 'Bahasa',
                        'description' => 'Klub bahasa Inggris untuk meningkatkan kemampuan berbicara, membaca, dan menulis dalam bahasa Inggris melalui games dan conversation practice.',
                        'image' => 'https://images.unsplash.com/photo-1758413350815-7b06dbbfb9a7?w=1080'
                    ],
                    [
                        'name' => 'Tahfidz Al-Qur\'an',
                        'category' => 'Bahasa',
                        'description' => 'Program menghafal Al-Qur\'an dengan metode yang menyenangkan. Dibimbing oleh guru tahfidz yang berpengalaman.',
                        'image' => 'https://images.unsplash.com/photo-1758413350815-7b06dbbfb9a7?w=1080'
                    ],
                    [
                        'name' => 'Praktikum Sains',
                        'category' => 'Sains',
                        'description' => 'Kegiatan eksperimen sains sederhana di laboratorium untuk memahami konsep IPA dengan cara yang menyenangkan dan hands-on.',
                        'image' => 'https://images.unsplash.com/photo-1758685734153-132c8620c1bd?w=1080'
                    ],
                    [
                        'name' => 'Tari Tradisional',
                        'category' => 'Seni',
                        'description' => 'Pembelajaran tarian tradisional Indonesia seperti tari Saman, tari Piring, dan tari daerah lainnya untuk melestarikan budaya bangsa.',
                        'image' => 'https://images.unsplash.com/photo-1630077852169-3900cc6f4f37?w=1080'
                    ]
                ];
                @endphp

                @foreach($activities as $index => $activity)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                        {{-- Image --}}
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $activity['image'] }}" 
                                 alt="{{ $activity['name'] }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            
                            {{-- Category Badge --}}
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-[#B91C1C] text-white rounded-full text-sm">
                                    {{ $activity['category'] }}
                                </span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6">
                            <h3 class="text-gray-900 mb-3">{{ $activity['name'] }}</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ $activity['description'] }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-[#B91C1C] to-[#991B1B] rounded-2xl p-8 md:p-12 text-white text-center" data-aos="fade-up">
                <h3 class="text-white mb-4">Jadwal Kegiatan Ekstrakurikuler</h3>
                <p class="text-red-50 mb-6 max-w-2xl mx-auto">
                    Setiap hari Senin - Jumat pukul 14.00 - 16.00 WIB. Siswa dapat memilih minimal 1 kegiatan ekstrakurikuler sesuai minat dan bakat.
                </p>
                <button class="px-8 py-3 bg-white text-[#B91C1C] rounded-lg hover:bg-gray-50 transition-colors">
                    Download Jadwal Lengkap
                </button>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    // Filter functionality (optional - tambahkan jika diperlukan)
    document.querySelectorAll('[data-aos]').forEach(button => {
        if (button.tagName === 'BUTTON') {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('button').forEach(btn => {
                    btn.classList.remove('bg-[#B91C1C]', 'text-white', 'shadow-lg', 'shadow-red-200');
                    btn.classList.add('bg-gray-100', 'text-gray-700');
                });
                
                // Add active class to clicked button
                this.classList.remove('bg-gray-100', 'text-gray-700');
                this.classList.add('bg-[#B91C1C]', 'text-white', 'shadow-lg', 'shadow-red-200');
                
                // Filter logic dapat ditambahkan di sini
            });
        }
    });
</script>
@endpush
