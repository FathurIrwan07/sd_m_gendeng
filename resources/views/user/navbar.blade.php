{{-- Topbar --}}
@php
    // Logic to determine the current page title
    $pageTitle = 'Dashboard';
    if (Request::is('user/dashboard')) {
        $pageTitle = 'Dashboard';
    } elseif (Request::is('user/pengaduan-anonim/create')) {
        $pageTitle = 'Buat Pengaduan Anonim';
    } elseif (Request::is('user/pengaduan-publik*')) {
        $pageTitle = 'Pengaduan Publik';
    } elseif (Request::is('user/pengaduan/create')) {
        $pageTitle = 'Buat Pengaduan Baru';
    } elseif (Request::is('user/pengaduan*')) {
        $pageTitle = 'Riwayat Pengaduan';
    } elseif (Request::is('user/chat*')) {
        $pageTitle = 'Chat dengan Admin';
    }
@endphp

<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top">
    {{-- Sidebar Toggle Button (Desktop) --}}
    <button id="sidebarToggle" class="btn btn-link d-none d-md-inline rounded-circle mr-3" style="border: none !important; background: transparent !important; padding: 8px !important; 
                   outline: none !important; box-shadow: none !important; width: 40px; height: 40px;">
        <i class="fas fa-bars" style="font-size: 1.25rem; color: #666666;"></i>
    </button>

    {{-- Sidebar Toggle Button (Mobile) --}}
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" style="border: none !important; background: transparent !important; padding: 8px !important; 
                   outline: none !important; box-shadow: none !important; width: 40px; height: 40px;">
        <i class="fas fa-bars" style="font-size: 1.25rem; color: #666666;"></i>
    </button>

    {{-- Page Title --}}
    <div class="topbar-page-title d-none d-sm-inline-block">
        <h5 class="mb-0 font-weight-bold" style="color: #1a1a1a; font-size: 1.125rem;">{{ $pageTitle }}</h5>
    </div>

    {{-- Topbar Navbar --}}
    <ul class="navbar-nav ml-auto">
        {{-- User Profile Dropdown --}}
        @auth
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle d-flex align-items-center px-3" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="transition: all 0.2s ease;">
                    <span class="mr-2 d-none d-lg-inline" style="color: #666666; font-weight: 500; font-size: 0.875rem;">
                        {{ auth()->user()->nama_lengkap }}
                    </span>
                    <img class="img-profile rounded-circle" src="{{ asset('template/img/undraw_profile.svg') }}"
                        style="width: 32px; height: 32px;">
                </a>

                {{-- Dropdown Menu --}}
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown"
                    style="border-radius: 0.5rem; border: none; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;">

                    {{-- PROFIL SAYA --}}
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"
                        style="transition: all 0.2s ease; padding: 0.75rem 1.5rem;">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profil Saya
                    </a>

                    <div class="dropdown-divider"></div>

                    {{-- LOGOUT --}}
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"
                        style="transition: all 0.2s ease; padding: 0.75rem 1.5rem;">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        @endauth
    </ul>

</nav>

{{-- Custom Styles --}}
<style>
    /* Topbar Navbar Styling */
    .topbar {
        background-color: #fff !important;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
    }

    /* Toggle Button Hover Effect */
    #sidebarToggleTop:hover i,
    #sidebarToggle:hover i {
        color: #4A90E2 !important;
        transition: color 0.2s ease;
    }

    /* User Dropdown Styling */
    .nav-link.dropdown-toggle:hover {
        background-color: rgba(0, 0, 0, 0.02) !important;
        border-radius: 0.5rem;
    }

    .nav-link.dropdown-toggle:hover span {
        color: #4A90E2 !important;
    }

    /* Dropdown Item Hover */
    .dropdown-item:hover {
        background-color: #4A90E2 !important;
        color: #fff !important;
    }

    .dropdown-item:hover i {
        color: #fff !important;
    }

    /* Profile Image */
    .img-profile {
        border: 2px solid #e3e6f0;
        transition: border-color 0.2s ease;
    }

    .nav-link:hover .img-profile {
        border-color: #4A90E2;
    }

    /* Dropdown Animation */
    .animated--grow-in {
        animation-name: growIn;
        animation-duration: 200ms;
        animation-timing-function: transform cubic-bezier(0.18, 1.25, 0.4, 1), opacity cubic-bezier(0, 1, 0.4, 1);
    }

    @keyframes growIn {
        0% {
            transform: scale(0.9);
            opacity: 0;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Responsive Title */
    @media (max-width: 576px) {
        .topbar-page-title h5 {
            font-size: 0.95rem !important;
        }
    }
</style>

{{-- Custom JavaScript for Sidebar Toggle --}}
@push('scripts')
    <script>
        (function ($) {
            "use strict";

            // Toggle the side navigation
            $("#sidebarToggleTop, #sidebarToggle").on('click', function (e) {
                e.preventDefault();

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
            $(window).resize(function () {
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
            $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
                if ($(window).width() > 768) {
                    var e0 = e.originalEvent,
                        delta = e0.wheelDelta || -e0.detail;
                    this.scrollTop += (delta < 0 ? 1 : -1) * 30;
                    e.preventDefault();
                }
            });

            // Scroll to top button appear
            $(document).on('scroll', function () {
                var scrollDistance = $(this).scrollTop();
                if (scrollDistance > 100) {
                    $('.scroll-to-top').fadeIn();
                } else {
                    $('.scroll-to-top').fadeOut();
                }
            });

            // Smooth scrolling using jQuery easing
            $(document).on('click', 'a.scroll-to-top', function (e) {
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

            // Hover effects for toggle buttons
            $('#sidebarToggleTop, #sidebarToggle').hover(
                function () {
                    $(this).find('i').css('color', '#4A90E2');
                },
                function () {
                    $(this).find('i').css('color', '#666666');
                }
            );

        })(jQuery);
    </script>
@endpush