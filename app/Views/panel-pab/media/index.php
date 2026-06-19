<?= $this->extend('panel-pab/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h1 class="m-0">Media Library</h1>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-secondary active">All</button>
            <button type="button" class="btn btn-outline-secondary">Images</button>
            <button type="button" class="btn btn-outline-secondary">Videos</button>
        </div>
    </div>
    
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4 shadow-sm border-0 bg-light">
        <div class="card-body">
            <form action="/panel-pab/media/upload" method="post" enctype="multipart/form-data" class="row g-3 align-items-center">
                <?= csrf_field(); ?>
                <div class="col-auto">
                    <label for="file_upload" class="col-form-label fw-bold text-primary">
                        <i class="fas fa-cloud-upload-alt me-2"></i>Upload File Baru:
                    </label>
                </div>
                <div class="col-auto flex-grow-1">
                    <input type="file" class="form-control" name="file_upload" id="file_upload" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary px-4">Upload</button>
                </div>
            </form>
            <div class="small text-muted mt-2 ps-2">
                <i class="fas fa-info-circle me-1"></i> Mendukung format JPG, PNG, WEBP, dan MP4 (Max 10MB).
            </div>
        </div>
    </div>

    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
        <?php if(empty($files)): ?>
            <div class="col-12 text-center py-5 text-muted">
                <i class="fas fa-box-open fa-3x mb-3 opacity-50"></i>
                <p>Tidak ada file ditemukan.</p>
            </div>
        <?php else: ?>
            <?php foreach ($files as $f) : ?>
            <div class="col">
                <div class="card h-100 shadow-sm file-card position-relative group-action">
                    
                    <span class="position-absolute top-0 start-0 badge bg-dark opacity-75 m-2 rounded-1 small">
                        <?= esc($f['folder']); ?>
                    </span>

                    <div class="card-img-top overflow-hidden d-flex align-items-center justify-content-center bg-white border-bottom" style="height: 140px;">
                        <?php if($f['type'] == 'image'): ?>
                            <img src="<?= esc($f['url'], 'attr'); ?>" alt="<?= esc($f['name'], 'attr'); ?>" class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        <?php elseif($f['type'] == 'video'): ?>
                            <video src="<?= esc($f['url'], 'attr'); ?>" style="max-height: 100%; max-width: 100%;" muted playsinline onmouseover="this.play()" onmouseout="this.pause();this.currentTime=0;"></video>
                        <?php else: ?>
                            <i class="fas fa-file-alt fa-3x text-secondary"></i>
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-body p-2 bg-white">
                        <p class="card-text small text-truncate mb-1 fw-bold text-dark" title="<?= esc($f['name'], 'attr'); ?>">
                            <?= esc($f['name']); ?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-light text-secondary border"><?= $f['size']; ?></span>
                            <?php if($f['type'] == 'video'): ?>
                                <i class="fas fa-video text-muted small" title="Video"></i>
                            <?php else: ?>
                                <i class="fas fa-image text-muted small" title="Image"></i>
                            <?php endif; ?>
                        </div>
                        
                        <div class="d-grid gap-1">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="copyLink('<?= esc($f['url'], 'js'); ?>')">
                                <i class="fas fa-link"></i> Copy URL
                            </button>
                            
                            <?php if($f['is_deletable']): ?>
                                <form action="/panel-pab/media/delete" method="post" onsubmit="return confirm('Yakin hapus file ini?');">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="relative_path" value="<?= esc($f['relative_path'], 'attr'); ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            <?php else: ?>
                                <button type="button" class="btn btn-sm btn-light text-muted disabled" title="File Aset Dilindungi">
                                    <i class="fas fa-lock"></i> Locked
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    function copyLink(url) {
        navigator.clipboard.writeText(url).then(function() {
            // Toast notifikasi sederhana (bisa diganti SweetAlert kalau ada)
            alert('Link tersalin ke clipboard!'); 
        }, function(err) {
            console.error('Gagal menyalin: ', err);
        });
    }
</script>
<?= $this->endSection(); ?>