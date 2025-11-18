<footer class="bg-gradient-to-b from-gray-50 to-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-4 gap-8">
            {{-- About --}}
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#B91C1C] to-[#991B1B] rounded-lg flex items-center justify-center">
                        <span class="text-white text-xl font-bold">SH</span>
                    </div>
                    <div>
                        <div class="font-bold text-gray-900">SD Harapan Bangsa</div>
                        <div class="text-xs text-gray-600">Cerdas & Berkarakter</div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mb-4 max-w-md">
                    Membentuk generasi cerdas, berkarakter, dan berakhlak mulia dengan pendidikan berkualitas dan fasilitas modern.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-[#B91C1C] rounded-lg flex items-center justify-center transition-colors group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-[#B91C1C] rounded-lg flex items-center justify-center transition-colors group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-[#B91C1C] rounded-lg flex items-center justify-center transition-colors group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-gray-900 mb-4">Navigasi</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-[#B91C1C] text-sm transition-colors">Beranda</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-[#B91C1C] text-sm transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ route('programs') }}" class="text-gray-600 hover:text-[#B91C1C] text-sm transition-colors">Program & Kegiatan</a></li>
                    <li><a href="{{ route('achievements') }}" class="text-gray-600 hover:text-[#B91C1C] text-sm transition-colors">Prestasi</a></li>
                    <li><a href="{{ route('facilities') }}" class="text-gray-600 hover:text-[#B91C1C] text-sm transition-colors">Fasilitas</a></li>
                    <li><a href="{{ route('teachers') }}" class="text-gray-600 hover:text-[#B91C1C] text-sm transition-colors">Tenaga Pendidik</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-gray-900 mb-4">Kontak</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-[#B91C1C] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Jl. Pendidikan No. 123, Jakarta Selatan 12345</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#B91C1C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>(021) 1234-5678</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#B91C1C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>info@sdharapanbangsa.sch.id</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-gray-200 mt-8 pt-8 text-center">
            <p class="text-gray-600 text-sm">
                &copy; {{ date('Y') }} SD Negeri Harapan Bangsa. All rights reserved.
            </p>
        </div>
    </div>
</footer>
