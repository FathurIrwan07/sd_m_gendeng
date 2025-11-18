
{{-- resources/views/admin/tanggapan/edit.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Tanggapan</h1>
    <a href="{{ route('tanggapan.index') }}" class="btn btn-secondary btn-icon-split">
        <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="row">
    <div class="col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Pengaduan</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr>
                        <th width="40%">Pelapor</th>
                        <td>
                            @if($tanggapan->pengaduan->pelapor)
                                {{ $tanggapan->pengaduan->pelapor->nama_lengkap }}
                            @else
                                <span class="text-muted">Anonim</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td><span class="badge badge-secondary">{{ $tanggapan->pengaduan->kategori->nama_kategori }}</span></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ \Carbon\Carbon::parse($tanggapan->pengaduan->tanggal_pengaduan)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><span class="badge badge-info">{{ $tanggapan->pengaduan->status_pengaduan }}</span></td>
                    </tr>
                </table>
                <div class="mt-3">
                    <strong>Deskripsi:</strong>
                    <div class="p-2 bg-light rounded mt-2">
                        <small>{{ $tanggapan->pengaduan->deskripsi }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Tanggapan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('tanggapan.update', $tanggapan->id_tanggapan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="tanggal_tanggapan">Tanggal Tanggapan <span class="text-danger">*</span></label>
                        <input type="date" 
                               class="form-control @error('tanggal_tanggapan') is-invalid @enderror" 
                               id="tanggal_tanggapan" 
                               name="tanggal_tanggapan" 
                               value="{{ old('tanggal_tanggapan', $tanggapan->tanggal_tanggapan) }}"
                               required>
                        @error('tanggal_tanggapan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="isi_tanggapan">Isi Tanggapan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('isi_tanggapan') is-invalid @enderror" 
                                  id="isi_tanggapan" 
                                  name="isi_tanggapan" 
                                  rows="8" 
                                  required>{{ old('isi_tanggapan', $tanggapan->isi_tanggapan) }}</textarea>
                        @error('isi_tanggapan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tanggapan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
