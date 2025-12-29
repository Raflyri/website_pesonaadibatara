<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Kelola Direksi</h3>
    <a href="/admin/team/create" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Personil
    </a>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Foto</th>
                    <th>Nama & Jabatan</th>
                    <th>Urutan</th>
                    <th class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teams as $team) : ?>
                <tr>
                    <td class="ps-4">
                        <?php $img = $team['image'] ? base_url('uploads/teams/' . $team['image']) : 'https://ui-avatars.com/api/?name='.$team['name']; ?>
                        <img src="<?= $img; ?>" class="rounded-circle shadow-sm" width="50" height="50" style="object-fit: cover;">
                    </td>
                    <td>
                        <div class="fw-bold"><?= $team['name']; ?></div>
                        <div class="small text-muted"><?= $team['position_id']; ?></div>
                    </td>
                    <td><span class="badge bg-light text-dark border"><?= $team['urutan']; ?></span></td>
                    <td class="text-end pe-4">
                        <a href="/admin/team/edit/<?= $team['id']; ?>" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></a>
                        <a href="/admin/team/delete/<?= $team['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data ini?');"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>