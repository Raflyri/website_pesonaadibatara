<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Kelola Berita & Artikel</h3>
    <a href="/admin/news/create" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="fas fa-plus me-2"></i> Tulis Berita Baru
    </a>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
        <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="15%">Thumbnail</th>
                        <th width="35%">Judul Berita</th>
                        <th width="15%">Penulis</th>
                        <th width="15%">Tanggal</th>
                        <th width="15%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($news) && is_array($news)) : ?>
                        <?php $i = 1; foreach ($news as $item) : ?>
                            <tr>
                                <td class="text-center fw-bold text-muted"><?= $i++; ?></td>
                                <td>
                                    <?php if($item['thumbnail']): ?>
                                        <img src="/uploads/news/<?= $item['thumbnail']; ?>" class="rounded-3 object-fit-cover shadow-sm" width="80" height="60" alt="Thumb">
                                    <?php else: ?>
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted small" style="width: 80px; height: 60px;">No Image</div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark mb-1"><?= esc($item['title']); ?></div>
                                    <small class="text-muted"><i class="fas fa-eye me-1"></i> <?= $item['views'] ?? 0; ?>x dilihat</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-user-circle me-1"></i> <?= esc($item['author']); ?>
                                    </span>
                                </td>
                                <td class="text-muted small">
                                    <i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($item['created_at'])); ?>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="/news/<?= $item['slug']; ?>" target="_blank" class="btn btn-sm btn-light text-secondary" title="Lihat di Web">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                        <a href="/admin/news/edit/<?= $item['id']; ?>" class="btn btn-sm btn-light text-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="/admin/news/<?= $item['id']; ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus berita ini?');">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" width="100" class="mb-3 opacity-50">
                                <h6 class="text-muted fw-bold">Belum ada berita</h6>
                                <p class="text-muted small mb-0">Yuk mulai tulis artikel pertamamu!</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <?php if(isset($pager)): ?>
            <div class="mt-4">
                <?= $pager->links('default', 'bootstrap_pagination') ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>