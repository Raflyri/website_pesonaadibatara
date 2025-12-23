<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark"><?= $title; ?></h3>
    <a href="/admin/partners/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i> Tambah Partner
    </a>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th width="5%">Urutan</th>
                        <th width="15%">Logo</th>
                        <th>Nama Partner</th>
                        <th>Website Link</th>
                        <th>Status</th>
                        <th width="15%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($partners)) : ?>
                        <?php foreach ($partners as $p) : ?>
                        <tr>
                            <td class="text-center fw-bold"><?= $p['display_order']; ?></td>
                            <td>
                                <img src="<?= base_url('uploads/partners/' . $p['partner_logo']); ?>" 
                                     alt="Logo" class="img-fluid rounded border p-1" style="height: 50px; width: auto; background: #eee;">
                            </td>
                            <td class="fw-bold"><?= $p['partner_name']; ?></td>
                            <td>
                                <?php if($p['partner_url']): ?>
                                    <a href="<?= $p['partner_url']; ?>" target="_blank" class="text-decoration-none small text-muted">
                                        <i class="fas fa-external-link-alt me-1"></i> Buka Link
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($p['is_active']): ?>
                                    <span class="badge bg-success-soft text-success px-3 py-2 rounded-pill">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="/admin/partners/edit/<?= $p['id']; ?>" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="/admin/partners/delete/<?= $p['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus partner ini?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" width="60" class="mb-3 opacity-50">
                                <p class="mb-0">Belum ada partner ditambahkan.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>