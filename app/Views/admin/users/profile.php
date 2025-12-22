<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<h3 class="fw-bold text-dark mb-4">Profil Saya</h3>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-4 text-center p-4">
            <div class="mb-3 mx-auto" style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%;">
                <?php if($user['avatar']): ?>
                    <img src="/uploads/avatars/<?= $user['avatar']; ?>" class="w-100 h-100 object-fit-cover">
                <?php else: ?>
                    <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                        <i class="fas fa-user fa-4x text-muted"></i>
                    </div>
                <?php endif; ?>
            </div>
            <h5 class="fw-bold mb-1"><?= esc($user['fullname']); ?></h5>
            <p class="text-muted small"><?= esc($user['role']); ?></p>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-5">
                <form action="/admin/profile/update" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    
                    <div class="mb-3">
                        <label class="fw-bold form-label">Ganti Foto Profil</label>
                        <input type="file" name="avatar" class="form-control">
                        <small class="text-muted">Format: JPG/PNG, Max 2MB.</small>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="<?= esc($user['fullname']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold form-label">Email (Read Only)</label>
                        <input type="text" class="form-control bg-light" value="<?= esc($user['email']); ?>" readonly>
                        <small class="text-muted">Hubungi Super Admin jika ingin mengganti email.</small>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold form-label">Ganti Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti">
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>