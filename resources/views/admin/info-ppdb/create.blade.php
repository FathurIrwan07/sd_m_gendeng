{{-- resources/views/admin/info-ppdb/create.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Info PPDB</h1>
    <a href="{{ route('info-ppdb.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-plus-circle"></i> Form Info PPDB Baru
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('info-ppdb.store') }}" method="POST" enctype="multipart/form-data" id="formPpdb">
                    @csrf
                    
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs mb-4" id="ppdbTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#infoTab" 
                                    type="button" role="tab" aria-controls="infoTab" aria-selected="true">
                                <i class="fas fa-info-circle me-2"></i> Info Dasar
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="kontak-tab" data-bs-toggle="tab" data-bs-target="#kontakTab" 
                                    type="button" role="tab" aria-controls="kontakTab" aria-selected="false">
                                <i class="fas fa-phone me-2"></i> Kontak & Lokasi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="gelombang-tab" data-bs-toggle="tab" data-bs-target="#gelombangTab" 
                                    type="button" role="tab" aria-controls="gelombangTab" aria-selected="false">
                                <i class="fas fa-wave-square me-2"></i> Gelombang & Tahapan
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="ppdbTabContent">
                        
                        <!-- TAB 1: INFO DASAR -->
                        <div class="tab-pane fade show active" id="infoTab" role="tabpanel" aria-labelledby="info-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahun_ajaran" class="font-weight-bold">
                                            Tahun Ajaran <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" 
                                               id="tahun_ajaran" name="tahun_ajaran" 
                                               placeholder="Contoh: 2024/2025" 
                                               value="{{ old('tahun_ajaran') }}" required>
                                        @error('tahun_ajaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Biaya Pendaftaran -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="biaya_pendaftaran" class="font-weight-bold">
                                            Biaya Pendaftaran <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('biaya_pendaftaran') is-invalid @enderror" 
                                               id="biaya_pendaftaran" name="biaya_pendaftaran" 
                                               placeholder="Contoh: Gratis atau 100.000" 
                                               value="{{ old('biaya_pendaftaran') }}" required>
                                        @error('biaya_pendaftaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan_biaya" class="font-weight-bold">Keterangan Biaya</label>
                                        <input type="text" class="form-control" 
                                               id="keterangan_biaya" name="keterangan_biaya" 
                                               placeholder="Contoh: Sudah termasuk SPP"
                                               value="{{ old('keterangan_biaya') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Syarat Pendaftaran -->
                            <div class="form-group">
                                <label for="syarat_pendaftaran" class="font-weight-bold">
                                    Syarat Pendaftaran <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('syarat_pendaftaran') is-invalid @enderror" 
                                          id="syarat_pendaftaran" 
                                          name="syarat_pendaftaran" 
                                          rows="8" 
                                          placeholder="Tuliskan syarat-syarat pendaftaran PPDB...&#10;&#10;Contoh:&#10;1. Fotokopi Akta Kelahiran&#10;2. Fotokopi Kartu Keluarga&#10;3. Pas Foto 3x4 (2 lembar)&#10;4. ..."
                                          required>{{ old('syarat_pendaftaran') }}</textarea>
                                @error('syarat_pendaftaran')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Tuliskan syarat dengan jelas dan detail untuk memudahkan calon peserta didik
                                </small>
                            </div>

                            <!-- Gambar Brosur -->
                            <div class="form-group">
                                <label for="gambar_brosur" class="font-weight-bold">Brosur PPDB</label>
                                <div class="custom-file">
                                    <input type="file" 
                                           class="custom-file-input @error('gambar_brosur') is-invalid @enderror" 
                                           id="gambar_brosur" 
                                           name="gambar_brosur"
                                           accept="image/*">
                                    <label class="custom-file-label" for="gambar_brosur">Pilih brosur...</label>
                                </div>
                                <small class="form-text text-muted">
                                    Upload brosur PPDB. Format: JPG, PNG, GIF. Maksimal 2MB
                                </small>
                                @error('gambar_brosur')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                
                                <!-- Preview Image -->
                                <div id="preview-container" class="mt-3" style="display: none;">
                                    <p class="font-weight-bold">Preview:</p>
                                    <img id="preview-image" src="#" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: KONTAK & LOKASI -->
                        <div class="tab-pane fade" id="kontakTab" role="tabpanel" aria-labelledby="kontak-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon" class="font-weight-bold">Nomor Telepon</label>
                                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" 
                                               id="telepon" name="telepon" 
                                               placeholder="Contoh: 081234567890"
                                               value="{{ old('telepon') }}">
                                        @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="font-weight-bold">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" 
                                               placeholder="Contoh: ppdb@sekolah.com"
                                               value="{{ old('email') }}">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat" class="font-weight-bold">Alamat Lengkap</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          id="alamat" 
                                          name="alamat" 
                                          rows="4" 
                                          placeholder="Tuliskan alamat lengkap sekolah">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lokasi_kantor" class="font-weight-bold">Lokasi Kantor (URL Google Maps)</label>
                                <input type="url" class="form-control @error('lokasi_kantor') is-invalid @enderror" 
                                       id="lokasi_kantor" name="lokasi_kantor" 
                                       placeholder="https://maps.google.com/..."
                                       value="{{ old('lokasi_kantor') }}">
                                @error('lokasi_kantor')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Salin URL dari Google Maps untuk lokasi sekolah
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="link_pendaftaran" class="font-weight-bold">Link Pendaftaran Online</label>
                                <input type="url" class="form-control @error('link_pendaftaran') is-invalid @enderror" 
                                       id="link_pendaftaran" name="link_pendaftaran" 
                                       placeholder="https://pendaftaran.sekolah.com"
                                       value="{{ old('link_pendaftaran') }}">
                                @error('link_pendaftaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- TAB 3: GELOMBANG & TAHAPAN -->
                        <div class="tab-pane fade" id="gelombangTab" role="tabpanel" aria-labelledby="gelombang-tab">
                            <div class="alert alert-info mb-4">
                                <i class="fas fa-info-circle"></i> <strong>Info:</strong> Tambahkan gelombang dan tahapan pendaftaran di sini
                            </div>

                            <div id="gelombangContainer">
                                <!-- Gelombang akan ditambahkan di sini -->
                            </div>

                            <button type="button" class="btn btn-success" id="addGelombangBtn">
                                <i class="fas fa-plus"></i> Tambah Gelombang
                            </button>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> Simpan Info PPDB
                        </button>
                        <a href="{{ route('info-ppdb.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview Brosur
    const brosurInput = document.getElementById('gambar_brosur');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const fileLabel = document.querySelector('.custom-file-label');
    
    if (brosurInput) {
        brosurInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                fileLabel.textContent = file.name;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                fileLabel.textContent = 'Pilih brosur...';
                previewContainer.style.display = 'none';
            }
        });
    }

    // Gelombang Management
    let gelombangCount = 0;

    function addGelombangField() {
        gelombangCount++;
        const gelombangHTML = `
            <div class="card mb-3 gelombang-card" data-gelombang="${gelombangCount}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="fas fa-wave-square"></i> Gelombang ${gelombangCount}
                    </h6>
                    <button type="button" class="btn btn-sm btn-danger removeGelombangBtn">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Gelombang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" 
                                       name="gelombang[${gelombangCount - 1}][nama_gelombang]" 
                                       placeholder="Contoh: Gelombang 1"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Nomor Gelombang <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" 
                                       name="gelombang[${gelombangCount - 1}][nomor_gelombang]" 
                                       placeholder="1, 2, 3..."
                                       min="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" 
                                       name="gelombang[${gelombangCount - 1}][tanggal_mulai]" 
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" 
                                       name="gelombang[${gelombangCount - 1}][tanggal_selesai]" 
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Keterangan</label>
                        <textarea class="form-control" 
                                  name="gelombang[${gelombangCount - 1}][keterangan]" 
                                  rows="2" 
                                  placeholder="Keterangan gelombang (opsional)"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 font-weight-bold">Tahapan</h6>
                            <button type="button" class="btn btn-sm btn-info addTahapanBtn">
                                <i class="fas fa-plus"></i> Tambah Tahapan
                            </button>
                        </div>
                    </div>

                    <div class="tahapanContainer" data-gelombang="${gelombangCount}">
                        <!-- Tahapan akan ditambahkan di sini -->
                    </div>
                </div>
            </div>
        `;

        document.getElementById('gelombangContainer').insertAdjacentHTML('beforeend', gelombangHTML);
        
        // Attach event listener untuk remove gelombang
        document.querySelector(`[data-gelombang="${gelombangCount}"] .removeGelombangBtn`).addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(`[data-gelombang="${gelombangCount}"]`).remove();
        });

        // Attach event listener untuk add tahapan
        document.querySelector(`[data-gelombang="${gelombangCount}"] .addTahapanBtn`).addEventListener('click', function(e) {
            e.preventDefault();
            addTahapanField(gelombangCount);
        });
    }

    function addTahapanField(gelombangNum) {
        const tahapanContainer = document.querySelector(`[data-gelombang="${gelombangNum}"] .tahapanContainer`);
        const tahapanCount = tahapanContainer.querySelectorAll('.tahapan-item').length + 1;
        
        const tahapanHTML = `
            <div class="card card-sm mb-2 tahapan-item" style="border-left: 4px solid #007bff;">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="mb-0">Tahapan ${tahapanCount}</h6>
                        <button type="button" class="btn btn-sm btn-danger removeTahapanBtn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold" style="font-size: 0.9rem;">Nama Tahapan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" 
                                       name="gelombang[${gelombangNum - 1}][tahapan][${tahapanCount - 1}][nama_tahapan]" 
                                       placeholder="Contoh: Pendaftaran Online"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold" style="font-size: 0.9rem;">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" 
                                       name="gelombang[${gelombangNum - 1}][tahapan][${tahapanCount - 1}][tanggal_mulai]" 
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold" style="font-size: 0.9rem;">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" 
                                       name="gelombang[${gelombangNum - 1}][tahapan][${tahapanCount - 1}][tanggal_selesai]" 
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" style="font-size: 0.9rem;">Deskripsi</label>
                        <textarea class="form-control form-control-sm" 
                                  name="gelombang[${gelombangNum - 1}][tahapan][${tahapanCount - 1}][deskripsi]" 
                                  rows="2" 
                                  placeholder="Deskripsi tahapan (opsional)"></textarea>
                    </div>
                </div>
            </div>
        `;

        tahapanContainer.insertAdjacentHTML('beforeend', tahapanHTML);
        
        // Attach event listener untuk remove tahapan
        tahapanContainer.querySelector('.tahapan-item:last-child .removeTahapanBtn').addEventListener('click', function(e) {
            e.preventDefault();
            tahapanContainer.querySelector('.tahapan-item:last-child').remove();
        });
    }

    // Add Gelombang Button
    document.getElementById('addGelombangBtn').addEventListener('click', function(e) {
        e.preventDefault();
        addGelombangField();
    });
    
});
</script>
@endpush
@endsection