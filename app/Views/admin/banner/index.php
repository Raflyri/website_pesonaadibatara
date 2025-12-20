<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Kelola Banner Slider</h3>
    <a href="/admin/banner/create" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Banner
    </a>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Preview</th>
                        <th>Judul (ID/EN)</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($banners as $index => $banner) : ?>
                    <tr>
                        <td class="ps-4"><?= $index + 1; ?></td>
                        <td>
                            <img src="<?= base_url('uploads/banners/' . $banner['image']); ?>" 
                                 class="rounded shadow-sm object-fit-cover" 
                                 width="120" height="60" alt="Banner">
                        </td>
                        <td>
                            <div class="fw-bold"><?= $banner['title']; ?></div>
                            <div class="small text-muted"><?= $banner['title_en']; ?></div>
                        </td>
                        <td><span class="badge bg-light text-dark border"><?= $banner['urutan']; ?></span></td>
                        <td>
                            <?php if ($banner['is_active']) : ?>
                                <span class="badge bg-success bg-opacity-10 text-success">Aktif</span>
                            <?php else : ?>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary">Non-Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-4">
                            <a href="/admin/banner/edit/<?= $banner['id']; ?>" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></a>
                            <a href="/admin/banner/delete/<?= $banner['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus banner ini?');"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>