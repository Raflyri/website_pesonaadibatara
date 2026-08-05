<?= $this->extend('panel-pab/layout/template'); ?>

<?= $this->section('content'); ?>
<?php
$isEdit = !empty($category);
$action = $isEdit
    ? base_url('panel-pab/service-categories/update/' . $category['category'])
    : base_url('panel-pab/service-categories/store');

// Ikon yang umum dipakai, biar admin tidak perlu hafal kelas Font Awesome.
$iconPresets = [
    'fas fa-car-side'        => 'Transportasi',
    'fas fa-heartbeat'       => 'Kesehatan',
    'fas fa-concierge-bell'  => 'Jasa / Layanan',
    'fas fa-chart-line'      => 'Investasi',
    'fas fa-truck'           => 'Logistik',
    'fas fa-building'        => 'Properti',
    'fas fa-utensils'        => 'Kuliner / F&B',
    'fas fa-laptop-code'     => 'Teknologi',
    'fas fa-graduation-cap'  => 'Pendidikan',
    'fas fa-leaf'            => 'Energi / Lingkungan',
];

$curIcon  = old('icon', $category['icon'] ?? 'fas fa-concierge-bell');
$curColor = old('color', $category['color'] ?? 'blue');
?>

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0 text-gray-800 fw-bold"><?= esc($title); ?></h2>
            <p class="text-muted small mb-0">Kategori ini akan muncul di menu Layanan pada navbar dan footer situs.</p>
        </div>
        <a href="<?= base_url('panel-pab/service-categories'); ?>" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= esc(session()->getFlashdata('error')); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form action="<?= $action; ?>" method="post">
        <?= csrf_field(); ?>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-primary"><i class="fas fa-tag me-2"></i> Identitas Menu</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Menu (Indonesia) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nav_label"
                                    value="<?= esc(old('nav_label', $category['nav_label'] ?? ''), 'attr'); ?>"
                                    placeholder="mis. Logistik" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Menu (English)</label>
                                <input type="text" class="form-control" name="nav_label_en"
                                    value="<?= esc(old('nav_label_en', $category['nav_label_en'] ?? ''), 'attr'); ?>"
                                    placeholder="mis. Logistics">
                                <small class="text-muted">Kosongkan bila ingin memakai nama Indonesia.</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Deskripsi Singkat (Indonesia)</label>
                                <input type="text" class="form-control" name="nav_desc"
                                    value="<?= esc(old('nav_desc', $category['nav_desc'] ?? ''), 'attr'); ?>"
                                    placeholder="mis. Pergudangan & Distribusi" maxlength="150">
                                <small class="text-muted">Teks kecil di bawah nama menu.</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Deskripsi Singkat (English)</label>
                                <input type="text" class="form-control" name="nav_desc_en"
                                    value="<?= esc(old('nav_desc_en', $category['nav_desc_en'] ?? ''), 'attr'); ?>"
                                    placeholder="mis. Warehousing &amp; Distribution" maxlength="150">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Deskripsi Kartu Homepage (Indonesia)</label>
                                <textarea class="form-control" name="home_desc" rows="2" maxlength="255"
                                    placeholder="Satu kalimat ringkas tentang bidang bisnis ini."><?= esc(old('home_desc', $category['home_desc'] ?? '')); ?></textarea>
                                <small class="text-muted">Tampil di kartu "Pilar Bisnis" pada halaman utama.</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Deskripsi Kartu Homepage (English)</label>
                                <textarea class="form-control" name="home_desc_en" rows="2" maxlength="255"
                                    placeholder="One short sentence about this business line."><?= esc(old('home_desc_en', $category['home_desc_en'] ?? '')); ?></textarea>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold">Slug URL</label>
                            <?php if ($isEdit) : ?>
                                <input type="text" class="form-control bg-light" value="<?= esc($category['category'], 'attr'); ?>" disabled>
                                <small class="text-muted">
                                    Slug tidak bisa diubah karena dipakai sebagai alamat halaman
                                    (<code>/layanan/<?= esc($category['category']); ?></code>) dan penanda item layanan di dalamnya.
                                </small>
                            <?php else : ?>
                                <div class="input-group">
                                    <span class="input-group-text text-muted">/layanan/</span>
                                    <input type="text" class="form-control" name="category"
                                        value="<?= esc(old('category'), 'attr'); ?>" placeholder="logistik">
                                </div>
                                <small class="text-muted">Kosongkan untuk dibuat otomatis dari Nama Menu. Setelah disimpan, slug tidak bisa diubah.</small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-primary"><i class="fas fa-palette me-2"></i> Tampilan</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ikon</label>
                            <select class="form-select" name="icon">
                                <?php foreach ($iconPresets as $cls => $label) : ?>
                                    <option value="<?= esc($cls, 'attr'); ?>" <?= ($curIcon === $cls) ? 'selected' : ''; ?>>
                                        <?= esc($label); ?>
                                    </option>
                                <?php endforeach; ?>
                                <?php if (!array_key_exists($curIcon, $iconPresets)) : ?>
                                    <option value="<?= esc($curIcon, 'attr'); ?>" selected><?= esc($curIcon); ?> (custom)</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Warna Aksen</label>
                            <select class="form-select" name="color">
                                <?php
                                $colorLabels = ['blue' => 'Biru', 'green' => 'Hijau', 'orange' => 'Oranye', 'purple' => 'Ungu'];
                                foreach ($colors as $c) :
                                ?>
                                    <option value="<?= esc($c, 'attr'); ?>" <?= ($curColor === $c) ? 'selected' : ''; ?>>
                                        <?= esc($colorLabels[$c] ?? ucfirst($c)); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Urutan</label>
                            <input type="number" class="form-control" name="sort_order"
                                value="<?= esc(old('sort_order', $category['sort_order'] ?? 0), 'attr'); ?>">
                            <small class="text-muted">Angka kecil tampil lebih dulu.</small>
                        </div>

                        <div class="form-check form-switch">
                            <?php $active = (int) old('is_active', $category['is_active'] ?? 1) === 1; ?>
                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                id="isActive" <?= $active ? 'checked' : ''; ?>>
                            <label class="form-check-label fw-bold" for="isActive">Tampilkan di situs</label>
                            <div><small class="text-muted">Nonaktif = halaman tidak bisa diakses publik.</small></div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-save me-1"></i> <?= $isEdit ? 'Simpan Perubahan' : 'Simpan Kategori'; ?>
                </button>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection(); ?>
