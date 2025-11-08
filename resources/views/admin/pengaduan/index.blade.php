@extends('admin.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Pengaduan</h1>
    </div>

    {{-- CARD EXPORT PDF --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="font-weight-bold text-primary mb-0">
                        <i class="fas fa-file-pdf text-danger"></i> Export Laporan PDF
                    </h6>
                    <small class="text-muted">Unduh laporan pengaduan dalam format PDF</small>
                </div>
                <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exportModal">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EXPORT PDF --}}
    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                    <h5 class="modal-title text-white">
                        <i class="fas fa-file-pdf"></i> Export Laporan Pengaduan (PDF)
                    </h5>
                    <button class="close text-white" type="button" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('pengaduan.export-pdf') }}" method="GET" target="_blank">
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <strong>Informasi:</strong> Pilih filter untuk customize laporan Anda. 
                            Kosongkan untuk export semua data bulan ini.
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

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Fitur Pencarian --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('pengaduan.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" name="search"
                                placeholder="Cari berdasarkan nama pelapor, kategori, deskripsi, atau status..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>

                @if(request('search'))
                    <div class="mt-2">
                        <a href="{{ route('pengaduan.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-times"></i> Reset Pencarian
                        </a>
                        <span class="text-muted ml-2">
                            Menampilkan hasil untuk: <strong>"{{ request('search') }}"</strong>
                        </span>
                    </div>
                @endif
            </form>
        </div>
    </div>

    {{-- Fitur Filter Waktu --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('pengaduan.index') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label for="filter">Filter Waktu</label>
                        <select name="filter" id="filter" class="form-control">
                            <option value="">Semua Waktu</option>
                            <option value="minggu" {{ request('filter') == 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
                            <option value="bulan" {{ request('filter') == 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="tahun" {{ request('filter') == 'tahun' ? 'selected' : '' }}>Tahun Ini</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-filter"></i> Terapkan
                        </button>
                    </div>

                    @if(request('filter'))
                        <div class="col-md-2 mt-2 mt-md-0">
                            <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary btn-block">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        </div>
                    @endif
                </div>
            </form>

            @if(request('filter'))
                <div class="mt-3 alert alert-info">
                    Menampilkan pengaduan:
                    <strong>
                        @if(request('filter') == 'minggu') Minggu Ini
                        @elseif(request('filter') == 'bulan') Bulan Ini
                        @elseif(request('filter') == 'tahun') Tahun Ini
                        @endif
                    </strong>
                </div>
            @endif
        </div>
    </div>

    {{-- Daftar Pengaduan --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #800000;">
            <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-list"></i> Daftar Pengaduan</h6>
        </div>
        <div class="card-body">
            @if($pengaduan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Pelapor</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengaduan as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        @if($item->pelapor)
                                            <strong>{{ $item->pelapor->nama_lengkap }}</strong><br>
                                            <small class="text-muted">{{ $item->pelapor->username }}</small>
                                        @else
                                            <span class="badge badge-secondary">Anonim</span>
                                        @endif
                                    </td>
                                    <td><span class="badge badge-info">{{ $item->kategori->nama_kategori }}</span></td>
                                    <td>{{ Str::limit($item->deskripsi, 80) }}</td>
                                    <td class="text-center"><small>{{ $item->tanggal_pengaduan->format('d/m/Y') }}</small></td>
                                    <td class="text-center">
                                        <span class="badge badge-{{ 
                                            $item->status_pengaduan === 'Selesai' ? 'success' :
                                            ($item->status_pengaduan === 'Diproses' ? 'warning' :
                                            ($item->status_pengaduan === 'Ditolak' ? 'danger' : 'secondary')) 
                                        }}">
                                            {{ $item->status_pengaduan }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('pengaduan.show', $item->id_pengaduan) }}" class="btn btn-info btn-sm"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if(!$item->tanggapan)
                                            <a href="{{ route('tanggapan.create') }}?pengaduan_id={{ $item->id_pengaduan }}"
                                                class="btn btn-success btn-sm" title="Beri Tanggapan">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                        @endif
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#deleteModal{{ $item->id_pengaduan }}" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Hapus --}}
                                <div class="modal fade" id="deleteModal{{ $item->id_pengaduan }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">Apakah Anda yakin ingin menghapus pengaduan ini?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                <form action="{{ route('pengaduan.destroy', $item->id_pengaduan) }}" method="POST">
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
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada pengaduan ditemukan</h5>
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
    document.querySelector('[name="start_date"]').value = start.toISOString().split('T')[0];
    document.querySelector('[name="end_date"]').value = now.toISOString().split('T')[0];
}

function setThisWeek() {
    const now = new Date();
    const first = now.getDate() - now.getDay();
    const start = new Date(now.setDate(first));
    const end = new Date();
    document.querySelector('[name="start_date"]').value = start.toISOString().split('T')[0];
    document.querySelector('[name="end_date"]').value = end.toISOString().split('T')[0];
}

function setToday() {
    const now = new Date();
    document.querySelector('[name="start_date"]').value = now.toISOString().split('T')[0];
    document.querySelector('[name="end_date"]').value = now.toISOString().split('T')[0];
}
</script>
@endpush