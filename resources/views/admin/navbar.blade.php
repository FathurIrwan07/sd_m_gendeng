@php
    // Logic to determine the current page title for the topbar
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
        $pageTitle = 'Kelola Konten Home';
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
    }
@endphp

<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow"> <!-- Removed bg-white class to rely on custom CSS -->

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    
    <!-- Page Title for Topbar (New Addition) -->
    <div class="topbar-page-title d-none d-sm-block">{{ $pageTitle }}</div>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        @auth
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                    <img class="img-profile rounded-circle" src="{{ asset('template/img/undraw_profile.svg') }}">
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        @endauth

    </ul>

</nav>