
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="{{ route('tanggapan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Buat Tanggapan Baru
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

{{-- CARD EXPORT PDF --}}
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="font-weight-bold text-primary mb-0">
                    <i class="fas fa-file-pdf text-danger"></i> Export Laporan Pengaduan & Tanggapan
                </h6>
                <small class="text-muted">Unduh laporan gabungan pengaduan & tanggapan dalam format PDF</small>
            </div>
            <div class="col-md-4 text-right">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exportModal">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EXPORT PDF GABUNGAN --}}
<div class="modal fade" id="exportModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                <h5 class="modal-title text-white">
                    <i class="fas fa-file-pdf"></i> Export Laporan Pengaduan & Tanggapan (PDF)
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('pengaduan.export-pdf-gabungan') }}" method="GET" target="_blank">
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Informasi:</strong> Laporan ini akan menampilkan data pengaduan beserta tanggapannya dalam satu file PDF.
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control" value="{{ now()->startOfMonth()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="end_date" class="form-control" value="{{ now()->format('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Filter Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Filter Kategori</label>
                                <select name="kategori" class="form-control">
                                    <option value="">Semua Kategori</option>
                                    @foreach(\App\Models\KategoriPengaduan::all() as $kat)
                                        <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label class="d-block mb-3">Quick Filter:</label>
                        <button type="button" class="btn btn-sm btn-outline-primary mr-2" onclick="setThisMonth()">
                            <i class="fas fa-calendar"></i> Bulan Ini
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-success mr-2" onclick="setThisWeek()">
                            <i class="fas fa-calendar-week"></i> Minggu Ini
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-info" onclick="setToday()">
                            <i class="fas fa-calendar-day"></i> Hari Ini
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i> Generate PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Summary Card -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Tanggapan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tanggapan->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-reply-all fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3" style="background-color: #800000;">
        <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-list"></i> Daftar Tanggapan
        </h6>
    </div>
    <div class="card-body">
        @if($tanggapan->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%">Pelapor</th>
                        <th width="15%">Kategori</th>
                        <th width="25%">Tanggapan</th>
                        <th width="10%" class="text-center">Tanggal</th>
                        <th width="15%">Penanggap</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tanggapan as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            @if($item->pengaduan->pelapor)
                            <strong>{{ $item->pengaduan->pelapor->nama_lengkap }}</strong>
                            @else
                            <span class="badge badge-secondary">Anonim</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $item->pengaduan->kategori->nama_kategori }}</span>
                        </td>
                        <td>{{ Str::limit($item->isi_tanggapan, 60) }}</td>
                        <td class="text-center">
                            <small>{{ $item->tanggal_tanggapan->format('d/m/Y') }}</small>
                        </td>
                        <td>{{ $item->penanggap->nama_lengkap }}</td>
                        <td class="text-center">
                            <a href="{{ route('tanggapan.show', $item->id_tanggapan) }}" 
                               class="btn btn-info btn-sm" 
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('tanggapan.edit', $item->id_tanggapan) }}" 
                               class="btn btn-warning btn-sm"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" 
                                    class="btn btn-danger btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#deleteModal{{ $item->id_tanggapan }}"
                                    title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $item->id_tanggapan }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button class="close" type="button" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i> 
                                        Status pengaduan akan kembali ke "Menunggu Konfirmasi"
                                    </div>
                                    Apakah Anda yakin ingin menghapus tanggapan ini?
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('tanggapan.destroy', $item->id_tanggapan) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-reply-all fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada tanggapan</h5>
            <p class="text-muted">Tanggapan yang telah dibuat akan muncul di sini</p>
            <a href="{{ route('tanggapan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Buat Tanggapan
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function setThisMonth() {
    const now = new Date();
    const start = new Date(now.getFullYear(), now.getMonth(), 1);
    document.querySelector('#exportModal [name="start_date"]').value = start.toISOString().split('T')[0];
    document.querySelector('#exportModal [name="end_date"]').value = now.toISOString().split('T')[0];
}

function setThisWeek() {
    const now = new Date();
    const first = now.getDate() - now.getDay();
    const start = new Date(now.setDate(first));
    const end = new Date();
    document.querySelector('#exportModal [name="start_date"]').value = start.toISOString().split('T')[0];
    document.querySelector('#exportModal [name="end_date"]').value = end.toISOString().split('T')[0];
}

function setToday() {
    const now = new Date();
    document.querySelector('#exportModal [name="start_date"]').value = now.toISOString().split('T')[0];
    document.querySelector('#exportModal [name="end_date"]').value = now.toISOString().split('T')[0];
}
</script>
@endpush