<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="mb-4">
    <a href="/admin/partners" class="text-decoration-none text-muted"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
    <h3 class="fw-bold mt-2"><?= $title; ?></h3>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <?php if (session()->has('errors')) : ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session('errors') as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <?php
                $actionUrl = isset($partner) ? '/admin/partners/save/' . $partner['id'] : '/admin/partners/save';
                ?>
                <form action="<?= $actionUrl; ?>" method="post" enctype="multipart/form-data">
                    <!--form action="/admin/partners/save/<?= isset($partner) ? $partner['id'] : ''; ?>" method="post" enctype="multipart/form-data"-->
                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Partner / Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" name="partner_name" class="form-control"
                            value="<?= old('partner_name', isset($partner) ? $partner['partner_name'] : ''); ?>" required placeholder="Contoh: Bank Tabungan Negara">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Urutan Tampil</label>
                            <input type="number" name="display_order" class="form-control"
                                value="<?= old('display_order', isset($partner) ? $partner['display_order'] : '1'); ?>" required>
                            <small class="text-muted">Angka kecil tampil di kiri.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="is_active" class="form-select">
                                <option value="1" <?= (isset($partner) && $partner['is_active'] == 1) ? 'selected' : ''; ?>>Tampilkan</option>
                                <option value="0" <?= (isset($partner) && $partner['is_active'] == 0) ? 'selected' : ''; ?>>Sembunyikan</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Website Link (Opsional)</label>
                        <input type="url" name="partner_url" class="form-control"
                            value="<?= old('partner_url', isset($partner) ? $partner['partner_url'] : ''); ?>" placeholder="https://website-partner.com">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Logo Partner (PNG Transparan) <span class="text-danger">*</span></label>

                        <?php if (isset($partner) && $partner['partner_logo']): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/partners/' . $partner['partner_logo']); ?>" width="120" class="border p-1 rounded bg-light">
                                <small class="d-block text-muted">Logo saat ini</small>
                            </div>
                        <?php endif; ?>

                        <input type="file" name="partner_logo" class="form-control" accept="image/png, image/jpeg, image/webp">
                        <small class="text-muted">Format disarankan: <b>PNG Transparent</b>. Max 2MB.</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan Data</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>