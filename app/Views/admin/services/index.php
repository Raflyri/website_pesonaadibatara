<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid p-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0 text-gray-800 fw-bold">Editor Halaman: <?= ucfirst($category); ?></h2>
            <p class="text-muted small">Atur tampilan header dan daftar layanan untuk halaman ini.</p>
        </div>
        <a href="/layanan/<?= $category; ?>" target="_blank" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-eye me-1"></i> Lihat Halaman Asli
        </a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow border-0 mb-5">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="m-0 fw-bold text-primary"><i class="fas fa-heading me-2"></i> Pengaturan Header & Judul Utama</h6>
        </div>
        <div class="card-body">
            <form action="/admin/services/update-page/<?= $category; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Halaman</label>
                            <input type="text" class="form-control" name="page_title" value="<?= $page['page_title']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Singkat (Intro)</label>
                            <textarea class="form-control" name="page_description" rows="3"><?= $page['page_description']; ?></textarea>
                            <small class="text-muted">Teks ini akan muncul di bawah judul besar.</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Background Header</label>
                        <div class="mb-2">
                            <?php if(!empty($page['hero_image'])): ?>
                                <img src="/uploads/services/<?= $page['hero_image']; ?>" class="img-fluid rounded shadow-sm w-100" style="height: 150px; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-light rounded text-center py-5 border border-dashed">
                                    <small class="text-muted">Belum ada gambar</small>
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="file" class="form-control form-control-sm" name="hero_image">
                        <small class="text-muted d-block mt-1">Format: JPG/PNG, Max 2MB.</small>
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan Header</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold text-success"><i class="fas fa-th-list me-2"></i> Daftar Item Layanan (Cards)</h6>
            <a href="/admin/services/<?= $category; ?>/create" class="btn btn-success btn-sm rounded-pill px-3">
                <i class="fas fa-plus me-1"></i> Tambah Item Baru
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Icon / Gambar</th>
                            <th>Judul Layanan</th>
                            <th>Deskripsi Singkat</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($services)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-3x mb-3 opacity-25"></i>
                                    <p>Belum ada item layanan yang ditambahkan.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $i=1; foreach($services as $item): ?>
                                <tr>
                                    <td class="ps-4"><?= $i++; ?></td>
                                    <td>
                                        <?php if($item['image']): ?>
                                            <img src="/uploads/services/<?= $item['image']; ?>" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                        <?php else: ?>
                                            <span class="badge bg-secondary">No IMG</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-bold"><?= $item['title']; ?></td>
                                    <td class="small text-muted"><?= substr($item['short_description'], 0, 60); ?>...</td>
                                    <td class="text-end pe-4">
                                        <a href="/admin/services/edit/<?= $item['id']; ?>" class="btn btn-sm btn-warning me-1"><i class="fas fa-edit"></i></a>
                                        <a href="/admin/services/delete/<?= $item['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus item ini?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>