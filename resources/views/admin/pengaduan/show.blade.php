{{-- ============================================ --}}
{{-- FILE: resources/views/admin/pengaduan/show.blade.php --}}
{{-- FULL VERSION WITH EXPORT PDF --}}
{{-- ============================================ --}}
@extends('admin.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pengaduan</h1>
        <div>
            <a href="{{ route('pengaduan.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-file-alt"></i> Pengaduan - {{ $pengaduan->kategori->nama_kategori }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-primary">Informasi Pelapor</h6>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td width="120"><strong>Nama:</strong></td>
                                    <td>
                                        @if($pengaduan->pelapor)
                                            {{ $pengaduan->pelapor->nama_lengkap }}
                                        @else
                                            <span class="badge badge-secondary">Anonim</span>
                                        @endif
                                    </td>
                                </tr>
                                @if($pengaduan->pelapor)
                                    <tr>
                                        <td><strong>Username:</strong></td>
                                        <td>{{ $pengaduan->pelapor->username }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $pengaduan->pelapor->email ?? '-' }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-success">Informasi Pengaduan</h6>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td width="120"><strong>Kategori:</strong></td>
                                    <td><span class="badge badge-info">{{ $pengaduan->kategori->nama_kategori }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal:</strong></td>
                                    <td>{{ $pengaduan->tanggal_pengaduan->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge badge-{{ 
                                            $pengaduan->status_pengaduan === 'Selesai' ? 'success' :
                                            ($pengaduan->status_pengaduan === 'Diproses' ? 'warning' :
                                            ($pengaduan->status_pengaduan === 'Ditolak' ? 'danger' : 'secondary')) 
                                        }} badge-lg">
                                            @if($pengaduan->status_pengaduan === 'Selesai')
                                                <i class="fas fa-check-circle"></i>
                                            @elseif($pengaduan->status_pengaduan === 'Diproses')
                                                <i class="fas fa-spinner"></i>
                                            @elseif($pengaduan->status_pengaduan === 'Ditolak')
                                                <i class="fas fa-times-circle"></i>
                                            @else
                                                <i class="fas fa-clock"></i>
                                            @endif
                                            {{ $pengaduan->status_pengaduan }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <h6 class="font-weight-bold mb-3"><i class="fas fa-file-alt"></i> Deskripsi Pengaduan:</h6>
                    <div class="bg-light p-3 rounded">
                        <p class="mb-0" style="white-space: pre-line;">{{ $pengaduan->deskripsi }}</p>
                    </div>

                    @if($pengaduan->foto)
    <hr>
    <h6 class="font-weight-bold mb-3"><i class="fas fa-image"></i> Foto Pendukung:</h6>
    <div class="text-center">
        <img src="{{ asset('storage/' . $pengaduan->foto) }}"
             alt="Foto Pengaduan"
             class="img-fluid rounded shadow-sm border"
             style="max-height: 350px; object-fit: cover;">
        <br>
        <a href="{{ asset('storage/' . $pengaduan->foto) }}" target="_blank" class="btn btn-sm btn-primary mt-2">
            <i class="fas fa-search-plus"></i> Lihat Ukuran Besar
        </a>
    </div>
@endif


                    @if($pengaduan->tanggapan)
                        <hr>
                        <h6 class="font-weight-bold mb-3 text-success"><i class="fas fa-reply"></i> Tanggapan:</h6>
                        <div class="card border-left-success">
                            <div class="card-body">
                                <div class="mb-2">
                                    <strong>Ditanggapi oleh:</strong> {{ $pengaduan->tanggapan->penanggap->nama_lengkap }}<br>
                                    <strong>Tanggal:</strong> {{ $pengaduan->tanggapan->tanggal_tanggapan->format('d F Y') }}
                                </div>
                                <hr>
                                <p class="mb-0" style="white-space: pre-line;">{{ $pengaduan->tanggapan->isi_tanggapan }}</p>
                            </div>
                        </div>
                    @else
                        <hr>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Pengaduan ini belum ditanggapi.
                            <a href="{{ route('tanggapan.create') }}?pengaduan_id={{ $pengaduan->id_pengaduan }}"
                                class="btn btn-sm btn-success float-right">
                                <i class="fas fa-reply"></i> Beri Tanggapan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle"></i> Informasi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Dibuat:</small><br>
                        <strong>{{ $pengaduan->created_at->format('d F Y, H:i') }}</strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Terakhir Update:</small><br>
                        <strong>{{ $pengaduan->updated_at->format('d F Y, H:i') }}</strong>
                    </div>
                    <div class="mb-0">
                        <small class="text-muted">Status Tanggapan:</small><br>
                        @if($pengaduan->tanggapan)
                            <span class="badge badge-success"><i class="fas fa-check"></i> Sudah Ditanggapi</span>
                        @else
                            <span class="badge badge-warning"><i class="fas fa-clock"></i> Belum Ditanggapi</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Update Status Card -->
            <div class="card shadow mb-4 border-left-warning">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-sync"></i> Update Status
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengaduan.updateStatus', $pengaduan->id_pengaduan) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-3">
                            <select name="status_pengaduan" class="form-control">
                                <option value="Menunggu Konfirmasi" {{ $pengaduan->status_pengaduan === 'Menunggu Konfirmasi' ? 'selected' : '' }}>
                                    Menunggu Konfirmasi
                                </option>
                                <option value="Diproses" {{ $pengaduan->status_pengaduan === 'Diproses' ? 'selected' : '' }}>
                                    Diproses
                                </option>
                                <option value="Selesai" {{ $pengaduan->status_pengaduan === 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                                <option value="Ditolak" {{ $pengaduan->status_pengaduan === 'Ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block">
                            <i class="fas fa-save"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus pengaduan ini?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="{{ route('pengaduan.destroy', $pengaduan->id_pengaduan) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection