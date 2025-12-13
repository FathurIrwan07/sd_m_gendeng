<footer class="bg-gradient-to-b from-gray-50 to-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-4 gap-8">
            {{-- About --}}
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('template/img/logo_sd_gendeng.jpg') }}" 
                    alt="Logo SD Muhammadiyah Gendeng"
                    class="w-12 h-12 rounded-lg object-cover">
                    <div>
                        <div class="font-bold text-gray-900">SD Muhammadiyah Gendeng</div>
                        <div class="text-xs text-gray-600">Cerdas & Berkarakter</div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mb-4 max-w-md">
                    Membentuk generasi cerdas, berkarakter, dan berakhlak mulia dengan pendidikan berkualitas dan fasilitas modern.
                </p>
                <div class="flex gap-3">
                    <a href="https://www.tiktok.com/@sdmugentayk?is_from_webapp=1&sender_device=pc" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-100 hover:bg-[#B91C1C] rounded-lg flex items-center justify-center transition-colors group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.04-.1z"/>
                        </svg>
                    </a>
                    <a href="http://www.youtube.com/@sdmugentayk4622" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-100 hover:bg-[#B91C1C] rounded-lg flex items-center justify-center transition-colors group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/sdmugentayk?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-100 hover:bg-[#B91C1C] rounded-lg flex items-center justify-center transition-colors group">
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
                        <span>Jl. Melati Wetan GK IV/374 RT. / RW. KOTA Jl. Melati Wetan No.374, Baciro, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55225</span>
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
                        <span>info@sdmuhammadiyahgendeng.sch.id</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-gray-200 mt-8 pt-8 text-center">
            <p class="text-gray-600 text-sm">
                &copy; {{ date('Y') }} SD Muhammadiyah Gendeng. All rights reserved.
            </p>
        </div>
    </div>
</footer>
