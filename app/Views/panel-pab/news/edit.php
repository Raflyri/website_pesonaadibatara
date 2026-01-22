<?= $this->extend('panel-pab/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Edit Postingan</h3>
    <a href="/panel-pab/news" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="card border-0 shadow-lg rounded-4">
    <div class="card-body p-5">

        <form action="/panel-pab/news/update/<?= $news['id']; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <label class="fw-bold form-label">Judul Postingan</label>
                        <input type="text" name="title" class="form-control form-control-lg bg-light border-0" value="<?= esc($news['title_id']); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold form-label">Isi Konten</label>
                        <textarea name="content" class="summernote" required><?= $news['content_id']; ?></textarea>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-4">
                        <label class="fw-bold form-label">Kategori</label>
                        <select name="category" class="form-select bg-light border-0 py-3" required>
                            <option value="berita" <?= ($news['category'] == 'berita') ? 'selected' : ''; ?>>📰 Berita (News)</option>
                            <option value="artikel" <?= ($news['category'] == 'artikel') ? 'selected' : ''; ?>>📝 Artikel (Blog/Edukasi)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold form-label">Thumbnail Image</label>

                        <?php if ($news['image']): ?>
                            <div class="mb-2">
                                <img src="/uploads/news/<?= $news['image']; ?>" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                                <div class="small text-muted mt-1">Gambar saat ini</div>
                            </div>
                        <?php endif; ?>

                        <div class="bg-light rounded-3 p-4 text-center border border-dashed mb-2">
                            <i class="fas fa-image fa-2x text-muted mb-3"></i>
                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        </div>
                        <small class="text-muted d-block text-center">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold">Tanggal Tayang (Posting Date)</label>
                        <input type="date" name="date_published" class="form-control w-25"
                            value="<?= isset($news) ? $news['date_published'] : date('Y-m-d'); ?>">
                        <small class="text-muted">
                            *Jika tanggal diset lebih dari hari ini, berita tidak akan muncul sampai tanggal tersebut tiba.
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>