<nav class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-sm shadow-sm z-50">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('template/img/logo_sd_gendeng.jpg') }}" 
                     alt="Logo SD Muhammadiyah Gendeng" 
                     class="w-12 h-12 rounded-lg object-cover transform group-hover:scale-110 transition-transform duration-300">

                <div>
                    <div class="font-bold text-gray-900">SD Muhammadiyah Gendeng</div>
                    <div class="text-xs text-gray-600">Cerdas & Berkarakter</div>
                </div>
            </a>

            {{-- Desktop Navigation - CENTERED --}}
            <div class="hidden md:flex items-center gap-1 absolute left-1/2 transform -translate-x-1/2">
                <a href="{{ route('home') }}" class="px-4 py-2 text-gray-700 hover:text-[#B91C1C] transition-colors rounded-lg {{ request()->routeIs('home') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('about') }}" class="px-4 py-2 text-gray-700 hover:text-[#B91C1C] transition-colors rounded-lg {{ request()->routeIs('about') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                    Tentang
                </a>
                <a href="{{ route('programs') }}" class="px-4 py-2 text-gray-700 hover:text-[#B91C1C] transition-colors rounded-lg {{ request()->routeIs('programs') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                    Program
                </a>
                <a href="{{ route('achievements') }}" class="px-4 py-2 text-gray-700 hover:text-[#B91C1C] transition-colors rounded-lg {{ request()->routeIs('achievements') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                    Prestasi
                </a>
                <a href="{{ route('facilities') }}" class="px-4 py-2 text-gray-700 hover:text-[#B91C1C] transition-colors rounded-lg {{ request()->routeIs('facilities') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                    Fasilitas
                </a>
                <a href="{{ route('teachers') }}" class="px-4 py-2 text-gray-700 hover:text-[#B91C1C] transition-colors rounded-lg {{ request()->routeIs('teachers') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                    Guru
                </a>
                <a href="{{ route('ppdb') }}" class="px-4 py-2 text-gray-700 hover:text-[#B91C1C] transition-colors rounded-lg {{ request()->routeIs('ppdb') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                    PPDB
                </a>
            </div>

            {{-- Login Button --}}
            <a href="{{ route('login') }}" 
               class="hidden md:block px-6 py-2 bg-[#B91C1C] text-white rounded-lg 
                      hover:bg-[#991B1B] transition-all duration-300 shadow-lg shadow-red-200 
                      hover:shadow-xl">
                Layanan Pengaduan
            </a>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-button" class="md:hidden p-2 text-gray-700 hover:text-[#B91C1C]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-4 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:text-[#B91C1C] hover:bg-red-50 rounded-lg {{ request()->routeIs('home') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                Beranda
            </a>
            <a href="{{ route('about') }}" class="block px-4 py-2 text-gray-700 hover:text-[#B91C1C] hover:bg-red-50 rounded-lg {{ request()->routeIs('about') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                Tentang
            </a>
            <a href="{{ route('programs') }}" class="block px-4 py-2 text-gray-700 hover:text-[#B91C1C] hover:bg-red-50 rounded-lg {{ request()->routeIs('programs') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                Program
            </a>
            <a href="{{ route('achievements') }}" class="block px-4 py-2 text-gray-700 hover:text-[#B91C1C] hover:bg-red-50 rounded-lg {{ request()->routeIs('achievements') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                Prestasi
            </a>
            <a href="{{ route('facilities') }}" class="block px-4 py-2 text-gray-700 hover:text-[#B91C1C] hover:bg-red-50 rounded-lg {{ request()->routeIs('facilities') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                Fasilitas
            </a>
            <a href="{{ route('teachers') }}" class="block px-4 py-2 text-gray-700 hover:text-[#B91C1C] hover:bg-red-50 rounded-lg {{ request()->routeIs('teachers') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                Guru
            </a>
            <a href="{{ route('ppdb') }}" class="block px-4 py-2 text-gray-700 hover:text-[#B91C1C] hover:bg-red-50 rounded-lg {{ request()->routeIs('ppdb') ? 'text-[#B91C1C] bg-red-50' : '' }}">
                PPDB
            </a>
            <a href="{{ route('login') }}" 
               class="block px-4 py-2 bg-[#B91C1C] text-white rounded-lg 
                      hover:bg-[#991B1B] transition-all duration-300 shadow-lg shadow-red-200 
                      hover:shadow-xl text-center">
                Layanan Pengaduan
            </a>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    // Mobile Menu Toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
@endpush