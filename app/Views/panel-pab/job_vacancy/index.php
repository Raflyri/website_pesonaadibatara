<?= $this->extend('panel-pab/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <a href="/panel-pab/job-vacancies/create" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Lowongan
        </a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul Pekerjaan</th>
                            <th>Departemen</th>
                            <th>Tipe Kontrak</th>
                            <th>Batas Akhir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vacancies as $job) : ?>
                            <tr>
                                <td><?= $job['job_title']; ?></td>
                                <td><?= $job['department']; ?></td>
                                <td><?= $job['employment_type']; ?></td>
                                <td><?= $job['application_deadline'] ? date('d M Y', strtotime($job['application_deadline'])) : '-'; ?></td>
                                <td>
                                    <?php if ($job['status'] == 'Published') : ?>
                                        <span class="badge bg-success">Published</span>
                                    <?php elseif ($job['status'] == 'Draft') : ?>
                                        <span class="badge bg-warning text-dark">Draft</span>
                                    <?php else : ?>
                                        <span class="badge bg-danger">Closed</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/panel-pab/job-vacancies/edit/<?= $job['id']; ?>" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/panel-pab/job-vacancies/delete/<?= $job['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($vacancies)) : ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data lowongan kerja.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
