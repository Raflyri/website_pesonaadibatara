<?= $this->extend('panel-pab/layout/template'); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin_about.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4 pt-2">
    <div>
        <h3 class="fw-bold text-dark mb-1">Pengaturan Perusahaan</h3>
        <p class="text-muted mb-0 small">Kelola profil, identitas visual, dan konten "Tentang Kami".</p>
    </div>
    <button type="button" onclick="document.getElementById('aboutForm').submit();" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">
        <i class="fas fa-save me-2"></i> Simpan Perubahan
    </button>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <div class="d-flex align-items-center">
            <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle me-3">
                <i class="fas fa-check"></i>
            </div>
            <div>
                <strong>Berhasil!</strong> <?= session()->getFlashdata('success'); ?>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <strong>Terjadi Kesalahan:</strong>
        <ul class="mb-0 ps-3">
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form action="/panel-pab/about-editor/update" method="post" enctype="multipart/form-data" id="aboutForm">
    <?= csrf_field(); ?>

    <div class="card settings-content-card">

        <div class="card-header bg-white pt-4 pb-0 border-0">
            <div class="custom-tabs-container">
                <ul class="nav nav-pills custom-nav-tabs" id="aboutTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="detail-tab" data-bs-toggle="pill" data-bs-target="#detail" type="button">
                            <i class="fas fa-building"></i> Identitas & Logo
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="history-tab" data-bs-toggle="pill" data-bs-target="#history" type="button">
                            <i class="fas fa-history"></i> Sejarah
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vision-tab" data-bs-toggle="pill" data-bs-target="#vision" type="button">
                            <i class="fas fa-bullseye"></i> Visi & Misi
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="compro-tab" data-bs-toggle="pill" data-bs-target="#compro" type="button">
                            <i class="fas fa-file-pdf"></i> Company Profile
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card-body p-4 pt-2">
            <div class="tab-content" id="aboutTabContent">

                <div class="tab-pane fade show active" id="detail" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="hero-logo-section h-100">
                                <div class="logo-circle-wrapper">
                                    <img src="<?= !empty($company_icon) ? base_url('assets/img/' . $company_icon) : base_url('assets/img/logo-pab.png'); ?>"
                                        id="logoPreview" alt="Logo Perusahaan">

                                    <label for="companyIconInput" class="btn-upload-float" title="Ganti Logo">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                    <input type="file" class="d-none" id="companyIconInput" name="company_icon" accept="image/*" onchange="previewImage()">
                                </div>

                                <h6 class="fw-bold text-dark mb-1">Logo Perusahaan</h6>
                                <p class="text-muted small mb-0">Disarankan format PNG Transparan</p>

                                <div id="fileInfo" class="d-none">
                                    <div class="upload-success-badge">
                                        <i class="fas fa-check-circle"></i>
                                        <span id="fileName" class="fw-bold text-truncate" style="max-width: 150px;">logo-baru.png</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="ps-lg-3">
                                <h5 class="form-section-title">Informasi Dasar</h5>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Nama Perusahaan</label>
                                    <input type="text" class="form-control input-modern" name="company_name"
                                        value="<?= $company_name ?? 'PT. Pesona Adi Batara'; ?>" placeholder="Nama Lengkap PT" readonly title="Ubah melalui pengaturan database/superadmin jika perlu">
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="form-label fw-bold text-muted small text-uppercase mb-0">Tagline Utama</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="showTaglineSwitch" name="show_company_tagline" value="1" <?= (isset($show_company_tagline) && $show_company_tagline == '0') ? '' : 'checked'; ?>>
                                                <label class="form-check-label small text-muted" for="showTaglineSwitch">Tampilkan di Website</label>
                                            </div>
                                        </div>
                                        <textarea class="form-control input-modern" name="company_tagline" rows="2"
                                            placeholder="Slogan perusahaan..."><?= $company_tagline ?? ''; ?></textarea>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Pengaturan Font Tagline</label>

                                    <div class="row g-3">
                                        <!-- Font Family -->
                                        <div class="col-md-12">
                                            <label class="small text-muted mb-1">Jenis Font (Google Fonts)</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white"><i class="fas fa-font"></i></span>
                                                <select class="form-select input-modern" name="company_tagline_font">
                                                    <option value="" <?= empty($company_tagline_font) ? 'selected' : ''; ?>>-- Pilih Font --</option>
                                                    <?php
                                                    $fonts = [
                                                        'Roboto',
                                                        'Open Sans',
                                                        'Lato',
                                                        'Montserrat',
                                                        'Poppins',
                                                        'Oswald',
                                                        'Source Sans Pro',
                                                        'Slabo 27px',
                                                        'Raleway',
                                                        'PT Sans',
                                                        'Merriweather',
                                                        'Nunito',
                                                        'Playfair Display',
                                                        'Rubik',
                                                        'Lora',
                                                        'Fira Sans',
                                                        'Work Sans',
                                                        'Quicksand',
                                                        'Karla',
                                                        'Syne',
                                                        'Inter',
                                                        'Ubuntu',
                                                        'Mulish',
                                                        'Dancing Script',
                                                        'Pacifico',
                                                        'Shadows Into Light',
                                                        'Indie Flower',
                                                        'Amatic SC',
                                                        'Caveat',
                                                        'Comfortaa',
                                                        'Edu SA Hand',
                                                    ];
                                                    sort($fonts);
                                                    foreach ($fonts as $f):
                                                    ?>
                                                        <option value="<?= $f; ?>" <?= ($company_tagline_font == $f) ? 'selected' : ''; ?>><?= $f; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Font Size -->
                                        <div class="col-md-6">
                                            <label class="small text-muted mb-1">Ukuran Font (px)</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control input-modern" name="company_tagline_size"
                                                    value="<?= $company_tagline_size ?? '36'; ?>" min="12" max="100">
                                                <span class="input-group-text bg-light">px</span>
                                            </div>
                                        </div>

                                        <!-- Font Color -->
                                        <div class="col-md-6">
                                            <label class="small text-muted mb-1">Warna Font</label>
                                            <div class="d-flex align-items-center border rounded p-1 input-modern bg-white">
                                                <input type="color" class="form-control form-control-color border-0 p-0 m-1"
                                                    id="fontColorPicker" name="company_tagline_color"
                                                    value="<?= $company_tagline_color ?? '#ffffff'; ?>" title="Pilih Warna">
                                                <label for="fontColorPicker" class="small ms-2 text-muted user-select-none">Pilih Warna</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="history" role="tabpanel">
                    <div class="p-2">
                        <h5 class="form-section-title">Cerita Perjalanan Bisnis</h5>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">Judul Bagian</label>
                            <input type="text" class="form-control input-modern" name="history_title_id"
                                value="<?= $history['title_id'] ?? 'Sejarah Perusahaan'; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">Isi Konten</label>
                            <textarea class="form-control summernote" name="history_content_id"><?= $history['content_id'] ?? ''; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">Gambar Sejarah (Opsional)</label>
                            <input type="file" class="form-control input-modern" name="history_image" accept="image/*">
                            <?php if (!empty($history['media_url'])): ?>
                                <small class="text-success"><i class="fas fa-check"></i> Gambar saat ini: <?= $history['media_url'] ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="vision" role="tabpanel">
                    <div class="row g-4 p-2">
                        <div class="col-md-12">
                            <h5 class="form-section-title text-primary"><i class="fas fa-eye me-2"></i>Visi Perusahaan</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">Bahasa Indonesia (Vision ID)</label>
                                    <textarea class="form-control summernote" name="vision_id"><?= $vision['content_id'] ?? ''; ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">Bahasa Inggris (Vision EN)</label>
                                    <textarea class="form-control summernote" name="vision_en"><?= $vision['content_en'] ?? ''; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <h5 class="form-section-title text-success"><i class="fas fa-list-check me-2"></i>Misi Perusahaan</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">Bahasa Indonesia (Mission ID)</label>
                                    <textarea class="form-control summernote" name="mission_id"><?= $mission['content_id'] ?? ''; ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">Bahasa Inggris (Mission EN)</label>
                                    <textarea class="form-control summernote" name="mission_en"><?= $mission['content_en'] ?? ''; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="compro" role="tabpanel">
                    <div class="row p-4">
                        <div class="col-md-7 border-end">
                            <h5 class="form-section-title">Dokumen Profil (PDF)</h5>
                            <div class="d-flex flex-column align-items-center justify-content-center p-4 bg-light rounded-3 border-dashed border">
                                <i class="fas fa-file-pdf fa-3x text-danger opacity-75 mb-3"></i>
                                <p class="text-muted text-center small mb-3">Upload file PDF profil perusahaan (Max 5MB).</p>

                                <input type="file" class="form-control input-modern mb-3" name="compro_file" accept=".pdf">

                                <?php if (!empty($compro_file)) : ?>
                                    <div class="alert alert-white border shadow-sm d-inline-flex align-items-center mb-0 px-3 py-2 rounded-pill">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span class="small me-3 text-truncate" style="max-width: 150px;"><?= $compro_file; ?></span>
                                        <a href="<?= base_url('uploads/doc/' . $compro_file); ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-5 ps-md-4">
                            <h5 class="form-section-title">Link Eksternal</h5>
                            <p class="text-muted small">Jika file terlalu besar, Anda bisa menyertakan link Google Drive atau Dropbox.</p>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted small text-uppercase">URL Link Profil</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 border py-2"><i class="fas fa-link text-muted"></i></span>
                                    <input type="url" class="form-control input-modern border-start-0 ps-0" name="compro_link"
                                        value="<?= $compro_link ?? ''; ?>"
                                        placeholder="https://drive.google.com/...">
                                </div>
                            </div>

                            <div class="alert alert-info bg-opacity-10 border-0 small d-flex align-items-start">
                                <i class="fas fa-info-circle mt-1 me-2"></i>
                                <div>
                                    Prioritas: Jika link diisi, tombol "Download" di website akan mengarah ke link ini. Jika kosong, akan mendownload file PDF.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    function previewImage() {
        const input = document.getElementById('companyIconInput');
        const preview = document.getElementById('logoPreview');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);

            fileName.innerText = file.name;
            fileInfo.classList.remove('d-none');

            // Efek feedback visual
            const wrapper = document.querySelector('.logo-circle-wrapper');
            wrapper.style.borderColor = '#198754';
            wrapper.style.boxShadow = '0 0 0 5px rgba(25, 135, 84, 0.2)';
        }
    }
</script>
<?= $this->endSection(); ?>