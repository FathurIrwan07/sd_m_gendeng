{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SD Muhammadiyah Gendeng - Layanan Pengaduan</title>

    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    {{-- Memastikan Nunito ter-load dengan benar, tambahkan font-weight yang lebih lengkap --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{-- CSS Custom untuk Kerapian Font, Field, dan Warna Sekolah --}}
    <style>
        /* Palet Warna SD Muhammadiyah Gendeng */
        :root {
            --maroon-dark: #660000;
            --maroon: #800000; /* Warna utama */
            --maroon-light: #990000; /* Digunakan untuk tombol */
            --text-color: #5a5c69;
        }

        /* 1. Pengaturan Warna Primary (Tombol Login) */
        .btn-primary {
            background-color: var(--maroon-light) !important; /* Gunakan Light untuk kontras */
            border-color: var(--maroon-light) !important;
            font-weight: 700;
            font-size: 1.1rem; /* Ukuran font tombol diperbesar */
            height: 50px; /* Ketinggian tombol diperbesar */
            border-radius: 0.5rem !important; /* Dibuat sedikit membulat */
        }

        .btn-primary:hover {
            background-color: var(--maroon-dark) !important;
            border-color: var(--maroon-dark) !important;
        }
        
        /* Hilangkan gradient di body */
        body {
            background-color: #f8f9fc;
        }
        
        /* Styling untuk Card Login */
        .login-card {
            border-radius: 1rem;
            overflow: hidden;
        }

        /* Kolom Kiri - Gambar Besar */
        .image-side {
            background: url("{{ asset('template/img/view-school-building.jpg') }}") no-repeat center center;
            background-size: cover;
            min-height: 100%;
            border-radius: 1rem 0 0 1rem;
            position: relative;
        }

        /* 2. Kolom Kanan - Form dan Padding */
        .form-side {
            padding: 4rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* 3. Text Field Rapi */
        .form-control-user {
            border-radius: 0.5rem; /* Dibuat sedikit membulat (Elegansi) */
            font-size: 1rem;
            height: 50px; /* Ketinggian field diperbesar */
            padding-left: 1.25rem;
            /* box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important; Tambah sedikit shadow*/
        }
        
        /* 4. Penyesuaian Font Judul */
        .h8.text-gray-900 {
            font-size: 1rem;
            font-weight: 400; /* Normal weight */
            color: var(--text-color) !important;
        }
        .h4.text-gray-900 {
            font-weight: 800; /* Extra bold */
            color: var(--maroon) !important;
            margin-bottom: 3rem; /* Spasi bawah diperlebar */
            font-size: 1.8rem;
        }
        
        .logo-login {
            max-height: 100px; /* Ukuran logo disesuaikan */
            margin-bottom: 1rem;
        }

        /* Remember Me font size */
        .custom-control-label {
            font-size: 0.9rem;
            font-weight: 600;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-light">

    {{-- Session Alerts --}}
    @if (session('error'))
        <script>
            Swal.fire("Oops!", "{{ session('error') }}", "error");
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire("Sukses!", "{{ session('success') }}", "success");
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire("Terjadi Kesalahan",
                "@foreach ($errors->all() as $error) {{ $error }}{{ !$loop->last ? ', ' : '' }} @endforeach",
                "error");
        </script>
    @endif

    <div class="container">
        {{-- Tengah dan tinggi 100% viewport --}}
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg login-card">
                    <div class="card-body p-0">
                        <div class="row">
                            {{-- Kolom Kiri: Gambar Gedung Sekolah --}}
                            <div class="col-lg-6 d-none d-lg-block image-side">
                                </div>

                            {{-- Kolom Kanan: Form Login --}}
                            <div class="col-lg-6 form-side">
                                <div class="text-center">
                                    {{-- **LOGO DI ATAS FIELD** --}}
                                    <img src="{{ asset('template/img/logo_sd_gendeng.jpg') }}" class="logo-login"
                                        alt="Logo SD Muhammadiyah Gendeng">
                                        
                                    <h1 class="h8 text-gray-900">Selamat Datang di</h1>
                                    <h1 class="h4 text-gray-900">Layanan Pengaduan SD Muhammadiyah Gendeng</h1>
                                </div>

                                {{-- Form login --}}
                                <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email"
                                            value="{{ old('email') }}" placeholder="Masukkan Alamat Email" required
                                            autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            name="password" placeholder="Password" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="remember_me"
                                                name="remember">
                                            <label class="custom-control-label" for="remember_me">Ingat Saya</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
</body>

</html>