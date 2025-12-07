{{-- resources/views/admin/konten-home/index.blade.php --}}
@extends('admin.app')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-triangle"></i> <strong>Terjadi Kesalahan!</strong>
    <ul class="mb-0 mt-2">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

<!-- SAMBUTAN KEPALA SEKOLAH -->
<div class="card shadow mb-4" style="border: none; border-radius: 8px;">
    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white" 
         style="border-bottom: 1px solid #80000;">
        <h6 class="m-0 font-weight-bold" style="color: #800000;">
            <i class="fas fa-bullhorn"></i> Sambutan Kepala Sekolah
        </h6>
        @if($sambutan)
            <button type="button" class="btn btn-warning btn-sm" onclick="toggleEdit('sambutan')" style="min-width: 80px;">
                <i class="fas fa-edit"></i> Edit
            </button>
        @endif
    </div>
    <div class="card-body" id="sambutan-body">
        @if($sambutan)
            <!-- Display Mode -->
            <div id="sambutan-display">
                <div class="row">
                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        @if($sambutan->foto_kepsek_url)
                        <img src="{{ Storage::url($sambutan->foto_kepsek_url) }}" 
                             alt="Foto Kepala Sekolah" 
                             class="img-thumbnail"
                             style="width: 200px; height: 250px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                        @else
                        <div class="d-flex align-items-center justify-content-center bg-light" 
                             style="width: 200px; height: 250px; border-radius: 8px; margin: 0 auto;">
                            <i class="fas fa-user fa-4x text-muted"></i>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <div class="content-box">
                            {!! nl2br(e($sambutan->isi_konten)) !!}
                        </div>
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="far fa-clock"></i> {{ $sambutan->updated_at->format('d M Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Mode -->
            <div id="sambutan-edit" style="display: none;">
                <form action="{{ route('konten-home.update', $sambutan->home_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tipe_konten" value="Sambutan">
                    
                    <div class="form-group">
                        <label class="font-weight-bold">Foto Kepala Sekolah</label>
                        @if($sambutan->foto_kepsek_url)
                        <div class="mb-2">
                            <img src="{{ Storage::url($sambutan->foto_kepsek_url) }}" 
                                 alt="Foto" 
                                 class="img-thumbnail"
                                 style="max-width: 150px; border-radius: 8px;"
                                 id="preview-sambutan">
                        </div>
                        @endif
                        <input type="file" class="form-control-file" name="foto_kepsek" accept="image/*" 
                               onchange="previewImage(this, 'preview-sambutan')">
                        <small class="text-muted">JPG, PNG, GIF (Max: 2MB)</small>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Isi Sambutan <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="isi_konten" rows="8" required>{{ $sambutan->isi_konten }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary mr-2" onclick="cancelEdit('sambutan')" style="min-width: 80px;">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-success" style="min-width: 80px;">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        @else
            <!-- Create Mode -->
            <form action="{{ route('konten-home.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipe_konten" value="Sambutan">
                
                <div class="text-center py-4">
                    <i class="fas fa-bullhorn fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada konten sambutan</h5>
                    <p class="text-muted">Silakan tambahkan konten sambutan dari Kepala Sekolah</p>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Foto Kepala Sekolah</label>
                    <input type="file" class="form-control-file" name="foto_kepsek" accept="image/*" 
                           onchange="previewImage(this, 'preview-new-sambutan')">
                    <small class="text-muted">JPG, PNG, GIF (Max: 2MB)</small>
                    <img id="preview-new-sambutan" class="img-thumbnail mt-2" style="max-width: 150px; border-radius: 8px; display: none;">
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Isi Sambutan <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="isi_konten" rows="8" required 
                              placeholder="Tulis sambutan dari Kepala Sekolah..."></textarea>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success" style="min-width: 80px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>

<!-- VISI & MISI -->
<div class="row">
    <!-- VISI -->
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100" style="border: none; border-radius: 8px;">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white" 
                 style="border-bottom: 1px solid #80000;">
                <h6 class="m-0 font-weight-bold" style="color: #800000;">
                    <i class="fas fa-eye"></i> Visi
                </h6>
                @if($visi)
                    <button type="button" class="btn btn-warning btn-sm" onclick="toggleEdit('visi')" style="min-width: 80px;">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                @endif
            </div>
            <div class="card-body" id="visi-body">
                @if($visi)
                    <!-- Display Mode -->
                    <div id="visi-display">
                        <div class="content-box">
                            {!! nl2br(e($visi->isi_konten)) !!}
                        </div>
                        
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="far fa-clock"></i> {{ $visi->updated_at->format('d M Y H:i') }}
                            </small>
                        </div>
                    </div>

                    <!-- Edit Mode -->
                    <div id="visi-edit" style="display: none;">
                        <form action="{{ route('konten-home.update', $visi->home_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="tipe_konten" value="Visi">
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Isi Visi <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="isi_konten" rows="6" required>{{ $visi->isi_konten }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary mr-2" onclick="cancelEdit('visi')" style="min-width: 80px;">
                                    <i class="fas fa-times"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-success" style="min-width: 80px;">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Create Mode -->
                    <form action="{{ route('konten-home.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tipe_konten" value="Visi">
                        
                        <div class="text-center py-4 mb-3">
                            <i class="fas fa-eye fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Belum ada visi</h6>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Isi Visi <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="isi_konten" rows="6" required 
                                      placeholder="Tulis visi sekolah..."></textarea>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-success" style="min-width: 80px;">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- MISI -->
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100" style="border: none; border-radius: 8px;">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white" 
                 style="border-bottom: 1px solid #80000;">
                <h6 class="m-0 font-weight-bold" style="color: #800000;">
                    <i class="fas fa-tasks"></i> Misi
                </h6>
                @if($misi)
                    <button type="button" class="btn btn-warning btn-sm" onclick="toggleEdit('misi')" style="min-width: 80px;">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                @endif
            </div>
            <div class="card-body" id="misi-body">
                @if($misi)
                    <!-- Display Mode -->
                    <div id="misi-display">
                        <div class="content-box">
                            {!! formatMisiToList($misi->isi_konten) !!}
                        </div>
                        
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="far fa-clock"></i> {{ $misi->updated_at->format('d M Y H:i') }}
                            </small>
                        </div>
                    </div>

                    <!-- Edit Mode -->
                    <div id="misi-edit" style="display: none;">
                        <form action="{{ route('konten-home.update', $misi->home_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="tipe_konten" value="Misi">
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Isi Misi <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="isi_konten" rows="6" required 
                                          placeholder="Tulis misi sekolah (tiap baris akan menjadi poin)">{{ $misi->isi_konten }}</textarea>
                                <small class="text-muted">Tip: Setiap baris baru akan otomatis menjadi bullet point</small>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary mr-2" onclick="cancelEdit('misi')" style="min-width: 80px;">
                                    <i class="fas fa-times"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-success" style="min-width: 80px;">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Create Mode -->
                    <form action="{{ route('konten-home.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tipe_konten" value="Misi">
                        
                        <div class="text-center py-4 mb-3">
                            <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Belum ada misi</h6>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Isi Misi <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="isi_konten" rows="6" required 
                                      placeholder="Tulis misi sekolah (tiap baris akan menjadi poin)"></textarea>
                            <small class="text-muted">Tip: Setiap baris baru akan otomatis menjadi bullet point</small>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-success" style="min-width: 80px;">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Informasi Section -->
<div class="row mt-2">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm h-100" style="border-left: 4px solid #4e73df; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-bullhorn fa-2x" style="color: #4e73df;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Sambutan</h6>
                        <small class="text-muted">Kata sambutan dari Kepala Sekolah dengan foto</small>
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
                        <i class="fas fa-eye fa-2x" style="color: #1cc88a;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Visi</h6>
                        <small class="text-muted">Visi SD Muhammadiyah Gendeng</small>
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
                        <i class="fas fa-tasks fa-2x" style="color: #f6c23e;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Misi</h6>
                        <small class="text-muted">Misi dengan auto bullet points</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .content-box {
        max-height: 300px;
        overflow-y: auto;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 6px;
        border-left: 3px solid #800000;
        line-height: 1.7;
        font-size: 0.95rem;
    }
    
    .content-box ul {
        margin: 0;
        padding-left: 20px;
    }
    
    .content-box li {
        margin-bottom: 8px;
    }
    
    .content-box::-webkit-scrollbar {
        width: 8px;
    }
    
    .content-box::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .content-box::-webkit-scrollbar-thumb {
        background: #800000;
        border-radius: 10px;
    }
    
    .content-box::-webkit-scrollbar-thumb:hover {
        background: #4b0000;
    }
    
    #sambutan-body.edit-mode,
    #visi-body.edit-mode,
    #misi-body.edit-mode {
        background-color: #fffbf0;
    }
    
    .btn {
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .card {
        transition: all 0.2s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
</style>
@endpush

@push('scripts')
<script>
function toggleEdit(section) {
    document.getElementById(section + '-display').style.display = 'none';
    document.getElementById(section + '-edit').style.display = 'block';
    document.getElementById(section + '-body').classList.add('edit-mode');
}

function cancelEdit(section) {
    document.getElementById(section + '-display').style.display = 'block';
    document.getElementById(section + '-edit').style.display = 'none';
    document.getElementById(section + '-body').classList.remove('edit-mode');
}

function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

@php
function formatMisiToList($text) {
    $lines = array_filter(explode("\n", $text), function($line) {
        return trim($line) !== '';
    });
    
    if (count($lines) <= 1) {
        return nl2br(e($text));
    }
    
    $html = '<ul>';
    foreach ($lines as $line) {
        $html .= '<li>' . e(trim($line)) . '</li>';
    }
    $html .= '</ul>';
    
    return $html;
}
@endphp