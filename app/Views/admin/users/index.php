<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Manajemen Administrator</h3>
    <a href="/admin/users/create" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="fas fa-user-plus me-2"></i> Tambah User
    </a>
</div>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Login Terakhir</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u) : ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; overflow:hidden;">
                                    <?php if($u['avatar']): ?>
                                        <img src="/uploads/avatars/<?= $u['avatar']; ?>" class="w-100 h-100 object-fit-cover">
                                    <?php else: ?>
                                        <i class="fas fa-user text-secondary"></i>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark"><?= esc($u['fullname']); ?></div>
                                    <div class="small text-muted"><?= esc($u['email']); ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php if($u['role'] == 'superadmin'): ?>
                                <span class="badge bg-purple-light text-primary border border-primary">Super Admin</span>
                            <?php else: ?>
                                <span class="badge bg-light text-dark border">Admin Biasa</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($u['is_active']): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Non-Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-muted small">
                            <?= $u['last_login'] ? date('d M Y H:i', strtotime($u['last_login'])) : '-'; ?>
                        </td>
                        <td class="text-end">
                            <a href="/admin/users/edit/<?= $u['id']; ?>" class="btn btn-sm btn-light text-primary"><i class="fas fa-edit"></i></a>
                            <?php if(session()->get('id') != $u['id']): ?>
                                <a href="/admin/users/delete/<?= $u['id']; ?>" class="btn btn-sm btn-light text-danger" onclick="return confirm('Hapus user ini?')"><i class="fas fa-trash"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>