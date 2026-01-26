<?= $this->extend('panel-pab/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0 text-gray-800"><?= $title; ?></h2>
        <a href="/panel-pab/services/<?= $category; ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body">
            <?php
            $urlAction = isset($service) ? '/panel-pab/services/update/' . $service['id'] : '/panel-pab/services/save';
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
                            <label class="form-label fw-bold">Gambar Utama (Thumbnail)</label>
                            <input type="file" class="form-control mb-2" name="image">
                            <?php if (!empty($service['image'])) : ?>
                                <img src="/uploads/services/<?= $service['image']; ?>" class="img-fluid rounded border mb-2">
                            <?php endif; ?>
                            <small class="text-muted d-block">*Gambar ini muncul di samping judul.</small>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Galeri Tambahan</label>
                            <input type="file" class="form-control mb-2" name="gallery[]" multiple accept="image/*">

                            <div class="alert alert-info py-2 px-3 small">
                                <i class="fas fa-info-circle me-1"></i>
                                Maksimal total <strong>5 gambar</strong> per layanan.
                            </div>

                            <?php if (!empty($service['gallery'])) : ?>
                                <label class="form-label small text-danger mt-2">Centang untuk menghapus gambar:</label>
                                <div class="row g-2">
                                    <?php
                                    $gallery = json_decode($service['gallery'], true);
                                    if (is_array($gallery)):
                                        foreach ($gallery as $gImg) :
                                    ?>
                                            <div class="col-6 position-relative">
                                                <img src="/uploads/services/<?= $gImg; ?>" class="img-fluid rounded border" style="height: 80px; object-fit: cover; width: 100%;">
                                                <div class="form-check position-absolute top-0 start-0 m-1 bg-white rounded px-1 shadow-sm">
                                                    <input class="form-check-input" type="checkbox" name="delete_gallery[]" value="<?= $gImg; ?>">
                                                    <label class="form-check-label text-danger small"><i class="fas fa-trash"></i></label>
                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Ikon (FontAwesome)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-icons"></i></span>
                                <input type="text" class="form-control" name="icon" placeholder="Contoh: fas fa-truck" value="<?= $service['icon'] ?? ''; ?>">
                            </div>
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