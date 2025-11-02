{{-- resources/views/admin/pengaduan/create.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Pengaduan</h1>
    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary btn-icon-split">
        <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pengaduan</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('pengaduan.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="id_kategori">Kategori Pengaduan <span class="text-danger">*</span></label>
                <select class="form-control @error('id_kategori') is-invalid @enderror" 
                        id="id_kategori" name="id_kategori" required>
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
            </div>

            <div class="form-group">
                <label for="tanggal_pengaduan">Tanggal Pengaduan <span class="text-danger">*</span></label>
                <input type="date" 
                       class="form-control @error('tanggal_pengaduan') is-invalid @enderror" 
                       id="tanggal_pengaduan" 
                       name="tanggal_pengaduan" 
                       value="{{ old('tanggal_pengaduan', date('Y-m-d')) }}"
                       required>
                @error('tanggal_pengaduan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Pengaduan <span class="text-danger">*</span></label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" 
                          name="deskripsi" 
                          rows="6" 
                          placeholder="Jelaskan detail pengaduan Anda..."
                          required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <div class="d-flex justify-content-between">
                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
