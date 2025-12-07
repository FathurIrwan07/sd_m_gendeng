{{-- resources/views/admin/tanggapan/create.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Buat Tanggapan Pengaduan</h1>
    <a href="{{ route('tanggapan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-reply"></i> Form Tanggapan Pengaduan
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('tanggapan.store') }}" method="POST">
                    @csrf
                    
                    <!-- Pilih Pengaduan -->
                    <div class="form-group">
                        <label for="id_pengaduan" class="font-weight-bold">
                            Pilih Pengaduan <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('id_pengaduan') is-invalid @enderror" 
                                id="id_pengaduan" 
                                name="id_pengaduan" 
                                required
                                {{ $pengaduan ? 'disabled' : '' }}>
                            <option value="">-- Pilih Pengaduan --</option>
                            @if($pengaduan)
                            <option value="{{ $pengaduan->id_pengaduan }}" selected>
                                [{{ $pengaduan->kategori->nama_kategori }}] - {{ Str::limit($pengaduan->deskripsi, 50) }}
                            </option>
                            @else
                            @foreach($pengaduanList as $item)
                            <option value="{{ $item->id_pengaduan }}" {{ old('id_pengaduan') == $item->id_pengaduan ? 'selected' : '' }}>
                                [{{ $item->kategori->nama_kategori }}] - {{ Str::limit($item->deskripsi, 50) }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                        @if($pengaduan)
                        <input type="hidden" name="id_pengaduan" value="{{ $pengaduan->id_pengaduan }}">
                        @endif
                        @error('id_pengaduan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Detail Pengaduan (jika sudah dipilih) -->
                    @if($pengaduan)
                    <div class="alert alert-info">
                        <h6 class="font-weight-bold">Detail Pengaduan:</h6>
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <td width="150"><strong>Pelapor:</strong></td>
                                <td>{{ $pengaduan->pelapor ? $pengaduan->pelapor->nama_lengkap : 'Anonim' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kategori:</strong></td>
                                <td><span class="badge badge-info">{{ $pengaduan->kategori->nama_kategori }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal:</strong></td>
                                <td>{{ $pengaduan->tanggal_pengaduan->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi:</strong></td>
                                <td>{{ $pengaduan->deskripsi }}</td>
                            </tr>
                        </table>
                    </div>
                    @endif

                    <!-- Tanggal Tanggapan -->
                    <div class="form-group">
                        <label for="tanggal_tanggapan" class="font-weight-bold">
                            Tanggal Tanggapan <span class="text-danger">*</span>
                        </label>
                        <input type="date" 
                               class="form-control @error('tanggal_tanggapan') is-invalid @enderror" 
                               id="tanggal_tanggapan" 
                               name="tanggal_tanggapan"
                               value="{{ old('tanggal_tanggapan', date('Y-m-d')) }}"
                               required>
                        @error('tanggal_tanggapan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Isi Tanggapan -->
                    <div class="form-group">
                        <label for="isi_tanggapan" class="font-weight-bold">
                            Isi Tanggapan <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('isi_tanggapan') is-invalid @enderror" 
                                  id="isi_tanggapan" 
                                  name="isi_tanggapan" 
                                  rows="8" 
                                  placeholder="Tulis tanggapan untuk pengaduan ini..."
                                  required>{{ old('isi_tanggapan') }}</textarea>
                        @error('isi_tanggapan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim Tanggapan
                        </button>
                        <a href="{{ route('tanggapan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle"></i> Panduan Tanggapan
                </h6>
            </div>
            <div class="card-body">
                <h6 class="text-primary">Tips Memberikan Tanggapan:</h6>
                <ul class="small">
                    <li>Baca pengaduan dengan teliti</li>
                    <li>Berikan solusi yang jelas</li>
                    <li>Gunakan bahasa yang sopan</li>
                    <li>Jelaskan tindak lanjut yang akan dilakukan</li>
                </ul>
                
                <hr>
                
                <div class="alert alert-success mb-0">
                    <small>
                        <i class="fas fa-check-circle"></i> <strong>Otomatis:</strong><br>
                        Status pengaduan akan berubah menjadi "Diproses" setelah tanggapan dikirim.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection