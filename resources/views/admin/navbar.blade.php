{{-- Topbar --}}
@php
// Logic to determine the current page title
$pageTitle = 'Dashboard Admin';
if (Request::is('admin/dashboard')) {
    $pageTitle = 'Dashboard Admin';
} elseif (Request::is('admin/users*')) {
    $pageTitle = 'Kelola Users';
} elseif (Request::is('admin/fasilitas*')) {
    $pageTitle = 'Kelola Fasilitas';
} elseif (Request::is('admin/tenaga-pendidik*')) {
    $pageTitle = 'Kelola Tenaga Pendidik';
} elseif (Request::is('admin/konten-home*')) {
    $pageTitle = 'Kelola Tentang Sekolah';
} elseif (Request::is('admin/kategori-kegiatan*')) {
    $pageTitle = 'Kelola Kategori Kegiatan';
} elseif (Request::is('admin/kegiatan*')) {
    $pageTitle = 'Kelola Program Kegiatan';
} elseif (Request::is('admin/prestasi*')) {
    $pageTitle = 'Kelola Prestasi';
} elseif (Request::is('admin/info-ppdb*')) {
    $pageTitle = 'Kelola Info PPDB';
} elseif (Request::is('admin/kategori-pengaduan*')) {
    $pageTitle = 'Kelola Kategori Pengaduan';
} elseif (Request::is('admin/pengaduan*')) {
    $pageTitle = 'Kelola Pengaduan';
} elseif (Request::is('admin/tanggapan*')) {
    $pageTitle = 'Laporan Tanggapan';
} elseif (Request::is('admin/chat*')) {
    $pageTitle = 'Chat Pengaduan';
}
@endphp

<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top">
    {{-- Sidebar Toggle Button (Hamburger) - Clean Style --}}
    <!-- Sidebar Toggle Button (Desktop) -->
<button id="sidebarToggle" class="btn btn-link d-none d-md-inline rounded-circle mr-3"
        style="border: none !important; background: transparent !important; padding: 8px !important; 
               outline: none !important; box-shadow: none !important; width: 40px; height: 40px;">
    <i class="fas fa-bars" style="font-size: 1.25rem; color: #666666;"></i>
</button>

<!-- Sidebar Toggle Button (Mobile) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"
        style="border: none !important; background: transparent !important; padding: 8px !important; 
               outline: none !important; box-shadow: none !important; width: 40px; height: 40px;">
    <i class="fas fa-bars" style="font-size: 1.25rem; color: #666666;"></i>
</button>


    {{-- Page Title --}}
    <div class="topbar-page-title d-none d-sm-inline-block">
        <h5 class="mb-0 font-weight-bold" style="color: #1a1a1a; font-size: 1.125rem;">{{ $pageTitle }}</h5>
    </div>

    {{-- Topbar Navbar --}}
    <ul class="navbar-nav ml-auto">
        {{-- Direct Logout Button --}}
        @auth
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center px-3" href="#" data-toggle="modal" data-target="#logoutModal"
               style="transition: all 0.2s ease;">
                <i class="fas fa-sign-out-alt mr-2" style="font-size: 1rem; color: #666666;"></i>
                <span style="color: #666666; font-weight: 500; font-size: 0.875rem;">Logout</span>
            </a>
        </li>
        @endauth
    </ul>
</nav>

{{-- Custom JavaScript for Sidebar Toggle - Place at end of body --}}
    @push('scripts')
    <script>
    (function($) {
        "use strict";
        
        // Toggle the side navigation
        $("#sidebarToggleTop, #sidebarToggle").on('click', function(e) {
            e.preventDefault();
            console.log('Toggle clicked!'); // Debug log
            
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");
            
            if ($(".sidebar").hasClass("toggled")) {
                $('.sidebar .collapse').collapse('hide');
                localStorage.setItem('sidebarToggled', 'true');
            } else {
                localStorage.removeItem('sidebarToggled');
        }
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function() {
        if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
        }
        
        // Toggle the side navigation when window is resized below 480px
        if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $('.sidebar .collapse').collapse('hide');
        }
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
    });

    // Check localStorage on page load
    if (localStorage.getItem('sidebarToggled') === 'true') {
        $("body").addClass("sidebar-toggled");
        $(".sidebar").addClass("toggled");
        $('.sidebar .collapse').collapse('hide');
    }

    // Hover effects
    $('#sidebarToggleTop, #sidebarToggle').hover(
        function() {
            $(this).find('i').css('color', '#4A90E2');
        },
        function() {
            $(this).find('i').css('color', '#666666');
        }
    );

    $('.nav-link[data-target="#logoutModal"]').hover(
        function() {
            $(this).find('i').css('color', '#4A90E2');
            $(this).find('span').css('color', '#4A90E2');
        },
        function() {
            $(this).find('i').css('color', '#666666');
            $(this).find('span').css('color', '#666666');
        }
    );

})(jQuery);
</script>
@endpush