{{-- resources/views/public/pengaduan/create.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Form Pengaduan - SD Muhammadiyah Gendeng</title>
    
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --maroon-primary: #800000;
            --maroon-secondary: #660000;
            --maroon-light: #a31f1f;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-secondary) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }

        .form-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            background: linear-gradient(135deg, white 0%, #f8f9fa 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            border-bottom: 4px solid var(--maroon-primary);
        }

        .logo-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .logo-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid var(--maroon-primary);
            padding: 5px;
            background: white;
            box-shadow: 0 4px 15px rgba(128, 0, 0, 0.2);
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .form-title {
            color: var(--maroon-primary);
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .form-body {
            padding: 2.5rem 2rem;
        }

        .alert-info-custom {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe5e5 100%);
            border-left: 4px solid var(--maroon-primary);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }

        .alert-info-custom .alert-title {
            color: var(--maroon-primary);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .alert-success-custom {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border-left: 4px solid #28a745;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group label {
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.5rem;
        }

        .required-star {
            color: var(--maroon-primary);
            font-weight: bold;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--maroon-primary);
            box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.15);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .form-text-info {
            background: #f8f9fa;
            padding: 0.75rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .form-text-info i {
            color: var(--maroon-primary);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-secondary) 100%);
            border: none;
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(128, 0, 0, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(128, 0, 0, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 1.5rem 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #dee2e6;
        }

        .divider span {
            background: white;
            padding: 0 1rem;
            position: relative;
            color: #6c757d;
            font-size: 0.875rem;
        }

        .link-custom {
            color: var(--maroon-primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .link-custom:hover {
            color: var(--maroon-secondary);
            text-decoration: underline;
        }

        .privacy-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            padding: 1.25rem;
            margin-top: 1.5rem;
        }

        .privacy-box .privacy-title {
            color: var(--maroon-primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .privacy-box .privacy-text {
            color: #6c757d;
            font-size: 0.875rem;
            line-height: 1.6;
            margin: 0;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23800000' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }

        @media (max-width: 768px) {
            .form-body {
                padding: 2rem 1.5rem;
            }

            .form-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="form-container">
                    <!-- Header -->
                    <div class="form-header">
                        <div class="logo-wrapper">
                            <div class="logo-circle">
                                <img src="{{ asset('template/img/logo_sd_gendeng.jpg') }}" alt="Logo SD Muhammadiyah Gendeng">
                            </div>
                        </div>
                        <h1 class="form-title">Form Pengaduan Masyarakat</h1>
                        <p class="form-subtitle">SD Muhammadiyah Gendeng</p>
                    </div>

                    <!-- Body -->
                    <div class="form-body">
                        <!-- Success Alert -->
                        @if(session('success'))
                        <div class="alert-success-custom">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-check-circle fa-2x mr-3" style="color: #28a745;"></i>
                                <div>
                                    <div class="font-weight-bold mb-1" style="color: #155724;">Berhasil Terkirim!</div>
                                    <div style="color: #155724; font-size: 0.9rem;">{{ session('success') }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Info Alert -->
                        <div class="alert-info-custom">
                            <div class="alert-title">
                                <i class="fas fa-user-secret mr-1"></i> Pengaduan Anonim
                            </div>
                            <small style="color: #6c757d;">
                                Identitas Anda tidak akan ditampilkan. Pengaduan akan ditinjau oleh admin sekolah.
                            </small>
                        </div>

                        <!-- Form -->
                        <form action="{{ route('pengaduan.anonim.store') }}" method="POST">
                            @csrf

                            <!-- Kategori Pengaduan -->
                            <div class="form-group">
                                <label for="id_kategori">
                                    Kategori Pengaduan <span class="required-star">*</span>
                                </label>
                                <select class="form-control @error('id_kategori') is-invalid @enderror" 
                                        id="id_kategori" 
                                        name="id_kategori" 
                                        required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategori as $item)
                                    <option value="{{ $item->id_kategori }}" {{ old('id_kategori') == $item->id_kategori ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Deskripsi Pengaduan -->
                            <div class="form-group">
                                <label for="deskripsi">
                                    Deskripsi Pengaduan <span class="required-star">*</span>
                                </label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" 
                                          name="deskripsi" 
                                          rows="6" 
                                          placeholder="Jelaskan pengaduan Anda dengan detail (minimal 20 karakter)..."
                                          required>{{ old('deskripsi') }}</textarea>
                                
                                <div class="form-text-info">
                                    <i class="fas fa-lightbulb mr-1"></i>
                                    <strong>Tips:</strong> Jelaskan kronologi kejadian dengan lengkap agar dapat ditindaklanjuti dengan baik
                                </div>
                                
                                @error('deskripsi')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-submit">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Pengaduan
                            </button>

                            <!-- Divider -->
                            <div class="divider">
                                <span>Tautan Lainnya</span>
                            </div>

                            <!-- Links -->
                            <div class="text-center">
                                <a class="link-custom d-inline-block mb-2" href="{{ url('/') }}">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
                                </a>
                                <span class="mx-2 text-muted">•</span>
                                <a class="link-custom d-inline-block mb-2" href="{{ route('pengaduan.public.index') }}">
                                    <i class="fas fa-globe mr-1"></i> Lihat Pengaduan Publik
                                </a>
                            </div>

                            @auth
                            <div class="text-center mt-2">
                                <small class="text-muted">
                                    Atau 
                                    <a href="{{ route('user.pengaduan.index') }}" class="link-custom">
                                        buat pengaduan dengan akun Anda
                                    </a>
                                </small>
                            </div>
                            @else
                            <div class="text-center mt-2">
                                <small class="text-muted">
                                    Sudah punya akun? 
                                    <a href="{{ route('login') }}" class="link-custom">
                                        Login di sini
                                    </a>
                                </small>
                            </div>
                            @endauth
                        </form>

                        <!-- Privacy Box -->
                        <div class="privacy-box">
                            <div class="privacy-title">
                                <i class="fas fa-shield-alt mr-1"></i> Privasi Terjamin
                            </div>
                            <p class="privacy-text">
                                Pengaduan anonim Anda akan ditangani dengan serius dan identitas tetap dirahasiakan. 
                                Status pengaduan dapat dilihat setelah diproses oleh admin.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    
    <script>
        // Auto-dismiss success alert after 5 seconds
        $(document).ready(function() {
            if ($('.alert-success-custom').length) {
                setTimeout(function() {
                    $('.alert-success-custom').fadeOut('slow');
                }, 5000);
            }
        });
    </script>
</body>
</html>