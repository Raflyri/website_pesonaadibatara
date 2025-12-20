<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<h3 class="fw-bold text-dark mb-4">Pusat Pesan & Kontak</h3>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white pt-3 px-4 border-bottom-0">
        <ul class="nav nav-tabs card-header-tabs" id="contactTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active fw-bold" id="inbox-tab" data-bs-toggle="tab" data-bs-target="#inbox" type="button">
                    <i class="fas fa-envelope me-2"></i> Kotak Masuk
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold" id="setting-tab" data-bs-toggle="tab" data-bs-target="#setting" type="button">
                    <i class="fas fa-edit me-2"></i> Edit Halaman
                </button>
            </li>
        </ul>
    </div>

    <div class="card-body p-4">
        <div class="tab-content">
            
            <div class="tab-pane fade show active" id="inbox">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Pengirim</th>
                                <th>Subjek</th>
                                <th>Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($messages as $msg): ?>
                            <tr>
                                <td class="small text-muted" style="width: 15%;"><?= date('d M Y H:i', strtotime($msg['created_at'])); ?></td>
                                <td style="width: 20%;">
                                    <div class="fw-bold"><?= $msg['name']; ?></div>
                                    <div class="small text-muted"><?= $msg['email']; ?></div>
                                    <div class="small text-muted"><?= $msg['phone']; ?></div>
                                </td>
                                <td style="width: 20%;" class="fw-bold text-primary"><?= $msg['subject']; ?></td>
                                <td><?= nl2br(esc((string) $msg['message'])); ?></td>
                                <td class="text-end">
                                    <a href="/admin/contact-editor/delete/<?= $msg['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus pesan ini?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($messages)): ?>
                                <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada pesan masuk.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="setting">
                <form action="/admin/contact-editor/update" method="post">
                    <?= csrf_field(); ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h5 class="text-primary fw-bold mb-3">Teks Intro</h5>
                            <div class="mb-3">
                                <label class="fw-bold">Judul (ID)</label>
                                <input type="text" name="title_id" class="form-control" value="<?= $intro['title_id']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Deskripsi (ID)</label>
                                <textarea name="content_id" class="form-control" rows="4"><?= $intro['content_id']; ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <h5 class="text-primary fw-bold mb-3">Google Maps</h5>
                            <div class="mb-3">
                                <label class="fw-bold">Link Embed (Iframe src)</label>
                                <textarea name="company_maps" class="form-control" rows="4"><?= $maps['setting_value']; ?></textarea>
                                <small class="text-muted d-block mt-1">
                                    Cara ambil: Buka Google Maps -> Share -> Embed a map -> Copy isi atribut <code>src="..."</code> saja.
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>