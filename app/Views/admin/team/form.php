<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark"><?= $title; ?></h3>
    <a href="/admin/team" class="btn btn-outline-secondary rounded-pill px-4">Kembali</a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">

        <?php $action = isset($team) ? '/admin/team/save/' . $team['id'] : '/admin/team/save'; ?>

        <form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="<?= old('name', $team['fullname'] ?? ''); ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jabatan (Indonesia)</label>
                            <input type="text" name="position_id" class="form-control" placeholder="Contoh: Direktur Utama" value="<?= old('position_id', $team['position_id'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Jabatan (English)</label>
                            <input type="text" name="position_en" class="form-control bg-light" placeholder="Contoh: President Director" value="<?= old('position_en', $team['position_en'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Level Posisi (Hierarki)</label>
                        <select name="level" class="form-select bg-light border-primary">
                            <option value="1" <?= (old('level', $team['level'] ?? '') == '1') ? 'selected' : '' ?>>Level 1 - Direktur Utama (Top)</option>
                            <option value="2" <?= (old('level', $team['level'] ?? '') == '2') ? 'selected' : '' ?>>Level 2 - Direktur</option>
                            <option value="3" <?= (old('level', $team['level'] ?? '') == '3') ? 'selected' : '' ?>>Level 3 - General Manager</option>
                            <option value="4" <?= (old('level', $team['level'] ?? '') == '4') ? 'selected' : '' ?>>Level 4 - Manager / Div. Head</option>
                            <option value="5" <?= (old('level', $team['level'] ?? '') == '5') ? 'selected' : '' ?>>Level 5 - Supervisor / Staff</option>
                        </select>
                        <div class="form-text small">Pilihan ini menentukan posisi kotak dalam bagan struktur organisasi.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Atasan Langsung (Reports To)</label>
                        <select name="parent_id" class="form-select" data-live-search="true">
                            <option value="0">-- Tidak Ada (Posisi Puncak / Top Level) --</option>

                            <?php foreach ($parents as $p): ?>
                                <option value="<?= $p['id']; ?>"
                                    <?= (isset($team) && $team['parent_id'] == $p['id']) ? 'selected' : ''; ?>>
                                    <?= $p['fullname']; ?> - (<?= $p['position_id']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text small">Pilih siapa bos dari orang ini. Jika dipilih, orang ini akan muncul di bawah chart bos tersebut.</div>
                    </div>

                    <!--div class="mb-3">
                        <label class="form-label fw-bold">Urutan Tampil</label>
                        <input type="number" name="urutan" class="form-control w-25" value="<?= old('urutan', $team['urutan'] ?? '1'); ?>">
                    </div-->
                </div>

                <div class="col-md-4">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center">
                            <label class="form-label fw-bold mb-2">Foto Profil</label>
                            <?php if (isset($team) && $team['image']) : ?>
                                <div class="mb-3">
                                    <img src="<?= base_url('uploads/teams/' . $team['image']); ?>" class="img-thumbnail rounded-circle" width="120" height="120" style="object-fit: cover;">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="image" class="form-control">
                            <small class="text-muted d-block mt-2">Format: JPG/PNG. Max 2MB.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-5 shadow">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>