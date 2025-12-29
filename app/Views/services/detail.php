<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="py-5 bg-dark position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('https://source.unsplash.com/1600x900/?business,office') center/cover; opacity: 0.3;"></div>

    <div class="container position-relative z-2 text-white text-center py-5">
        <h1 class="display-4 fw-bold animate__animated animate__fadeInDown"><?= $title; ?></h1>
        <p class="lead animate__animated animate__fadeInUp">Solusi profesional dari PT. Pesona Adi Batara</p>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-start p-4 border rounded-3 shadow-sm h-100 bg-white hover-shadow transition-all">
                            <div class="flex-shrink-0">
                                <?php if (!empty($item['image'])): ?>
                                    <img src="/uploads/services/<?= $item['image']; ?>" class="rounded-3" style="width: 60px; height: 60px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="rounded-3 bg-light text-primary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="<?= !empty($item['icon']) ? $item['icon'] : 'fas fa-check-circle'; ?> fa-2x"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="ms-3">
                                <h4 class="fw-bold text-dark h5 mb-2"><?= $item['title']; ?></h4>
                                <p class="text-muted mb-0 small"><?= $item['short_description']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <img src="<?= base_url('assets/img/logo-pab.png'); ?>" height="60" class="grayscale opacity-50 mb-3">
                    <h4 class="text-muted">Data layanan segera tersedia.</h4>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-5">
            <a href="/" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
            </a>
            <a href="https://wa.me/62812345678" class="btn btn-pab-primary rounded-pill px-4 ms-2">
                Hubungi Marketing <i class="fab fa-whatsapp ms-2"></i>
            </a>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>