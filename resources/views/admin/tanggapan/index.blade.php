@extends('admin.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

{{-- Search and Action Card --}}
<div class="card shadow-sm mb-3" style="border: none; border-radius: 8px;">
    <div class="card-body py-3">
        <div class="row align-items-center">
            <div class="col-md-6 mb-2 mb-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white" style="border-right: none;">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari pelapor, kategori, atau tanggapan..." style="border-left: none;">
                </div>
            </div>
            <div class="col-md-6 text-md-right">
                <button type="button" class="btn btn-sm btn-danger mr-2" data-toggle="modal" data-target="#exportModal">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </button>
                <a href="{{ route('tanggapan.create') }}" class="btn btn-sm shadow-sm" style="background-color: #800000; color: white;">
                    <i class="fas fa-plus"></i> Buat Tanggapan
                </a>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EXPORT PDF GABUNGAN --}}
<div class="modal fade" id="exportModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">
                    <i class="fas fa-file-pdf"></i> Export Laporan Pengaduan & Tanggapan
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
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i> Generate PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Summary Card -->
<div class="row mb-4">
    <div class="col-xl-12 col-md-12">
        <div class="card shadow h-100" style="border-left: 4px solid #1cc88a; border-radius: 8px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Tanggapan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tanggapan->total() }}</div>
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
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-list"></i> Daftar Tanggapan
        </h6>
    </div>
    <div class="card-body">
        @if($tanggapan->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-reply-all fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada tanggapan</h5>
                <p class="text-muted">Tanggapan yang telah dibuat akan muncul di sini</p>
                <a href="{{ route('tanggapan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Tanggapan
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="15%">Pelapor</th>
                            <th width="12%">Kategori</th>
                            <th width="25%">Tanggapan</th>
                            <th width="18%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tanggapan as $index => $item)
                        <tr>
                            <td class="text-center">{{ ($tanggapan->currentPage() - 1) * $tanggapan->perPage() + $index + 1 }}</td>
                            <td>
                                @if($item->pengaduan->pelapor)
                                    <strong>{{ $item->pengaduan->pelapor->nama_lengkap }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        <i class="fas fa-user"></i> {{ $item->pengaduan->pelapor->username }}
                                    </small>
                                @else
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-user-secret"></i> Anonim
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-info px-2 py-1">
                                    <i class="fas fa-tag"></i> {{ $item->pengaduan->kategori->nama_kategori }}
                                </span>
                            </td>
                            <td>{{ Str::limit($item->isi_tanggapan, 80) }}</td>
                            <td class="text-center">
                                <a href="{{ route('tanggapan.show', $item->id_tanggapan) }}" 
                                   class="btn btn-info btn-sm mr-1" 
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('tanggapan.edit', $item->id_tanggapan) }}" 
                                   class="btn btn-warning btn-sm mr-1"
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
                                        <h5 class="modal-title">
                                            <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                                        </h5>
                                        <button class="close text-white" type="button" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i> 
                                            <strong>Perhatian!</strong> Status pengaduan akan kembali ke "Menunggu Konfirmasi"
                                        </div>
                                        <p>Apakah Anda yakin ingin menghapus tanggapan ini?</p>
                                        <div class="alert alert-info">
                                            <strong>Pelapor:</strong> {{ $item->pengaduan->pelapor ? $item->pengaduan->pelapor->nama_lengkap : 'Anonim' }}<br>
                                            <strong>Kategori:</strong> {{ $item->pengaduan->kategori->nama_kategori }}<br>
                                            <strong>Tanggal:</strong> {{ $item->tanggal_tanggapan->format('d/m/Y') }}
                                        </div>
                                        <p class="text-danger"><strong>Data yang dihapus tidak dapat dikembalikan!</strong></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                            <i class="fas fa-times"></i> Batal
                                        </button>
                                        <form action="{{ route('tanggapan.destroy', $item->id_tanggapan) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="dataTables_info">
                        <small class="text-muted">
                            Menampilkan {{ $tanggapan->firstItem() ?? 0 }} - {{ $tanggapan->lastItem() ?? 0 }} 
                            dari {{ $tanggapan->total() }} data
                        </small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dataTables_paginate paging_simple_numbers float-right">
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($tanggapan->onFirstPage())
                                <li class="paginate_button page-item previous disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="paginate_button page-item previous">
                                    <a href="{{ $tanggapan->previousPageUrl() }}" class="page-link">Previous</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach(range(1, $tanggapan->lastPage()) as $i)
                                @if($i >= $tanggapan->currentPage() - 2 && $i <= $tanggapan->currentPage() + 2)
                                    @if ($i == $tanggapan->currentPage())
                                        <li class="paginate_button page-item active">
                                            <span class="page-link">{{ $i }}</span>
                                        </li>
                                    @else
                                        <li class="paginate_button page-item">
                                            <a href="{{ $tanggapan->url($i) }}" class="page-link">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($tanggapan->hasMorePages())
                                <li class="paginate_button page-item next">
                                    <a href="{{ $tanggapan->nextPageUrl() }}" class="page-link">Next</a>
                                </li>
                            @else
                                <li class="paginate_button page-item next disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Informasi Section -->
<div class="row mt-4">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm h-100" style="border-left: 4px solid #4e73df; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-reply-all fa-2x" style="color: #4e73df;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Tanggapan</h6>
                        <small class="text-muted">Respon atas pengaduan yang masuk</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm h-100" style="border-left: 4px solid #1cc88a; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-user-tie fa-2x" style="color: #1cc88a;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Penanggap</h6>
                        <small class="text-muted">Admin yang memberikan tanggapan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm h-100" style="border-left: 4px solid #e74a3b; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-file-pdf fa-2x" style="color: #e74a3b;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Export PDF</h6>
                        <small class="text-muted">Laporan pengaduan dan tanggapan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table tbody tr {
        transition: background-color 0.2s ease;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fc;
    }
    
    .btn-sm {
        transition: all 0.2s ease;
    }
    
    .btn-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
    }
    
    .form-control {
        transition: all 0.2s ease;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.15);
        border-color: #800000;
    }
    
    .pagination .page-link {
        color: #800000;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #800000;
        border-color: #800000;
    }
</style>
@endpush

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#dataTable tbody tr');
        let visibleCount = 0;
        
        tableRows.forEach(row => {
            // Skip empty state row
            if (row.querySelector('td[colspan]')) {
                return;
            }
            
            const text = row.textContent.toLowerCase();
            if (text.includes(searchValue)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
    });

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