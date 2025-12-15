{{-- resources/views/user/sidebar.blade.php --}}
<ul class="navbar-nav sidebar accordion shadow-sm" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-3" href="{{ route('user.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('template/img/logo_sd_gendeng.jpg') }}" class="img-fluid" alt="Logo SD Mugenta"
                style="width: 50px; height: 50px; object-fit: cover;">
        </div>
        <div class="sidebar-brand-text mx-2 text-dark">SDMugenta</div>
    </a>

    <hr class="sidebar-divider my-2">

    <!-- Dashboard -->
    <li class="nav-item {{ Request::is('user/dashboard') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('user.dashboard') }}">
            <i class="fas fa-tachometer-alt me-2"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading: Layanan Pengaduan -->
    <div class="sidebar-heading">Layanan Pengaduan</div>

    <!-- Riwayat Pengaduan -->
    <li
        class="nav-item {{ Request::is('user/pengaduan') && !Request::is('user/pengaduan/create') && !Request::is('user/pengaduan-*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('user.pengaduan.index') }}">
            <i class="fas fa-list me-2"></i>
            <span>Riwayat Pengaduan</span>
        </a>
    </li>

    <!-- Buat Pengaduan Baru -->
    <li class="nav-item {{ Request::is('user/pengaduan/create') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('user.pengaduan.create') }}">
            <i class="fas fa-edit me-2"></i>
            <span>Buat Pengaduan Baru</span>
        </a>
    </li>

    <!-- Chat dengan Admin -->
    <li class="nav-item {{ Request::is('user/chat*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center position-relative" href="{{ route('user.chat.index') }}">
            <i class="fas fa-comments me-2"></i>
            <span>Chat dengan Admin</span>
            @php
                $userUnread = \App\Models\Pengaduan::where('user_id', auth()->id())
                    ->withCount([
                        'chats as unread_count' => function ($q) {
                            $q->where('is_admin', true)->where('is_read', false);
                        }
                    ])
                    ->get()
                    ->sum('unread_count');
            @endphp
            @if($userUnread > 0)
                <span class="badge badge-danger badge-counter ml-auto">{{ $userUnread }}</span>
            @endif
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading: Lainnya -->
    <div class="sidebar-heading">Lainnya</div>

    <!-- Pengaduan Anonim -->
    <li class="nav-item {{ Request::is('user/pengaduan-anonim*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('user.pengaduan-anonim.create') }}">
            <i class="fas fa-user-secret me-2"></i>
            <span>Pengaduan Anonim</span>
        </a>
    </li>

    <!-- Pengaduan Publik -->
    <li class="nav-item {{ Request::is('user/pengaduan-publik*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('user.pengaduan-publik.index') }}">
            <i class="fas fa-globe me-2"></i>
            <span>Lihat Pengaduan Publik</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

</ul>

{{-- Custom Styles --}}
<style>
    /* Sidebar Styling */
    .sidebar {
        background: linear-gradient(180deg, #ffffff 0%, #f8f9fc 100%);
        border-right: 1px solid #e3e6f0;
    }

    /* Sidebar Brand */
    .sidebar-brand {
        height: 4.375rem;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 800;
        padding: 1.5rem 1rem;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .sidebar-brand:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .sidebar-brand-icon {
        transition: transform 0.3s ease;
    }

    .sidebar-brand:hover .sidebar-brand-icon {
        transform: rotate(5deg) scale(1.05);
    }

    .sidebar-brand-text {
        color: #1a1a1a !important;
        font-weight: 700;
    }

    /* Sidebar Divider */
    .sidebar-divider {
        border-top: 1px solid #e3e6f0;
        margin: 0 1rem;
    }

    /* Sidebar Heading */
    .sidebar-heading {
        text-align: center;
        padding: 0 1rem;
        font-weight: 800;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
        color: #858796;
    }

    /* Nav Items */
    .sidebar .nav-item {
        position: relative;
    }

    .sidebar .nav-item .nav-link {
        text-align: left;
        padding: 0.75rem 1rem;
        width: 100%;
        color: #5a5c69;
        transition: all 0.3s ease;
        border-radius: 0.35rem;
        margin: 0.125rem 0.5rem;
        width: calc(100% - 1rem);
    }

    .sidebar .nav-item .nav-link:hover {
        background-color: #4A90E2;
        color: #ffffff !important;
        transform: translateX(3px);
    }

    .sidebar .nav-item .nav-link:hover i {
        color: #ffffff !important;
    }

    /* Active State */
    .sidebar .nav-item.active .nav-link {
        background: linear-gradient(135deg, #4A90E2 0%, #357ABD 100%);
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 0.125rem 0.25rem rgba(74, 144, 226, 0.3);
    }

    .sidebar .nav-item.active .nav-link i {
        color: #ffffff !important;
    }

    /* Icons */
    .sidebar .nav-item .nav-link i {
        font-size: 0.85rem;
        color: #858796;
        transition: color 0.3s ease;
    }

    /* Badge Counter */
    .badge-counter {
        font-size: 0.65rem;
        padding: 0.25rem 0.45rem;
        border-radius: 10rem;
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: translateY(-50%) scale(1);
        }

        50% {
            transform: translateY(-50%) scale(1.1);
        }
    }

    /* Sidebar Toggled State */
    .sidebar.toggled {
        width: 0;
        overflow: hidden;
    }

    .sidebar.toggled .sidebar-brand-text {
        display: none;
    }

    .sidebar.toggled .nav-item .nav-link span {
        display: none;
    }

    .sidebar.toggled .sidebar-heading {
        display: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            width: 0;
            overflow: hidden;
        }

        .sidebar.toggled {
            width: 14rem;
        }

        .sidebar.toggled .sidebar-brand-text,
        .sidebar.toggled .nav-item .nav-link span,
        .sidebar.toggled .sidebar-heading {
            display: block;
        }
    }

    /* Smooth Transitions */
    .sidebar,
    .sidebar .nav-item .nav-link,
    .sidebar-brand-icon {
        transition: all 0.3s ease;
    }
</style>