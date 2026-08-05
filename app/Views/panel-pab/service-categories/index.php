<?= $this->extend('panel-pab/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0 text-gray-800 fw-bold">Kelola Kategori Layanan</h2>
            <p class="text-muted small mb-0">Bidang bisnis yang tampil di menu Layanan (navbar, footer, dan sidebar admin).</p>
        </div>
        <a href="<?= base_url('panel-pab/service-categories/create'); ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Kategori
        </a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= esc(session()->getFlashdata('success')); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= esc(session()->getFlashdata('error')); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" style="width: 70px;">Urutan</th>
                            <th>Menu</th>
                            <th>URL Publik</th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($categories)) : ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    Belum ada kategori. Klik <strong>Tambah Kategori</strong> untuk membuat bidang bisnis pertama.
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach ($categories as $row) : ?>
                            <?php $c = \App\Models\ServicePageModel::colorClasses($row['color']); ?>
                            <tr>
                                <td class="ps-4 text-muted"><?= (int) $row['sort_order']; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="icon-small <?= esc($c['bg'], 'attr'); ?> me-3 <?= esc($c['text'], 'attr'); ?>">
                                            <i class="<?= esc($row['icon'] ?: 'fas fa-concierge-bell', 'attr'); ?>"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold"><?= esc($row['nav_label'] ?: ucfirst($row['category'])); ?></div>
                                            <small class="text-muted">
                                                <?= esc($row['nav_desc'] ?: '—'); ?>
                                                <?php if (!empty($row['nav_label_en'])) : ?>
                                                    <span class="badge bg-light text-dark border ms-1">EN: <?= esc($row['nav_label_en']); ?></span>
                                                <?php endif; ?>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?= base_url('layanan/' . $row['category']); ?>" target="_blank" class="text-decoration-none small">
                                        /layanan/<?= esc($row['category']); ?> <i class="fas fa-external-link-alt ms-1" style="font-size: 0.7rem;"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('panel-pab/services/' . $row['category']); ?>" class="badge bg-light text-dark border text-decoration-none">
                                        <?= (int) ($counts[$row['category']] ?? 0); ?> item
                                    </a>
                                </td>
                                <td class="text-center">
                                    <?php if ((int) $row['is_active'] === 1) : ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else : ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= base_url('panel-pab/services/' . $row['category']); ?>" class="btn btn-sm btn-outline-secondary" title="Kelola isi halaman">
                                        <i class="fas fa-file-lines"></i>
                                    </a>
                                    <a href="<?= base_url('panel-pab/service-categories/edit/' . $row['category']); ?>" class="btn btn-sm btn-outline-primary" title="Edit kategori">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('panel-pab/service-categories/delete/' . $row['category']); ?>"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Hapus kategori"
                                        onclick="return confirm('Hapus kategori &quot;<?= esc($row['nav_label'] ?: $row['category'], 'attr'); ?>&quot;? Tindakan ini tidak bisa dibatalkan.');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="alert alert-info mt-4 small mb-0">
        <i class="fas fa-info-circle me-1"></i>
        Kategori dengan item layanan tidak bisa dihapus — kosongkan dulu itemnya lewat menu <strong>Layanan Bisnis</strong>.
        Untuk menyembunyikan sementara dari situs publik, cukup ubah statusnya jadi <strong>Nonaktif</strong>.
    </div>
</div>
<?= $this->endSection(); ?>
