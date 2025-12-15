{{-- resources/views/user/pengaduan/index.blade.php --}}
@extends('user.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-history"></i> Riwayat Pengaduan
            </h1>
            <a href="{{ route('user.pengaduan.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Buat Pengaduan Baru
            </a>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Statistics Cards -->
        @if($pengaduan->count() > 0)
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total Pengaduan
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pengaduan->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Sedang Diproses</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $pengaduan->where('status_pengaduan', 'Diproses')->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-spinner fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $pengaduan->where('status_pengaduan', 'Selesai')->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Menunggu</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $pengaduan->where('status_pengaduan', 'Menunggu Konfirmasi')->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-list"></i> Daftar Pengaduan
                </h6>
                <div>
                    <button class="btn btn-sm btn-outline-secondary" id="filterBtn">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </div>

            <!-- Filter Section (Hidden by default) -->
            <div class="card-body border-bottom bg-light" id="filterSection" style="display: none;">
                <form method="GET" action="{{ route('user.pengaduan.index') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="">Semua Status</option>
                                    <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control form-control-sm">
                                    <option value="">Semua Kategori</option>
                                    <!-- Populate with actual categories -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="search">Cari</label>
                                <input type="text" name="search" id="search" class="form-control form-control-sm"
                                    placeholder="Cari deskripsi...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-search"></i> Cari
                            </button>
                            <a href="{{ route('user.pengaduan.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-redo"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                @if($pengaduan->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="15%">Kategori</th>
                                    <th width="30%">Deskripsi</th>
                                    <th width="12%">Tanggal</th>
                                    <th class="text-center" width="12%">Status</th>
                                    <th class="text-center" width="10%">Tanggapan</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengaduan as $key => $item)
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td>
                                                        <span class="badge badge-info">
                                                            <i class="fas fa-tag"></i> {{ $item->kategori->nama_kategori }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="text-truncate" style="max-width: 300px;" title="{{ $item->deskripsi }}">
                                                            {{ Str::limit($item->deskripsi, 100) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <small>
                                                            <i class="fas fa-calendar text-primary"></i>
                                                            {{ $item->tanggal_pengaduan->format('d M Y') }}<br>
                                                            <i class="fas fa-clock text-muted"></i>
                                                            {{ $item->created_at->diffForHumans() }}
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
                                                                <i class="fas fa-spinner fa-spin"></i>
                                                            @elseif($item->status_pengaduan === 'Ditolak')
                                                                <i class="fas fa-times-circle"></i>
                                                            @else
                                                                <i class="fas fa-clock"></i>
                                                            @endif
                                                            {{ $item->status_pengaduan }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($item->tanggapan)
                                                            <span class="badge badge-success">
                                                                <i class="fas fa-check"></i> Ada
                                                            </span>
                                                        @else
                                                            <span class="badge badge-secondary">
                                                                <i class="fas fa-minus"></i> Belum
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('user.pengaduan.show', $item->id_pengaduan) }}"
                                                            class="btn btn-sm btn-primary" title="Lihat Detail" data-toggle="tooltip">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Info -->
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i>
                            Menampilkan {{ $pengaduan->count() }} dari {{ $pengaduan->count() }} pengaduan
                        </small>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted mb-3">Belum Ada Pengaduan</h4>
                        <p class="text-muted mb-4">
                            Anda belum memiliki pengaduan. Silakan buat pengaduan baru jika ada keluhan atau saran.
                        </p>
                        <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Buat Pengaduan Baru
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Auto dismiss alerts after 5 seconds
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Toggle filter section
            $('#filterBtn').click(function () {
                $('#filterSection').slideToggle();
                $(this).find('i').toggleClass('fa-filter fa-times');
            });

            // DataTable initialization (if you're using DataTables plugin)
            @if($pengaduan->count() > 0)
                $('#dataTable').DataTable({
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data yang tersedia",
                        "infoFiltered": "(difilter dari _MAX_ total data)",
                        "search": "Cari:",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    },
                    "pageLength": 10,
                    "ordering": true,
                    "order": [[3, 'desc']], // Sort by date column descending
                    "columnDefs": [
                        { "orderable": false, "targets": [0, 6] } // Disable sorting on No and Action columns
                    ]
                });
            @endif
            });
    </script>
@endpush

@push('styles')
    <style>
        .table-hover tbody tr:hover {
            background-color: #f8f9fc;
            cursor: pointer;
        }

        .badge {
            padding: 0.4em 0.6em;
            font-size: 0.85rem;
        }

        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #filterSection {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush