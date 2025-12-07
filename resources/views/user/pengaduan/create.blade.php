{{-- resources/views/user/pengaduan/create.blade.php --}}
@extends('user.app')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Pengaduan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.pengaduan.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="id_kategori">Kategori Pengaduan <span class="text-danger">*</span></label>
                            <select class="form-control @error('id_kategori') is-invalid @enderror" id="id_kategori"
                                name="id_kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
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
                            <label for="deskripsi">Deskripsi Pengaduan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                                name="deskripsi" rows="8"
                                placeholder="Jelaskan secara detail pengaduan Anda (minimal 20 karakter)..."
                                required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Berikan penjelasan yang jelas dan detail agar dapat ditindaklanjuti dengan baik
                            </small>
                        </div>


                        <div class="form-group">
                            <label for="tanggal_display">Tanggal Pengaduan (Otomatis)</label>
                            <input type="text" class="form-control" id="tanggal_display" {{-- ⬇️ PERUBAHAN DI SINI:
                                Tambahkan timezone('Asia/Jakarta') ⬇️ --}}
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
                                <li>Pengaduan Anda akan diproses oleh tim kami</li>
                                <li>Status pengaduan dapat dilihat di halaman riwayat</li>
                                <li>Anda akan menerima tanggapan dari admin</li>
                            </ul>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user.pengaduan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Kirim Pengaduan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                        <li>Tunggu tanggapan dari admin</li>
                    </ol>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-warning text-white">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-user-secret"></i> Pengaduan Anonim
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-3">Tidak ingin identitas Anda diketahui?</p>
                    <a href="{{ route('user.pengaduan-anonim.create') }}" class="btn btn-warning btn-block" target="_blank">
                        <i class="fas fa-mask"></i> Buat Pengaduan Anonim
                    </a>
                    <small class="text-muted">
                        Pengaduan anonim tidak memerlukan login
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection