{{-- resources/views/admin/pengaduan/edit.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Pengaduan</h1>
    <a href="{{ route('admin.pengaduan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-edit"></i> Edit Pengaduan
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pengaduan.update', $pengaduan->id_pengaduan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Info Pelapor (Read Only) -->
                    <div class="alert alert-secondary">
                        <strong>Pelapor:</strong> 
                        @if($pengaduan->pelapor)
                        {{ $pengaduan->pelapor->nama_lengkap }} ({{ $pengaduan->pelapor->username }})
                        @else
                        <span class="badge badge-secondary">Anonim</span>
                        @endif
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <label for="id_kategori" class="font-weight-bold">
                            Kategori Pengaduan <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('id_kategori') is-invalid @enderror" 
                                id="id_kategori" 
                                name="id_kategori" 
                                required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $item)
                            <option value="{{ $item->id_kategori }}" 
                                    {{ old('id_kategori', $pengaduan->id_kategori) == $item->id_kategori ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Pengaduan -->
                    {{-- ⬇️ PERUBAHAN DI SINI ⬇️ --}}
                    <div class="form-group">
                        <label for="tanggal_pengaduan" class="font-weight-bold">
                            Tanggal & Waktu Pengaduan <span class="text-danger">*</span>
                        </label>
                        {{-- 1. Mengubah type="date" menjadi "datetime-local" --}}
                        <input type="datetime-local" 
                               class="form-control @error('tanggal_pengaduan') is-invalid @enderror" 
                               id="tanggal_pengaduan" 
                               name="tanggal_pengaduan"
                               {{-- 2. Mengubah format value agar sesuai dengan datetime-local (Y-m-d\TH:i) --}}
                               {{--    Kita juga pastikan $pengaduan->tanggal_pengaduan di-cast sebagai Carbon --}}
                               value="{{ old('tanggal_pengaduan', \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('Y-m-d\TH:i')) }}"
                               required>
                        @error('tanggal_pengaduan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- ⬆️ AKHIR PERUBAHAN ⬆️ --}}

                    <!-- Status Pengaduan -->
                    <div class="form-group">
                        <label for="status_pengaduan" class="font-weight-bold">
                            Status Pengaduan <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('status_pengaduan') is-invalid @enderror" 
                                id="status_pengaduan" 
                                name="status_pengaduan" 
                                required>
                            <option value="Menunggu Konfirmasi" {{ old('status_pengaduan', $pengaduan->status_pengaduan) === 'Menunggu Konfirmasi' ? 'selected' : '' }}>
                                Menunggu Konfirmasi
                            </option>
                            <option value="Diproses" {{ old('status_pengaduan', $pengaduan->status_pengaduan) === 'Diproses' ? 'selected' : '' }}>
                                Diproses
                            </option>
                            <option value="Selesai" {{ old('status_pengaduan', $pengaduan->status_pengaduan) === 'Selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>
                            <option value="Ditolak" {{ old('status_pengaduan', $pengaduan->status_pengaduan) === 'Ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>
                        </select>
                        @error('status_pengaduan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi (Read Only untuk melihat saja) -->
                    <div class="form-group">
                        <label for="deskripsi" class="font-weight-bold">
                            Deskripsi Pengaduan <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" 
                                  name="deskripsi" 
                                  rows="8" 
                                  required>{{ old('deskripsi', $pengaduan->deskripsi) }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Pengaduan
                        </button>
                        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #4b0000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-history"></i> Informasi
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Dibuat:</small><br>
                    {{-- ⬇️ PERUBAHAN DI SINI: Cast ke Carbon untuk format yang aman ⬇️ --}}
                    <strong>{{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d M Y, H:i') }}</strong>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Terakhir Diubah:</small><br>
                    <strong>{{ \Carbon\Carbon::parse($pengaduan->updated_at)->format('d M Y, H:i') }}</strong>
                </div>

                <div class="mb-0">
                    <small class="text-muted">Status Saat Ini:</small><br>
                    <span class="badge badge-{{ 
                        $pengaduan->status_pengaduan === 'Selesai' ? 'success' : 
                        ($pengaduan->status_pengaduan === 'Diproses' ? 'warning' : 'secondary') 
                    }} badge-lg">
                        {{ $pengaduan->status_pengaduan }}
                    </span>
                </div>
            </div>
        </div>

        @if($pengaduan->tanggapan)
        <div class="card shadow mb-4 border-left-success">
            <div class="card-body">
                <h6 class="text-success font-weight-bold">
                    <i class="fas fa-check-circle"></i> Sudah Ditanggapi
                </h6>
                <p class="small mb-0">
                    Pengaduan ini sudah mendapat tanggapan pada {{ \Carbon\Carbon::parse($pengaduan->tanggapan->tanggal_tanggapan)->format('d F Y') }}
                </p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection