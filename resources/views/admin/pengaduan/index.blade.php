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

    {{-- Search and Filter Card --}}
    <div class="card shadow-sm mb-3" style="border: none; border-radius: 8px;">
        <div class="card-body py-3">
            <form action="{{ route('pengaduan.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-md-5 mb-2 mb-md-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white" style="border-right: none;">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="search"
                                placeholder="Cari pelapor, kategori, deskripsi..." 
                                value="{{ request('search') }}"
                                style="border-left: none;">
                        </div>
                    </div>
                    <div class="col-md-2 mb-2 mb-md-0">
                        <select name="filter" class="form-control">
                            <option value="">Semua Waktu</option>
                            <option value="minggu" {{ request('filter') == 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
                            <option value="bulan" {{ request('filter') == 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="tahun" {{ request('filter') == 'tahun' ? 'selected' : '' }}>Tahun Ini</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="Menunggu Konfirmasi" {{ request('status') == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                            <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-sm btn-block" style="background-color: #800000; color: white;">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
                
                @if(request('search') || request('filter') || request('status'))
                <div class="row mt-2">
                    <div class="col-12">
                        <a href="{{ route('pengaduan.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-times"></i> Reset
                        </a>
                        @if(request('search'))
                            <span class="badge badge-info ml-2">Pencarian: "{{ request('search') }}"</span>
                        @endif
                        @if(request('filter'))
                            <span class="badge badge-primary ml-2">
                                Waktu: 
                                @if(request('filter') == 'minggu') Minggu Ini
                                @elseif(request('filter') == 'bulan') Bulan Ini
                                @elseif(request('filter') == 'tahun') Tahun Ini
                                @endif
                            </span>
                        @endif
                        @if(request('status'))
                            <span class="badge badge-success ml-2">Status: {{ request('status') }}</span>
                        @endif
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>

    {{-- Daftar Pengaduan --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list"></i> Daftar Pengaduan
            </h6>
        </div>
        <div class="card-body">
            @if($pengaduan->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada pengaduan ditemukan</h5>
                    <p class="text-muted">Belum ada pengaduan yang masuk atau hasil filter tidak ditemukan</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="15%">Pelapor</th>
                                <th width="10%">Kategori</th>
                                <th width="12%">Foto</th>
                                <th width="10%" class="text-center">Tanggal</th>
                                <th width="10%" class="text-center">Status</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengaduan as $index => $item)
                                <tr>
                                    <td class="text-center">{{ ($pengaduan->currentPage() - 1) * $pengaduan->perPage() + $index + 1 }}</td>
                                    <td>
                                        @if($item->pelapor)
                                            <strong>{{ $item->pelapor->nama_lengkap }}</strong><br>
                                            <small class="text-muted">
                                                <i class="fas fa-user"></i> {{ $item->pelapor->username }}
                                            </small>
                                        @else
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-user-secret"></i> Anonim
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-info px-2 py-1">
                                            <i class="fas fa-tag"></i> {{ $item->kategori->nama_kategori }}
                                        </span>
                                    </td>


                                    <td>
    @if ($item->foto)
        <img src="{{ asset('storage/' . $item->foto) }}"
     alt="Foto"
     width="80"
     class="rounded">
    @else
        <span class="text-muted">Tidak ada</span>
    @endif
</td>





                                    <td class="text-center">
                                        <small>
                                            <i class="fas fa-calendar"></i> 
                                            {{ $item->tanggal_pengaduan->format('d/m/Y') }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="far fa-clock"></i> {{ $item->created_at->diffForHumans() }}
                                        </small>
                                    </td>
                                     <td class="text-center">
                                    <span class="badge badge-{{ 
                                        $item->status_pengaduan === 'Selesai' ? 'success' :
                                        ($item->status_pengaduan === 'Diproses' ? 'warning' :
                                        ($item->status_pengaduan === 'Ditolak' ? 'danger' : 'secondary')) 
                                    }}">
                                        @if($item->status_pengaduan === 'Selesai')
                                            <i class="fas fa-check-circle"></i>
                                        @elseif($item->status_pengaduan === 'Diproses')
                                            <i class="fas fa-spinner"></i>
                                        @elseif($item->status_pengaduan === 'Ditolak')
                                            <i class="fas fa-times-circle"></i>
                                        @else
                                            <i class="fas fa-clock"></i>
                                        @endif
                                        {{ $item->status_pengaduan }}
                                    </span>
                                </td>
                                    <td class="text-center">
                                        <a href="{{ route('pengaduan.show', $item->id_pengaduan) }}" 
                                           class="btn btn-info btn-sm mr-1"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if(!$item->tanggapan)
                                            <a href="{{ route('tanggapan.create') }}?pengaduan_id={{ $item->id_pengaduan }}"
                                               class="btn btn-success btn-sm mr-1" 
                                               title="Beri Tanggapan">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                        @endif
                                        <button type="button" 
                                                class="btn btn-danger btn-sm" 
                                                data-toggle="modal"
                                                data-target="#deleteModal{{ $item->id_pengaduan }}" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Hapus --}}
                                <div class="modal fade" id="deleteModal{{ $item->id_pengaduan }}" tabindex="-1" role="dialog">
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
                                                <p>Apakah Anda yakin ingin menghapus pengaduan ini?</p>
                                                <div class="alert alert-warning">
                                                    <strong>Pelapor:</strong> {{ $item->pelapor ? $item->pelapor->nama_lengkap : 'Anonim' }}<br>
                                                    <strong>Kategori:</strong> {{ $item->kategori->nama_kategori }}<br>
                                                    <strong>Tanggal:</strong> {{ $item->tanggal_pengaduan->format('d/m/Y') }}
                                                </div>
                                                <p class="text-danger"><strong>Data yang dihapus tidak dapat dikembalikan!</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                                    <i class="fas fa-times"></i> Batal
                                                </button>
                                                <form action="{{ route('pengaduan.destroy', $item->id_pengaduan) }}" method="POST">
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
                                Menampilkan {{ $pengaduan->firstItem() ?? 0 }} - {{ $pengaduan->lastItem() ?? 0 }} 
                                dari {{ $pengaduan->total() }} data
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dataTables_paginate paging_simple_numbers float-right">
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($pengaduan->onFirstPage())
                                    <li class="paginate_button page-item previous disabled">
                                        <span class="page-link">Previous</span>
                                    </li>
                                @else
                                    <li class="paginate_button page-item previous">
                                        <a href="{{ $pengaduan->appends(request()->query())->previousPageUrl() }}" class="page-link">Previous</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach(range(1, $pengaduan->lastPage()) as $i)
                                    @if($i >= $pengaduan->currentPage() - 2 && $i <= $pengaduan->currentPage() + 2)
                                        @if ($i == $pengaduan->currentPage())
                                            <li class="paginate_button page-item active">
                                                <span class="page-link">{{ $i }}</span>
                                            </li>
                                        @else
                                            <li class="paginate_button page-item">
                                                <a href="{{ $pengaduan->appends(request()->query())->url($i) }}" class="page-link">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($pengaduan->hasMorePages())
                                    <li class="paginate_button page-item next">
                                        <a href="{{ $pengaduan->appends(request()->query())->nextPageUrl() }}" class="page-link">Next</a>
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
                            <i class="fas fa-bullhorn fa-2x" style="color: #4e73df;"></i>
                        </div>
                        <div>
                            <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Pengaduan</h6>
                            <small class="text-muted">Laporan dari wali murid dan masyarakat</small>
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
                            <i class="fas fa-tasks fa-2x" style="color: #1cc88a;"></i>
                        </div>
                        <div>
                            <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Status Pengaduan</h6>
                            <small class="text-muted">Pantau dan kelola status setiap laporan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100" style="border-left: 4px solid #f6c23e; border-radius: 8px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <i class="fas fa-reply fa-2x" style="color: #f6c23e;"></i>
                        </div>
                        <div>
                            <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Tanggapan</h6>
                            <small class="text-muted">Berikan respon atas pengaduan yang masuk</small>
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