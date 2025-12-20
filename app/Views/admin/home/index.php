<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Kelola Beranda</h3>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white py-3">
        <h6 class="fw-bold mb-0 text-primary"><i class="fas fa-edit me-2"></i>Section: Kenapa Memilih Kami?</h6>
    </div>
    <div class="card-body p-4">
        
        <form action="/admin/home-editor/update" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="row">
                <div class="col-lg-7">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Judul Section (Indonesia)</label>
                        <input type="text" name="title_id" class="form-control" value="<?= esc($section['title_id']); ?>" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Deskripsi (Indonesia)</label>
                        <textarea name="content_id" class="form-control" rows="4" required><?= esc($section['content_id']); ?></textarea>
                    </div>

                    <hr class="border-secondary opacity-25">

                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted"><img src="https://flagcdn.com/16x12/gb.png"> Judul Section (English)</label>
                        <input type="text" name="title_en" class="form-control bg-light" value="<?= esc($section['title_en']); ?>">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted"><img src="https://flagcdn.com/16x12/gb.png"> Deskripsi (English)</label>
                        <textarea name="content_en" class="form-control bg-light" rows="4"><?= esc($section['content_en']); ?></textarea>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <label class="form-label fw-bold mb-3">Media (Video/Gambar)</label>
                            
                            <?php if (!empty($section['media_url'])) : ?>
                                <div class="ratio ratio-16x9 mb-3 rounded overflow-hidden shadow-sm bg-dark d-flex align-items-center justify-content-center">
                                    
                                    <?php 
                                        $ext = pathinfo($section['media_url'], PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp']);
                                        // Jika URL http (external), kita anggap video dulu atau sesuaikan logic
                                        $src = (strpos($section['media_url'], 'http') !== false) 
                                                ? $section['media_url'] 
                                                : base_url('uploads/home/' . $section['media_url']);
                                    ?>

                                    <?php if($isImage): ?>
                                        <img src="<?= $src; ?>" class="w-100 h-100 object-fit-cover" alt="Preview">
                                    <?php else: ?>
                                        <video controls class="w-100 h-100">
                                            <source src="<?= $src; ?>" type="video/mp4">
                                        </video>
                                    <?php endif; ?>

                                </div>
                                <small class="text-success d-block mb-3"><i class="fas fa-check-circle me-1"></i> Media aktif saat ini</small>
                            <?php else: ?>
                                <div class="alert alert-warning small">Belum ada media yang diupload.</div>
                            <?php endif; ?>

                            <input type="file" name="video_file" class="form-control" accept="video/mp4, image/*">
                            <div class="form-text small">Support: MP4, JPG, PNG. Max 10MB.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-5 shadow">
                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>