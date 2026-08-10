<?= $this->extend('panel-pab/layout/template'); ?>

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
            <li class="nav-item">
                <button class="nav-link fw-bold" id="kontak-tab" data-bs-toggle="tab" data-bs-target="#kontak" type="button">
                    <i class="fas fa-phone me-2"></i> Kontak
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold" id="sosmed-tab" data-bs-toggle="tab" data-bs-target="#sosmed" type="button">
                    <i class="fas fa-share-alt me-2"></i> Social Media
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold" id="maps-tab" data-bs-toggle="tab" data-bs-target="#maps" type="button">
                    <i class="fas fa-map-marker-alt me-2"></i> Google Maps
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
                            <?php foreach ($messages as $msg): ?>
                                <tr>
                                    <td class="small text-muted" style="width: 15%;"><?= date('d M Y H:i', strtotime($msg['created_at'])); ?></td>
                                    <td style="width: 20%;">
                                        <div class="fw-bold"><?= esc($msg['name']); ?></div>
                                        <div class="small text-muted"><?= esc($msg['email']); ?></div>
                                        <div class="small text-muted"><?= esc($msg['phone']); ?></div>
                                    </td>
                                    <td style="width: 20%;" class="fw-bold text-primary"><?= esc($msg['subject']); ?></td>
                                    <td><?= nl2br(esc((string) $msg['message'])); ?></td>
                                    <td class="text-end">
                                        <a href="/panel-pab/contact-editor/delete/<?= $msg['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus pesan ini?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($messages)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">Belum ada pesan masuk.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="setting">
                <form action="/panel-pab/contact-editor/update" method="post">
                    <?= csrf_field(); ?>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h5 class="text-primary fw-bold mb-3">Teks Intro</h5>
                            <div class="mb-3">
                                <label class="fw-bold">Judul (ID)</label>
                                <input type="text" name="title_id" class="form-control" value="<?= esc($intro['title_id'], 'attr'); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Deskripsi (ID)</label>
                                <textarea name="content_id" class="form-control" rows="4"><?= esc($intro['content_id']); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="kontak">
                <form action="/panel-pab/contact-editor/update" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="title_id" value="<?= esc($intro['title_id'], 'attr'); ?>">

                    <h5 class="text-primary fw-bold mb-3 mt-4">Kontak Utama</h5>
                    <div class="mb-3">
                        <label class="fw-bold">WhatsApp Company (tanpa + atau 0, cth: 628123...)</label>
                        <input type="text" name="company_whatsapp" class="form-control" value="<?= esc($contact['company_whatsapp'], 'attr'); ?>" placeholder="628123456789">
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Telepon Kantor</label>
                        <input type="text" name="company_phone" class="form-control" value="<?= esc($contact['company_phone'], 'attr'); ?>" placeholder="021-12345678">
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Email Perusahaan</label>
                        <input type="email" name="company_email" class="form-control" value="<?= esc($contact['company_email'], 'attr'); ?>" placeholder="info@pesonaadibatara.co.id">
                        <small class="text-muted">Email global perusahaan — ditampilkan di footer, halaman kontak, dan digunakan sebagai default pada tombol lamaran kerja.</small>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="maps">
                <form action="/panel-pab/contact-editor/update" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="title_id" value="<?= esc($intro['title_id'], 'attr'); ?>">

                    <h5 class="text-primary fw-bold mb-3 mt-4">Google Maps</h5>
                    <div class="mb-3">
                        <label class="fw-bold">Link Embed (Iframe src)</label>
                        <textarea name="company_maps" class="form-control" rows="4"><?= esc($maps['setting_value']); ?></textarea>
                        <small class="text-muted d-block mt-1">
                            Cara ambil: Buka Google Maps -> Share -> Embed a map -> Copy isi atribut <code>src="..."</code> saja.
                        </small>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="sosmed">
                <form action="/panel-pab/contact-editor/update" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="title_id" value="<?= esc($intro['title_id'], 'attr'); ?>">

                    <div class="row g-4 p-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fab fa-instagram text-danger me-2"></i> Instagram URL</label>
                            <input type="text" name="sosmed_instagram" class="form-control" value="<?= esc($sosmed['sosmed_instagram'], 'attr'); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fab fa-facebook text-primary me-2"></i> Facebook URL</label>
                            <input type="text" name="sosmed_facebook" class="form-control" value="<?= esc($sosmed['sosmed_facebook'], 'attr'); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fab fa-linkedin text-info me-2"></i> LinkedIn URL</label>
                            <input type="text" name="sosmed_linkedin" class="form-control" value="<?= esc($sosmed['sosmed_linkedin'], 'attr'); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fab fa-youtube text-danger me-2"></i> YouTube URL</label>
                            <input type="text" name="sosmed_youtube" class="form-control" value="<?= esc($sosmed['sosmed_youtube'], 'attr'); ?>">
                        </div>

                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-primary rounded-pill px-5">Simpan Sosmed</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>