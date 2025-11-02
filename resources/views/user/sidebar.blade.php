{{-- resources/views/user/sidebar.blade.php --}}
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <style>
        .bg-gradient-primary {
            background-color: #800000 !important;
            background-image: linear-gradient(180deg, #800000 10%, #4b0000 100%) !important;
            background-size: cover;
        }

        .sidebar .nav-item .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .sidebar .nav-item.active .nav-link {
            background-color: rgba(255, 255, 255, 0.25);
        }

        #sidebarToggle {
            background-color: #660000 !important;
        }

        #sidebarToggle:hover {
            background-color: #990000 !important;
        }
    </style>

    <!-- Logo Sekolah -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('user.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('template/img/logo_sd_gendeng.jpg') }}" class="img-fluid" alt="Logo"
                style="width: 70px; border-radius: 50%; object-fit: cover;">
        </div>
        <div class="sidebar-brand-text mx-3">SDMugenta</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ Request::is('user/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Layanan Pengaduan</div>

    <!-- Riwayat Pengaduan -->
    <li class="nav-item {{ Request::is('user/pengaduan') && !Request::is('user/pengaduan/create') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.pengaduan.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Riwayat Pengaduan</span>
        </a>
    </li>

    <!-- Form Pengaduan -->
    <li class="nav-item {{ Request::is('user/pengaduan/create') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.pengaduan.create') }}">
            <i class="fas fa-fw fa-edit"></i>
            <span>Buat Pengaduan Baru</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Lainnya</div>

    <!-- Pengaduan Anonim -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pengaduan.anonim.create') }}" target="_blank">
            <i class="fas fa-fw fa-user-secret"></i>
            <span>Pengaduan Anonim</span>
        </a>
    </li>

    <!-- Pengaduan Publik -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pengaduan.public.index') }}" target="_blank">
            <i class="fas fa-fw fa-globe"></i>
            <span>Lihat Pengaduan Publik</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>