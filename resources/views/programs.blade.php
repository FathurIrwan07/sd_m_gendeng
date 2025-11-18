@extends('layouts.app')

@section('title', 'Program & Kegiatan - SD Muhammadiyah Gendeng')
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
                {{-- Show All Button --}}
                <button class="category-filter px-6 py-2 rounded-full transition-all bg-[#B91C1C] text-white shadow-lg shadow-red-200"
                        data-category="all"
                        data-aos="fade-up">
                    Semua
                </button>
                
                {{-- Dynamic Categories --}}
                @foreach($kategoris as $index => $kategori)
                <button class="category-filter px-6 py-2 rounded-full transition-all bg-gray-100 text-gray-700 hover:bg-red-50 hover:text-[#B91C1C]"
                        data-category="{{ $kategori->id_kategori }}"
                        data-aos="fade-up" 
                        data-aos-delay="{{ ($index + 1) * 50 }}">
                    {{ $kategori->nama_kategori }}
                </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Activities Grid --}}
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($kegiatan->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada program</h3>
                    <p class="mt-1 text-sm text-gray-500">Program kegiatan akan segera ditambahkan.</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="activities-grid">
                    @foreach($kegiatan as $index => $item)
                    <div class="activity-card group" 
                         data-category="{{ $item->id_kategori }}"
                         data-aos="fade-up" 
                         data-aos-delay="{{ $index * 50 }}">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                            {{-- Image --}}
                            <div class="relative h-56 overflow-hidden">
                                @if($item->foto_program)
                                    <img src="{{ asset('storage/' . $item->foto_program) }}" 
                                         alt="{{ $item->nama_program }}" 
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                
                                {{-- Category Badge --}}
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-[#B91C1C] text-white rounded-full text-sm">
                                        {{ $item->kategori->nama_kategori }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-6">
                                <h3 class="text-gray-900 mb-3">{{ $item->nama_program }}</h3>
                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                                    {{ $item->deskripsi }}
                                </p>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-[#B91C1C] to-[#991B1B] rounded-2xl p-8 md:p-12 text-white text-center" data-aos="fade-up">
                <h3 class="text-white mb-4">Jadwal Kegiatan Ekstrakurikuler</h3>
                <p class="text-red-50 mb-6 max-w-2xl mx-auto">
                    Setiap hari Senin - Jumat pukul 14.00 - 16.00 WIB. Siswa dapat memilih minimal 1 kegiatan ekstrakurikuler sesuai minat dan bakat.
                </p>
                <a href="{{ route('ppdb') }}" class="inline-block px-8 py-3 bg-white text-[#B91C1C] rounded-lg hover:bg-gray-50 transition-colors">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.category-filter');
        const activityCards = document.querySelectorAll('.activity-card');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                
                // Update active button state
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-[#B91C1C]', 'text-white', 'shadow-lg', 'shadow-red-200');
                    btn.classList.add('bg-gray-100', 'text-gray-700');
                });
                
                this.classList.remove('bg-gray-100', 'text-gray-700');
                this.classList.add('bg-[#B91C1C]', 'text-white', 'shadow-lg', 'shadow-red-200');
                
                // Filter activities
                activityCards.forEach(card => {
                    if (category === 'all' || card.getAttribute('data-category') === category) {
                        card.style.display = 'block';
                        // Re-trigger animation
                        card.classList.remove('aos-animate');
                        setTimeout(() => {
                            card.classList.add('aos-animate');
                        }, 10);
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush