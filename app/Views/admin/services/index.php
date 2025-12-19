<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark"><?= $title; ?></h3>
    <button class="btn btn-primary rounded-pill">
        <i class="fas fa-plus me-2"></i> Tambah Item Layanan
    </button>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body text-center py-5">
        <img src="<?= base_url('assets/img/logo-pab.png'); ?>" height="50" class="opacity-25 mb-3" style="filter: grayscale(1);">
        <h5 class="text-muted">Belum ada data untuk kategori <span class="text-primary text-capitalize"><?= $category; ?></span></h5>
        <p class="text-muted small">Silakan tambahkan data layanan sesuai Company Profile.</p>
    </div>
</div>

<?= $this->endSection(); ?>