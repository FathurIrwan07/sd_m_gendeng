{{-- resources/views/admin/sidebar.blade.php --}}
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    {{-- CSS sidebar bisa dipindahkan ke file CSS utama agar lebih bersih --}}
    <style>
        /* === Warna sidebar merah marun === */
        .bg-gradient-primary {
            background-color: #800000 !important;
            background-image: linear-gradient(180deg, #800000 10%, #4b0000 100%) !important;
            background-size: cover;
        }

        /* Efek hover dan aktif */
        .sidebar .nav-item .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .sidebar .nav-item.active .nav-link {
            background-color: rgba(255, 255, 255, 0.25);
        }

        /* Tombol toggle */
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
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('user.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard Pengaduan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Layanan Pengaduan</div>

    <!-- Form Pengaduan -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-headset"></i>
            <span>Form Pengaduan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>