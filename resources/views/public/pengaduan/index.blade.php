{{-- resources/views/public/pengaduan/create.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Form Pengaduan - SD Muhammadiyah Gendeng</title>
    
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 col-md-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{ asset('template/img/logo_sd_gendeng.jpg') }}" 
                                             alt="Logo" 
                                             class="mb-3"
                                             style="width: 100px; border-radius: 50%;">
                                        <h1 class="h4 text-gray-900 mb-2">Form Pengaduan Masyarakat</h1>
                                        <p class="mb-4 text-muted">SD Muhammadiyah Gendeng</p>
                                    </div>

                                    @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><i class="fas fa-check-circle"></i> Berhasil!</strong><br>
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    @endif

                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> 
                                        <strong>Pengaduan Anonim</strong><br>
                                        <small>Identitas Anda tidak akan ditampilkan. Pengaduan akan ditinjau oleh admin sekolah.</small>
                                    </div>

                                    <form action="{{ route('pengaduan.anonim.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="id_kategori" class="font-weight-bold">
                                                Kategori Pengaduan <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control form-control-user @error('id_kategori') is-invalid @enderror" 
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
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="deskripsi" class="font-weight-bold">
                                                Deskripsi Pengaduan <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                                      id="deskripsi" 
                                                      name="deskripsi" 
                                                      rows="8" 
                                                      placeholder="Jelaskan pengaduan Anda dengan detail (minimal 20 karakter)..."
                                                      required>{{ old('deskripsi') }}</textarea>
                                            <small class="form-text text-muted">
                                                <i class="fas fa-lightbulb"></i> Tips: Jelaskan kronologi kejadian dengan lengkap agar dapat ditindaklanjuti dengan baik
                                            </small>
                                            @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-paper-plane"></i> Kirim Pengaduan
                                        </button>

                                        <hr>

                                        <div class="text-center">
                                            <a class="small" href="{{ url('/') }}">
                                                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                                            </a>
                                        </div>

                                        @auth
                                        <div class="text-center">
                                            <a class="small" href="{{ route('user.pengaduan.index') }}">
                                                Atau buat pengaduan dengan akun Anda
                                            </a>
                                        </div>
                                        @else
                                        <div class="text-center">
                                            <a class="small" href="{{ route('login') }}">
                                                Sudah punya akun? Login di sini
                                            </a>
                                        </div>
                                        @endauth
                                    </form>

                                    <div class="card bg-light mt-4">
                                        <div class="card-body">
                                            <h6 class="font-weight-bold text-primary">
                                                <i class="fas fa-shield-alt"></i> Privasi Terjamin
                                            </h6>
                                            <small class="text-muted">
                                                Pengaduan anonim Anda akan ditangani dengan serius dan identitas tetap dirahasiakan. 
                                                Status pengaduan dapat dilihat setelah diproses oleh admin.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('template/js/sb-admin-2.min.js')}}"></script>
</body>
</html>