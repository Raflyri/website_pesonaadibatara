<?php
// Logika penentuan background image
// Ganti 'assets/img/default-service.jpg' dengan path gambar default lokalmu jika ada
$defaultBg = 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1600&auto=format&fit=crop';

if (!empty($hero_img) && file_exists('uploads/services/' . $hero_img)) {
    // Jika ada gambar di database dan filenya benar-benar ada di folder uploads
    $bgImage = base_url('uploads/services/' . $hero_img);
} else {
    // Jika tidak ada, pakai default
    $bgImage = $defaultBg;
}
?>

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="position-relative text-white text-center overflow-hidden" style="padding-top: 160px; padding-bottom: 100px;">

    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background-image: url('<?= $bgImage; ?>'); 
               background-size: cover; 
               background-position: center; 
               z-index: 1;">
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,50,100,0.9)); 
               z-index: 2;">
    </div>

    <div class="container position-relative" style="z-index: 3;">

        <span class="badge rounded-pill bg-info text-dark mb-3 px-3 py-2 animate__animated animate__fadeInDown">
            <i class="fas fa-layer-group me-2"></i><?= lang('Frontend.service.our_services') ?>
        </span>

        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown animate__delay-1s">
            <?= $title; ?>
        </h1>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead opacity-75 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <?= lang('Frontend.service.hero_desc') ?>
                </p>
            </div>
        </div>

        <div class="animate__animated animate__fadeInUp animate__delay-2s mt-2">
            <i class="fas fa-chevron-down fa-2x opacity-50"></i>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-11">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5 text-center">

                        <div class="service-desc fs-5 text-secondary lh-lg mb-4">
                            <?= $desc; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-4 bg-white">
    <div class="container">
        <div class="row">
            <?php if (!empty($items)): ?>

                <?php foreach ($items as $item): ?>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-start p-4 border rounded-3 shadow-sm h-100 bg-white hover-shadow transition-all">

                            <div class="flex-shrink-0">
                                <div class="rounded-3 bg-light text-primary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="<?= !empty($item['icon']) ? $item['icon'] : 'fas fa-check-circle'; ?> fa-2x"></i>
                                </div>
                            </div>

                            <div class="ms-3 w-100">
                                <h4 class="fw-bold text-dark h5 mb-2"><?= $item['title']; ?></h4>
                                <p class="text-muted mb-3 small"><?= $item['short_description']; ?></p>

                                <?php if (!empty($item['image'])): ?>
                                    <div class="mt-3 mb-2">
                                        <img src="/uploads/services/<?= $item['image']; ?>" class="img-fluid rounded-3 w-100 shadow-sm" style="object-fit: cover; max-height: 250px;">
                                    </div>
                                <?php endif; ?>

                                <?php
                                $gallery = json_decode($item['gallery'] ?? '[]', true);
                                if (!empty($gallery) && is_array($gallery)):
                                ?>
                                    <div class="row g-2 mt-2">
                                        <?php foreach ($gallery as $gImg): ?>
                                            <div class="col-4"> <a href="/uploads/services/<?= $gImg; ?>" target="_blank">
                                                    <img src="/uploads/services/<?= $gImg; ?>" class="img-fluid rounded border" style="height: 60px; object-fit: cover; width: 100%;">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <img src="<?= base_url('assets/img/logo-pab.png'); ?>" height="60" class="grayscale opacity-50 mb-3">
                    <h4 class="text-muted"><?= lang('Frontend.service.coming_soon') ?></h4>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-5">
            <a href="/" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i> <?= lang('Frontend.global.back_to_home'); ?>
            </a>
            <a href="https://wa.me/<?= $whatsapp; ?>" class="btn btn-pab-primary rounded-pill px-4 ms-2">
                <?= lang('Frontend.service.marketing_contact'); ?> <i class="fab fa-whatsapp ms-2"></i>
            </a>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>