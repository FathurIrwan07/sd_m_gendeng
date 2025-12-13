{{-- resources/views/user/pengaduan-anonim/create.blade.php --}}
@extends('user.app')

@section('content')

<!-- Success Alert -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <!-- Form Column -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-secret mr-2"></i>
                    Form Pengaduan Anonim
                </h6>
            </div>
            <div class="card-body">
                <!-- Info Alert -->
                <div class="alert alert-warning">
                    <i class="fas fa-user-secret"></i>
                    <strong>Pengaduan Anonim</strong><br>
                    <small>
                        Identitas Anda tidak akan ditampilkan pada pengaduan ini. Pengaduan akan ditinjau oleh admin sekolah.
                    </small>
                </div>

                <!-- Form -->
                <form action="{{ route('user.pengaduan-anonim.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Kategori Pengaduan -->
                    <div class="form-group">
                        <label for="id_kategori">
                            Kategori Pengaduan <span class="text-danger">*</span>
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
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Pilih kategori yang sesuai dengan pengaduan Anda
                        </small>
                    </div>

                    <div class="form-group">
                            <label for="foto">Upload Foto (Opsional)</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Anda dapat menambahkan foto sebagai bukti pendukung (jpg, jpeg, png)
                            </small>
                        </div>

                    <!-- Deskripsi Pengaduan -->
                    <div class="form-group">
                        <label for="deskripsi">
                            Deskripsi Pengaduan <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" 
                                  name="deskripsi" 
                                  rows="8" 
                                  placeholder="Jelaskan pengaduan Anda dengan detail (minimal 20 karakter)..."
                                  required>{{ old('deskripsi') }}</textarea>
                        
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Jelaskan kronologi kejadian dengan lengkap agar dapat ditindaklanjuti dengan baik
                        </small>
                    </div>

                    <!-- Tanggal Otomatis -->
                    <div class="form-group">
                        <label for="tanggal_display">Tanggal Pengaduan (Otomatis)</label>
                        <input type="text" class="form-control" id="tanggal_display" 
                               value="{{ now()->timezone('Asia/Jakarta')->translatedFormat('d F Y \p\u\k\u\l H:i') }}" 
                               readonly>
                        <small class="form-text text-muted">
                            Waktu dicatat secara otomatis oleh sistem saat pengaduan dikirim.
                        </small>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Catatan:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Pengaduan anonim tidak memerlukan identitas</li>
                            <li>Anda tidak dapat mengubah pengaduan setelah dikirim</li>
                            <li>Status dapat dilihat di halaman publik</li>
                            <li>Admin akan menindaklanjuti pengaduan Anda</li>
                        </ul>
                    </div>

                    <hr>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim Pengaduan Anonim
                        </button>
                    </div>
                </form>

                <!-- Privacy Box -->
                <div class="alert alert-secondary mt-3">
                    <i class="fas fa-shield-alt"></i>
                    <strong>Privasi Terjamin</strong><br>
                    <small>
                        Pengaduan anonim Anda akan ditangani dengan serius dan identitas tetap dirahasiakan. 
                        Status pengaduan dapat dilihat di halaman <a href="{{ route('user.pengaduan-publik.index') }}">Pengaduan Publik</a> setelah diproses oleh admin.
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tips Sidebar -->
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-lightbulb"></i> Tips Pengaduan
                </h6>
            </div>
            <div class="card-body">
                <ol class="mb-0">
                    <li class="mb-2">Pilih kategori yang sesuai</li>
                    <li class="mb-2">Jelaskan masalah dengan detail</li>
                    <li class="mb-2">Sertakan informasi penting (waktu, tempat, dll)</li>
                    <li class="mb-2">Gunakan bahasa yang sopan</li>
                    <li>Pengaduan akan ditinjau oleh admin</li>
                </ol>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-info text-white">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-info-circle"></i> Catatan Penting
                </h6>
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <li class="mb-2">Pengaduan anonim tidak memerlukan identitas</li>
                    <li class="mb-2">Anda tidak dapat mengubah pengaduan setelah dikirim</li>
                    <li class="mb-2">Status dapat dilihat di halaman publik</li>
                    <li>Admin akan menindaklanjuti pengaduan Anda</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection