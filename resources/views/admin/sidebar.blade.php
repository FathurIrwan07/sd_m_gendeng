{{-- resources/views/admin/sidebar.blade.php --}}
<ul class="navbar-nav sidebar accordion shadow-sm" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-3" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('template/img/logo_sd_gendeng.jpg') }}" class="img-fluid" alt="Logo SD Gendeng">
        </div>
        <div class="sidebar-brand-text mx-2 text-dark">SDMG <span class="text-primary fw-bold">Admin</span></div>
    </a>

    <hr class="sidebar-divider my-2">

    <!-- Dashboard -->
    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt me-2"></i>
            <span>Dashboard Admin</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading: Manajemen Konten -->
    <div class="sidebar-heading">Manajemen Konten</div>

    <!-- Master Data -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData"
           aria-expanded="true" aria-controls="collapseMasterData">
            <i class="fas fa-database me-2"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMasterData" class="collapse {{ Request::is('admin/fasilitas*') || Request::is('admin/tenaga-pendidik*') || Request::is('admin/users*') ? 'show' : '' }}"
             data-parent="#accordionSidebar">
            <div class="collapse-inner rounded">
                <h6 class="collapse-header">Pengelolaan Data</h6>
                <a class="collapse-item {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="fas fa-users me-2"></i> Users
                </a>
                <a class="collapse-item {{ Request::is('admin/fasilitas*') ? 'active' : '' }}" href="{{ route('fasilitas.index') }}">
                    <i class="fas fa-building me-2"></i> Fasilitas
                </a>
                <a class="collapse-item {{ Request::is('admin/tenaga-pendidik*') ? 'active' : '' }}" href="{{ route('tenaga-pendidik.index') }}">
                    <i class="fas fa-chalkboard-teacher me-2"></i> Tenaga Pendidik
                </a>
            </div>
        </div>
    </li>

    <!-- Konten Sekolah -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKonten"
           aria-expanded="true" aria-controls="collapseKonten">
            <i class="fas fa-clipboard-list me-2"></i>
            <span>Konten Sekolah</span>
        </a>
        <div id="collapseKonten" class="collapse {{ Request::is('admin/konten-home*') || Request::is('admin/kategori-kegiatan*') || Request::is('admin/kegiatan*') || Request::is('admin/prestasi*') || Request::is('admin/info-ppdb*') ? 'show' : '' }}"
             data-parent="#accordionSidebar">
            <div class="collapse-inner rounded">
                <h6 class="collapse-header">Kelola Tampilan Home</h6>
                <a class="collapse-item {{ Request::is('admin/konten-home*') ? 'active' : '' }}" href="{{ route('konten-home.index') }}">
                    <i class="fas fa-home me-2"></i> Konten Home
                </a>
                <a class="collapse-item {{ Request::is('admin/kategori-kegiatan*') ? 'active' : '' }}" href="{{ route('kategori-kegiatan.index') }}">
                    <i class="fas fa-tags me-2"></i> Kategori Kegiatan
                </a>
                <a class="collapse-item {{ Request::is('admin/kegiatan*') ? 'active' : '' }}" href="{{ route('kegiatan.index') }}">
                    <i class="fas fa-clipboard-list me-2"></i> Program Kegiatan
                </a>
                <a class="collapse-item {{ Request::is('admin/prestasi*') ? 'active' : '' }}" href="{{ route('prestasi.index') }}">
                    <i class="fas fa-trophy me-2"></i> Prestasi
                </a>
                <a class="collapse-item {{ Request::is('admin/info-ppdb*') ? 'active' : '' }}" href="{{ route('info-ppdb.index') }}">
                    <i class="fas fa-school me-2"></i> Info PPDB
                </a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading: Layanan Pengaduan -->
    <div class="sidebar-heading">Layanan Pengaduan</div>

    <li class="nav-item {{ Request::is('admin/kategori-pengaduan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kategori-pengaduan.index') }}">
            <i class="fas fa-tags me-2"></i>
            <span>Kategori Pengaduan</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/pengaduan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pengaduan.index') }}">
            <i class="fas fa-headset me-2"></i>
            <span>Kelola Pengaduan</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/tanggapan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tanggapan.index') }}">
            <i class="fas fa-reply-all me-2"></i>
            <span>Laporan Tanggapan</span>
        </a>
    </li>

    <li class="nav-item mt-3 mb-3">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt me-2"></i>
            <span>Logout</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline my-3">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
