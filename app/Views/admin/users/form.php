<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<h3 class="fw-bold text-dark mb-4"><?= $title; ?></h3>

<div class="card border-0 shadow-sm rounded-4 col-lg-8">
    <div class="card-body p-5">
        <?php 
            $url = isset($user) ? '/admin/users/update/' . $user['id'] : '/admin/users/save';
        ?>
        <form action="<?= $url; ?>" method="post">
            <?= csrf_field(); ?>
            
            <div class="mb-3">
                <label class="fw-bold form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="<?= isset($user) ? $user['fullname'] : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label class="fw-bold form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= isset($user) ? $user['email'] : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label class="fw-bold form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="<?= isset($user) ? 'Kosongkan jika tidak ingin mengubah password' : 'Min 6 karakter'; ?>">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold form-label">Role Akses</label>
                    <select name="role" class="form-select">
                        <option value="admin" <?= (isset($user) && $user['role'] == 'admin') ? 'selected' : ''; ?>>Admin Biasa</option>
                        <option value="superadmin" <?= (isset($user) && $user['role'] == 'superadmin') ? 'selected' : ''; ?>>Super Admin</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold form-label">Status Akun</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" <?= (!isset($user) || $user['is_active'] == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label">Akun Aktif</label>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <button type="submit" class="btn btn-primary rounded-pill px-5">Simpan Data</button>
            <a href="/admin/users" class="btn btn-light rounded-pill px-4">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>