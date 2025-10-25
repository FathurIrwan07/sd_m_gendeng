{{-- resources/views/admin/sidebar.blade.php --}}
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    {{-- Tambahkan CSS di atas atau di layout utama --}}
    <style>
        /* === Ubah warna sidebar jadi merah marun === */
        .bg-gradient-primary {
            background-color: #800000 !important;
            /* Merah marun */
            background-image: linear-gradient(180deg, #800000 10%, #4b0000 100%) !important;
            /* Gradasi merah ke coklat tua */
            background-size: cover;
        }

        /* Warna hover & aktif agar kontras */
        .sidebar .nav-item .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .sidebar .nav-item.active .nav-link {
            background-color: rgba(255, 255, 255, 0.25);
        }

        /* Tombol toggle (panah kecil bawah sidebar) */
        #sidebarToggle {
            background-color: #660000 !important;
        }

        #sidebarToggle:hover {
            background-color: #990000 !important;
        }
    </style>

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('template/img/logo_sd_gendeng.jpg') }}" class="img-fluid" alt="Logo"
                style="width: 70px; border-radius: 50%; object-fit: cover;">
        </div>
        <div class="sidebar-brand-text mx-3">SDMugenta</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manajemen Konten
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData"
            aria-expanded="true" aria-controls="collapseMasterData">
            <i class="fas fa-fw fa-database"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMasterData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengelolaan Data:</h6>
                <a class="collapse-item" href="#">Users & Roles</a>
                <a class="collapse-item" href="#">Fasilitas</a>
                <a class="collapse-item" href="#">Tenaga Pendidik</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKonten" aria-expanded="true"
            aria-controls="collapseKonten">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Konten Sekolah</span>
        </a>
        <div id="collapseKonten" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola Tampilan Home:</h6>
                <a class="collapse-item" href="#">Konten Home</a>
                <a class="collapse-item" href="#">Program Kegiatan</a>
                <a class="collapse-item" href="#">Prestasi</a>
                <a class="collapse-item" href="#">Info PPDB</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Layanan Pengaduan
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-headset"></i>
            <span>Kelola Pengaduan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-reply-all"></i>
            <span>Laporan Tanggapan</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>