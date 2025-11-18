<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'SD Muhammadiyah Gendeng - Membentuk Generasi Cerdas & Berkarakter')">
    <title>@yield('title', 'SD Muhammadiyah Gendeng')</title>
    
    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- AOS Animation Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    {{-- Custom CSS --}}
    <style>
        /* Typography dari globals.css */
        h1 {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.1;
        }
        h2 {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
        }
        h3 {
            font-size: 1.5rem;
            font-weight: 600;
            line-height: 1.3;
        }
        h4 {
            font-size: 1.25rem;
            font-weight: 600;
            line-height: 1.4;
        }
        p {
            font-size: 1rem;
            line-height: 1.6;
        }
        
        @media (max-width: 768px) {
            h1 { font-size: 2.5rem; }
            h2 { font-size: 2rem; }
            h3 { font-size: 1.25rem; }
        }
    </style>
    
    @stack('styles')
</head>
<body class="antialiased bg-white text-gray-900">
    {{-- Navbar --}}
    @include('components.navbar')
    
    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>
    
    {{-- Footer --}}
    @include('components.footer')
    
    {{-- AOS Animation --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>
    
    @stack('scripts')
</body>
</html>
