<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0 text-gray-800"><?= $title; ?></h2>
        <a href="/admin/services/<?= $category; ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body">
            <?php 
                $urlAction = isset($service) ? '/admin/services/update/' . $service['id'] : '/admin/services/save'; 
            ?>
            <form action="<?= $urlAction; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                
                <input type="hidden" name="category" value="<?= $category; ?>">

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Judul Layanan</label>
                            <input type="text" class="form-control" name="title" value="<?= $service['title'] ?? ''; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi Singkat (untuk di Card)</label>
                            <textarea class="form-control" name="short_description" rows="3"><?= $service['short_description'] ?? ''; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konten Lengkap</label>
                            <textarea class="form-control summernote" name="content"><?= $service['content'] ?? ''; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Gambar Utama</label>
                            <input type="file" class="form-control mb-2" name="image">
                            <?php if (!empty($service['image'])) : ?>
                                <img src="/uploads/services/<?= $service['image']; ?>" class="img-fluid rounded border">
                            <?php endif; ?>
                            <small class="text-muted d-block mt-1">*Kosongkan jika tidak ingin mengganti gambar.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ikon (FontAwesome)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-icons"></i></span>
                                <input type="text" class="form-control" name="icon" placeholder="Contoh: fas fa-truck" value="<?= $service['icon'] ?? ''; ?>">
                            </div>
                            <small class="text-muted"><a href="https://fontawesome.com/v5/search" target="_blank">Lihat Referensi Icon</a></small>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan Data</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>