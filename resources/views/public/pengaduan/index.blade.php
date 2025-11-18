{{-- resources/views/public/pengaduan/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pengaduan Publik - SD Muhammadiyah Gendeng</title>
    
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --maroon-primary: #800000;
            --maroon-secondary: #660000;
            --maroon-light: #a31f1f;
            --bg-light: #f8f9fa;
            --shadow-sm: 0 2px 10px rgba(128, 0, 0, 0.1);
            --shadow-md: 0 4px 20px rgba(128, 0, 0, 0.15);
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-light);
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-secondary) 100%);
            padding: 1rem 0;
            box-shadow: var(--shadow-sm);
        }

        .navbar-custom .navbar-brand {
            font-weight: 600;
            font-size: 1.2rem;
            transition: transform 0.3s;
        }

        .navbar-custom .navbar-brand:hover {
            transform: translateX(5px);
        }

        .navbar-custom .nav-link {
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .navbar-custom .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Header Section */
        .hero-section {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-secondary) 100%);
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.05)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
            opacity: 0.5;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            transition: transform 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--maroon-primary);
            line-height: 1;
        }

        .stats-label {
            color: #6c757d;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        /* Card Pengaduan */
        .card-pengaduan {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .card-pengaduan:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-md);
        }

        .card-header-custom {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-bottom: 3px solid var(--maroon-primary);
            padding: 1.25rem;
        }

        .badge-kategori {
            background: var(--maroon-primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .badge-status {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .badge-diproses {
            background: #ffc107;
            color: #000;
        }

        .badge-selesai {
            background: #28a745;
            color: white;
        }

        .time-badge {
            background: #f8f9fa;
            padding: 0.4rem 0.8rem;
            border-radius: 10px;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .card-body-custom {
            padding: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--maroon-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .deskripsi-text {
            color: #495057;
            line-height: 1.7;
            font-size: 0.95rem;
        }

        .tanggapan-box {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe5e5 100%);
            border-left: 4px solid var(--maroon-primary);
            padding: 1rem;
            border-radius: 10px;
            margin-top: 1rem;
        }

        .tanggapan-title {
            color: var(--maroon-primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .tanggapan-text {
            color: #495057;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            font-size: 5rem;
            color: #dee2e6;
            margin-bottom: 1.5rem;
        }

        .empty-title {
            font-weight: 600;
            color: #6c757d;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .empty-subtitle {
            color: #adb5bd;
            margin-bottom: 2rem;
        }

        .btn-primary-custom {
            background: var(--maroon-primary);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary-custom:hover {
            background: var(--maroon-secondary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Footer */
        .footer-custom {
            background: linear-gradient(135deg, var(--maroon-secondary) 0%, #1a0000 100%);
            color: white;
            padding: 2rem 0;
            margin-top: 4rem;
        }

        .footer-link {
            color: white;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
        }

        .footer-link:hover {
            color: #ffc107;
            transform: translateX(5px);
            display: inline-block;
        }

        /* Pagination */
        .pagination {
            gap: 0.5rem;
        }

        .page-link {
            border: none;
            border-radius: 8px;
            color: var(--maroon-primary);
            font-weight: 500;
            padding: 0.5rem 1rem;
        }

        .page-link:hover {
            background: var(--maroon-primary);
            color: white;
        }

        .page-item.active .page-link {
            background: var(--maroon-primary);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 1.8rem;
            }
            
            .stats-number {
                font-size: 2rem;
            }

            .stats-card {
                margin-top: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('template/img/logo_sd_gendeng.jpg') }}" 
                     alt="Logo" 
                     class="mr-2"
                     style="width: 45px; height: 45px; border-radius: 50%; border: 2px solid white;">
                <span>SD Muhammadiyah Gendeng</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengaduan.anonim.create') }}">
                            <i class="fas fa-edit"></i> Buat Pengaduan
                        </a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center hero-content">
                <div class="col-lg-8">
                    <h1 class="hero-title text-white">Pengaduan Publik</h1>
                    <p class="text-white mb-0" style="font-size: 1.1rem; opacity: 0.95;">
                        <i class="fas fa-info-circle mr-2"></i>
                        Pantau pengaduan yang sedang diproses dan telah diselesaikan
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ $pengaduan->total() }}</div>
                        <div class="stats-label">
                            <i class="fas fa-clipboard-list mr-1"></i>
                            Total Pengaduan Publik
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container my-5">
        @if($pengaduan->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-inbox"></i>
            </div>
            <h4 class="empty-title">Belum Ada Pengaduan Publik</h4>
            <p class="empty-subtitle">Pengaduan yang telah diproses atau diselesaikan akan ditampilkan di halaman ini</p>
            <a href="{{ route('pengaduan.anonim.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus-circle mr-2"></i> Buat Pengaduan Pertama
            </a>
        </div>
        @else
        <div class="row">
            @foreach($pengaduan as $item)
            <div class="col-lg-6 mb-4">
                <div class="card card-pengaduan h-100">
                    <div class="card-header-custom">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="mb-2 mb-md-0">
                                <span class="badge-kategori">
                                    <i class="fas fa-tag mr-1"></i> {{ $item->kategori->nama_kategori }}
                                </span>
                                @if($item->status_pengaduan == 'Diproses')
                                <span class="badge-status badge-diproses ml-2">
                                    <i class="fas fa-spinner fa-spin mr-1"></i> Diproses
                                </span>
                                @elseif($item->status_pengaduan == 'Selesai')
                                <span class="badge-status badge-selesai ml-2">
                                    <i class="fas fa-check-circle mr-1"></i> Selesai
                                </span>
                                @endif
                            </div>
                            <span class="time-badge">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $item->tanggal_pengaduan->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body-custom">
                        <div class="user-info">
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #212529;">
                                    {{ $item->pelapor ? $item->pelapor->name : 'Anonim' }}
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $item->tanggal_pengaduan->format('d F Y, H:i') }} WIB
                                </small>
                            </div>
                        </div>
                        
                        <p class="deskripsi-text">
                            {{ Str::limit($item->deskripsi, 180) }}
                        </p>

                        @if($item->tanggapan)
                        <div class="tanggapan-box">
                            <div class="tanggapan-title">
                                <i class="fas fa-reply mr-1"></i> Tanggapan Admin
                            </div>
                            <div class="tanggapan-text">
                                {{ Str::limit($item->tanggapan->isi_tanggapan, 120) }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $pengaduan->links() }}
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="mb-0">&copy; {{ date('Y') }} SD Muhammadiyah Gendeng. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <a href="{{ route('pengaduan.anonim.create') }}" class="footer-link mr-4">
                        <i class="fas fa-edit mr-1"></i> Buat Pengaduan
                    </a>
                    <a href="{{ url('/') }}" class="footer-link">
                        <i class="fas fa-home mr-1"></i> Beranda
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>