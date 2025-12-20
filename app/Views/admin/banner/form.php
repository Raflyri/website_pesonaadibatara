<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark"><?= $title; ?></h3>
    <a href="/admin/banner" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        
        <?php $action = isset($banner) ? '/admin/banner/save/' . $banner['id'] : '/admin/banner/save'; ?>
        
        <form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Judul Utama (Indonesia)</label>
                        <input type="text" name="title" class="form-control" value="<?= old('title', $banner['title'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Sub-Judul (Indonesia)</label>
                        <textarea name="subtitle" class="form-control" rows="2"><?= old('subtitle', $banner['subtitle'] ?? ''); ?></textarea>
                    </div>

                    <hr class="my-4 border-secondary opacity-25">

                    <div class="mb-4 bg-light p-3 rounded">
                        <label class="form-label fw-bold text-muted small text-uppercase mb-3"><img src="https://flagcdn.com/16x12/gb.png" class="me-2">English Version</label>
                        
                        <div class="mb-3">
                            <label class="small text-muted">Title (EN)</label>
                            <input type="text" name="title_en" class="form-control" value="<?= old('title_en', $banner['title_en'] ?? ''); ?>">
                        </div>
                        <div>
                            <label class="small text-muted">Subtitle (EN)</label>
                            <textarea name="subtitle_en" class="form-control" rows="2"><?= old('subtitle_en', $banner['subtitle_en'] ?? ''); ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <label class="form-label fw-bold mb-3">Gambar Banner</label>
                            
                            <?php if (isset($banner) && $banner['image']) : ?>
                                <img src="<?= base_url('uploads/banners/' . $banner['image']); ?>" class="img-fluid rounded mb-3 shadow-sm">
                            <?php endif; ?>

                            <input type="file" name="image" class="form-control mb-2" accept="image/*">
                            <div class="form-text small text-muted">Format: JPG/PNG/WEBP. Max 2MB. Resolusi rekomen: 1920x1080px.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Teks Tombol</label>
                        <input type="text" name="button_text" class="form-control" placeholder="Contoh: Selengkapnya" value="<?= old('button_text', $banner['button_text'] ?? 'Selengkapnya'); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Link Tombol</label>
                        <input type="text" name="button_link" class="form-control" placeholder="Contoh: /about atau https://..." value="<?= old('button_link', $banner['button_link'] ?? '#'); ?>">
                    </div>
                    
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label fw-bold">Urutan</label>
                            <input type="number" name="urutan" class="form-control" value="<?= old('urutan', $banner['urutan'] ?? '1'); ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Status</label>
                            <select name="is_active" class="form-select">
                                <option value="1" <?= (isset($banner) && $banner['is_active'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                                <option value="0" <?= (isset($banner) && $banner['is_active'] == 0) ? 'selected' : ''; ?>>Non-Aktif</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4 rounded-pill fw-bold shadow">
                        <i class="fas fa-save me-2"></i> Simpan Banner
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>