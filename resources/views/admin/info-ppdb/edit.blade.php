{{-- resources/views/admin/info-ppdb/edit.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Info PPDB</h1>
    <a href="{{ route('info-ppdb.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-edit"></i> Edit Info PPDB
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('info-ppdb.update', $infoPpdb->id_info_ppdb) }}" method="POST" enctype="multipart/form-data" id="formPpdb">
                    @csrf
                    @method('PUT')
                    
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
                                               value="{{ old('tahun_ajaran', $infoPpdb->tahun_ajaran) }}" required>
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
                                               value="{{ old('biaya_pendaftaran', $infoPpdb->biaya_pendaftaran) }}" required>
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
                                               value="{{ old('keterangan_biaya', $infoPpdb->keterangan_biaya) }}">
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
                                          placeholder="Tuliskan syarat-syarat pendaftaran PPDB..."
                                          required>{{ old('syarat_pendaftaran', $infoPpdb->syarat_pendaftaran) }}</textarea>
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
                                
                                @if($infoPpdb->gambar_brosur)
                                <div class="mb-3">
                                    <p class="font-weight-bold">Brosur Saat Ini:</p>
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ asset('storage/' . $infoPpdb->gambar_brosur) }}" 
                                             alt="Brosur PPDB" 
                                             class="img-thumbnail"
                                             id="current-brosur"
                                             style="max-width: 400px; max-height: 300px; object-fit: contain;">
                                        <button type="button" 
                                                class="btn btn-danger btn-sm position-absolute" 
                                                style="top: 10px; right: 10px;"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteBrosurModal">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                                @endif
                                
                                <div class="mb-2">
                                    <input type="file" 
                                           class="form-control @error('gambar_brosur') is-invalid @enderror" 
                                           id="gambar_brosur" 
                                           name="gambar_brosur"
                                           accept="image/*">
                                </div>
                                <small class="form-text text-muted">
                                    Upload brosur PPDB. Format: JPG, PNG, GIF. Maksimal 2MB
                                </small>
                                @error('gambar_brosur')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                
                                <!-- Preview Image Baru -->
                                <div id="preview-container" class="mt-3" style="display: none;">
                                    <p class="font-weight-bold">Preview Brosur Baru:</p>
                                    <img id="preview-image" src="#" alt="Preview" class="img-thumbnail" style="max-width: 400px;">
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
                                               value="{{ old('telepon', $infoPpdb->telepon) }}">
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
                                               value="{{ old('email', $infoPpdb->email) }}">
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
                                          placeholder="Tuliskan alamat lengkap sekolah">{{ old('alamat', $infoPpdb->alamat) }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lokasi_kantor" class="font-weight-bold">Lokasi Kantor (URL Google Maps)</label>
                                <input type="url" class="form-control @error('lokasi_kantor') is-invalid @enderror" 
                                       id="lokasi_kantor" name="lokasi_kantor" 
                                       placeholder="https://maps.google.com/..."
                                       value="{{ old('lokasi_kantor', $infoPpdb->lokasi_kantor) }}">
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
                                       value="{{ old('link_pendaftaran', $infoPpdb->link_pendaftaran) }}">
                                @error('link_pendaftaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- TAB 3: GELOMBANG & TAHAPAN -->
                        <div class="tab-pane fade" id="gelombangTab" role="tabpanel" aria-labelledby="gelombang-tab">
                            <div class="alert alert-info mb-4">
                                <i class="fas fa-info-circle"></i> <strong>Info:</strong> Kelola gelombang dan tahapan pendaftaran PPDB
                            </div>

                            <div id="gelombangContainer">
                                @foreach($infoPpdb->gelombang as $index => $gelombang)
                                <div class="card mb-3 gelombang-card" data-gelombang-index="{{ $index }}">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">
                                            <i class="fas fa-wave-square"></i> {{ $gelombang->nama_gelombang }}
                                        </h6>
                                        <button type="button" class="btn btn-sm btn-danger removeGelombangBtn">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="gelombang[{{ $index }}][id_gelombang]" value="{{ $gelombang->id_gelombang }}">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Nama Gelombang <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" 
                                                           name="gelombang[{{ $index }}][nama_gelombang]" 
                                                           value="{{ $gelombang->nama_gelombang }}"
                                                           placeholder="Contoh: Gelombang 1"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Nomor Gelombang <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" 
                                                           name="gelombang[{{ $index }}][nomor_gelombang]" 
                                                           value="{{ $gelombang->nomor_gelombang }}"
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
                                                           name="gelombang[{{ $index }}][tanggal_mulai]" 
                                                           value="{{ $gelombang->tanggal_mulai->format('Y-m-d') }}"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" 
                                                           name="gelombang[{{ $index }}][tanggal_selesai]" 
                                                           value="{{ $gelombang->tanggal_selesai->format('Y-m-d') }}"
                                                           required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <textarea class="form-control" 
                                                      name="gelombang[{{ $index }}][keterangan]" 
                                                      rows="2" 
                                                      placeholder="Keterangan gelombang (opsional)">{{ $gelombang->keterangan }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0 font-weight-bold">Tahapan</h6>
                                                <button type="button" class="btn btn-sm btn-info addTahapanBtn">
                                                    <i class="fas fa-plus"></i> Tambah Tahapan
                                                </button>
                                            </div>
                                        </div>

                                        <div class="tahapanContainer">
                                            @foreach($gelombang->tahapan as $tahapanIndex => $tahapan)
                                            <div class="card card-sm mb-2 tahapan-item" style="border-left: 4px solid #007bff;">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <h6 class="mb-0">{{ $tahapan->nama_tahapan }}</h6>
                                                        <button type="button" class="btn btn-sm btn-danger removeTahapanBtn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>

                                                    <input type="hidden" name="gelombang[{{ $index }}][tahapan][{{ $tahapanIndex }}][id_tahapan]" value="{{ $tahapan->id_tahapan }}">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold" style="font-size: 0.9rem;">Nama Tahapan <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control form-control-sm" 
                                                                       name="gelombang[{{ $index }}][tahapan][{{ $tahapanIndex }}][nama_tahapan]" 
                                                                       value="{{ $tahapan->nama_tahapan }}"
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
                                                                       name="gelombang[{{ $index }}][tahapan][{{ $tahapanIndex }}][tanggal_mulai]" 
                                                                       value="{{ $tahapan->tanggal_mulai->format('Y-m-d') }}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold" style="font-size: 0.9rem;">Tanggal Selesai <span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control form-control-sm" 
                                                                       name="gelombang[{{ $index }}][tahapan][{{ $tahapanIndex }}][tanggal_selesai]" 
                                                                       value="{{ $tahapan->tanggal_selesai->format('Y-m-d') }}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold" style="font-size: 0.9rem;">Deskripsi</label>
                                                        <textarea class="form-control form-control-sm" 
                                                                  name="gelombang[{{ $index }}][tahapan][{{ $tahapanIndex }}][deskripsi]" 
                                                                  rows="2" 
                                                                  placeholder="Deskripsi tahapan (opsional)">{{ $tahapan->deskripsi }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
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
                            <i class="fas fa-save"></i> Update Info PPDB
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

<!-- Modal Delete Brosur -->
@if($infoPpdb->gambar_brosur)
<div class="modal fade" id="deleteBrosurModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Brosur</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus brosur ini?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('info-ppdb.delete-brosur', $infoPpdb->id_info_ppdb) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Brosur</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview Brosur
    const brosurInput = document.getElementById('gambar_brosur');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const currentBrosur = document.getElementById('current-brosur');

    if (brosurInput) {
        brosurInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                    if (currentBrosur) currentBrosur.style.opacity = '0.5';
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
                if (currentBrosur) currentBrosur.style.opacity = '1';
            }
        });
    }

    // Helpers untuk reindexing (penting agar nama input berurutan)
    function reindexAll() {
        const gelombangCards = document.querySelectorAll('.gelombang-card');
        gelombangCards.forEach((card, gIndex) => {
            card.setAttribute('data-gelombang-index', gIndex);

            // Update heading
            const heading = card.querySelector('.card-header h6');
            if (heading) heading.textContent = `Gelombang ${gIndex + 1}`;

            // Update all input/textarea names inside this gelombang
            // gelombang[INDEX][field]
            const inputs = card.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                // skip file input preview etc
                const name = input.getAttribute('name');
                if (!name) return;

                // replace starting part: gelombang[OLD] with gelombang[gIndex]
                const newName = name.replace(/^gelombang\[\d+\]/, `gelombang[${gIndex}]`);
                input.setAttribute('name', newName);
            });

            // Reindex tahapan inside
            const tahapanContainer = card.querySelector('.tahapanContainer') || card.querySelector('.tahapanContainer') || card.querySelector('.tahapanContainer');
            // fallback: find by class
            const tahapanParent = card.querySelector('.tahapanContainer') || card.querySelector('.tahapanContainer') || card.querySelector('.tahapanContainer');
            // However in our markup above we used generic .tahapanContainer only for new ones; for existing we used direct .tahapanContainer inside card-body
            const tahapanItems = card.querySelectorAll('.tahapan-item');
            tahapanItems.forEach((tItem, tIndex) => {
                // Update input names inside tahapan
                const tahapanInputs = tItem.querySelectorAll('input, textarea, select');
                tahapanInputs.forEach(ti => {
                    const tName = ti.getAttribute('name');
                    if (!tName) return;
                    // replace gelombang[OLD][tahapan][OLD2]... with gelombang[gIndex][tahapan][tIndex]
                    const replaced = tName.replace(/^gelombang\[\d+\]\[tahapan\]\[\d+\]/, `gelombang[${gIndex}][tahapan][${tIndex}]`);
                    // also replace patterns like gelombang[OLD][tahapan][OLD2][field]
                    const replaced2 = tName.replace(/^gelombang\[\d+\]\[tahapan\]\[\d+\]/, `gelombang[${gIndex}][tahapan][${tIndex}]`);
                    ti.setAttribute('name', replaced2);
                });
            });
        });
    }

    // Attach remove handlers for existing buttons
    function attachExistingRemoveHandlers() {
        document.querySelectorAll('.removeGelombangBtn').forEach(btn => {
            btn.removeEventListener('click', gelombangRemoveHandler);
            btn.addEventListener('click', gelombangRemoveHandler);
        });

        document.querySelectorAll('.removeTahapanBtn').forEach(btn => {
            btn.removeEventListener('click', tahapanRemoveHandler);
            btn.addEventListener('click', tahapanRemoveHandler);
        });

        document.querySelectorAll('.addTahapanBtn').forEach(btn => {
            btn.removeEventListener('click', addTahapanHandler);
            btn.addEventListener('click', addTahapanHandler);
        });
    }

    function gelombangRemoveHandler(e) {
        e.preventDefault();
        if (!confirm('Yakin ingin menghapus gelombang ini?')) return;
        const card = this.closest('.gelombang-card');
        if (card) card.remove();
        reindexAll();
    }

    function tahapanRemoveHandler(e) {
        e.preventDefault();
        if (!confirm('Yakin ingin menghapus tahapan ini?')) return;
        const tahapan = this.closest('.tahapan-item');
        if (tahapan) tahapan.remove();
        reindexAll();
    }

    function addTahapanHandler(e) {
        e.preventDefault();
        const gelCard = this.closest('.gelombang-card');
        const gelIndex = parseInt(gelCard.getAttribute('data-gelombang-index'));
        addTahapanField(gelIndex);
    }

    // Add Gelombang
    document.getElementById('addGelombangBtn').addEventListener('click', function(e) {
        e.preventDefault();
        addGelombangField();
    });

    function addGelombangField() {
        const container = document.getElementById('gelombangContainer');
        const currentCount = container.querySelectorAll('.gelombang-card').length;
        const gIndex = currentCount; // zero-based

        const html = `
        <div class="card mb-3 gelombang-card" data-gelombang-index="${gIndex}">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Gelombang ${gIndex + 1}</h6>
                <button type="button" class="btn btn-sm btn-danger removeGelombangBtn">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Nama Gelombang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="gelombang[${gIndex}][nama_gelombang]" placeholder="Contoh: Gelombang ${gIndex + 1}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Nomor Gelombang <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="gelombang[${gIndex}][nomor_gelombang]" placeholder="1" min="1" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="gelombang[${gIndex}][tanggal_mulai]" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="gelombang[${gIndex}][tanggal_selesai]" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Keterangan</label>
                    <textarea class="form-control" name="gelombang[${gIndex}][keterangan]" rows="2" placeholder="Keterangan gelombang (opsional)"></textarea>
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold">Tahapan</h6>
                        <button type="button" class="btn btn-sm btn-info addTahapanBtn">
                            <i class="fas fa-plus"></i> Tambah Tahapan
                        </button>
                    </div>
                </div>

                <div class="tahapanContainer">
                    <!-- new tahapan inserted here -->
                </div>
            </div>
        </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        attachExistingRemoveHandlers();
        reindexAll();
    }

    function addTahapanField(gelIndex) {
        const gelCard = document.querySelector(`.gelombang-card[data-gelombang-index="${gelIndex}"]`);
        if (!gelCard) return;
        const tahapanContainer = gelCard.querySelector('.tahapanContainer');
        const tahapanCount = tahapanContainer.querySelectorAll('.tahapan-item').length;

        const html = `
        <div class="card card-sm mb-2 tahapan-item" style="border-left: 4px solid #007bff;">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="mb-0">Tahapan ${tahapanCount + 1}</h6>
                    <button type="button" class="btn btn-sm btn-danger removeTahapanBtn">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" style="font-size: 0.9rem;">Nama Tahapan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="gelombang[${gelIndex}][tahapan][${tahapanCount}][nama_tahapan]" placeholder="Contoh: Pendaftaran Online" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" style="font-size: 0.9rem;">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" name="gelombang[${gelIndex}][tahapan][${tahapanCount}][tanggal_mulai]" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" style="font-size: 0.9rem;">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" name="gelombang[${gelIndex}][tahapan][${tahapanCount}][tanggal_selesai]" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" style="font-size: 0.9rem;">Deskripsi</label>
                    <textarea class="form-control form-control-sm" name="gelombang[${gelIndex}][tahapan][${tahapanCount}][deskripsi]" rows="2" placeholder="Deskripsi tahapan (opsional)"></textarea>
                </div>
            </div>
        </div>
        `;

        tahapanContainer.insertAdjacentHTML('beforeend', html);
        attachExistingRemoveHandlers();
        reindexAll();
    }

    // initial attach
    attachExistingRemoveHandlers();
    reindexAll();

});
</script>
@endpush
@endsection
