{{-- resources/views/admin/sidebar.blade.php --}}
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    {{-- Tambahkan CSS di atas atau di layout utama --}}
    <style>
        /* === Ubah warna sidebar jadi merah marun === */
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

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('template/img/logo_sd_gendeng.jpg') }}" class="img-fluid" alt="Logo"
                style="width: 70px; border-radius: 50%; object-fit: cover;">
        </div>
        <div class="sidebar-brand-text mx-3">SDMG Admin</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard Admin</span>
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKonten"
            aria-expanded="true" aria-controls="collapseKonten">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Konten Sekolah</span>
        </a>
        {{-- **Logika 'show' hanya untuk 3 menu yang diminta** --}}
        <div id="collapseKonten" 
            class="collapse {{ 
                Request::is('admin/konten-home*') || 
                Request::is('admin/kategori-kegiatan*') || 
                Request::is('admin/program-kegiatan*') 
                ? 'show' : '' 
            }}" 
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola Tampilan Home:</h6>
                
                {{-- Konten Home (Active Logic) --}}
                <a class="collapse-item {{ Request::is('admin/konten-home*') ? 'active' : '' }}" 
                    href="{{ route('konten-home.index') }}">
                    <i class="fas fa-home"></i> Konten Home
                </a>
                
                {{-- Kategori Kegiatan (Active Logic) --}}
                <a class="collapse-item {{ Request::is('admin/kategori-kegiatan*') ? 'active' : '' }}" 
                    href="{{ route('kategori-kegiatan.index') }}">
                    <i class="fas fa-tags"></i> Kategori Kegiatan
                </a>
                
                {{-- Program Kegiatan (Active Logic) --}}
                <a class="collapse-item {{ Request::is('admin/program-kegiatan*') ? 'active' : '' }}" 
                    href="{{ route('kegiatan.index') }}">
                    <i class="fas fa-puzzle-piece"></i> Program Kegiatan
                </a>
                
                {{-- Prestasi (Default Link) --}}
                <a class="collapse-item" href="#">
                    <i class="fas fa-trophy"></i> Prestasi
                </a>
                
                {{-- Info PPDB (Default Link) --}}
                <a class="collapse-item" href="#">
                    <i class="fas fa-bullhorn"></i> Info PPDB
                </a>
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