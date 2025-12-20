<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<h3 class="fw-bold text-dark mb-4">Kelola Tentang Kami</h3>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
<?php endif; ?>

<form action="/admin/about-editor/update" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white pt-3 px-4 border-bottom-0">
            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button">Sejarah</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold" id="vision-tab" data-bs-toggle="tab" data-bs-target="#vision" type="button">Visi & Misi</button>
                </li>
            </ul>
        </div>
        
        <div class="card-body p-4">
            <div class="tab-content" id="myTabContent">
                
                <div class="tab-pane fade show active" id="history" role="tabpanel">
                    <h5 class="text-primary fw-bold mb-3">Sejarah Perusahaan</h5>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul (ID)</label>
                                <input type="text" name="history_title_id" class="form-control" value="<?= $history['title_id']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Konten Sejarah (ID)</label>
                                <textarea name="history_content_id" class="form-control" rows="6"><?= $history['content_id']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Foto Ilustrasi</label>
                                <?php if($history['media_url']): ?>
                                    <img src="<?= base_url('uploads/about/'.$history['media_url']); ?>" class="img-fluid rounded mb-2">
                                <?php endif; ?>
                                <input type="file" name="history_image" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="vision" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary fw-bold mb-3">Visi</h5>
                            <textarea name="vision_id" class="form-control mb-3" rows="4" placeholder="Visi Indonesia"><?= $vision['content_id']; ?></textarea>
                            <textarea name="vision_en" class="form-control bg-light" rows="4" placeholder="Visi English"><?= $vision['content_en']; ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary fw-bold mb-3">Misi</h5>
                            <textarea name="mission_id" class="form-control mb-3" rows="4" placeholder="Misi Indonesia"><?= $mission['content_id']; ?></textarea>
                            <textarea name="mission_en" class="form-control bg-light" rows="4" placeholder="Misi English"><?= $mission['content_en']; ?></textarea>
                            <small class="text-muted">*Gunakan Enter untuk poin baru</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer bg-white border-0 text-end pb-4 pe-4">
            <button type="submit" class="btn btn-primary rounded-pill px-5 shadow">Simpan Perubahan</button>
        </div>
    </div>
</form>

<?= $this->endSection(); ?>