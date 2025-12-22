<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
$cover = !empty($news['image']) ? '/uploads/news/' . $news['image'] : 'https://source.unsplash.com/random/1200x600?business';
?>
<div class="position-relative" style="height: 450px; background-color: #333;">
    <img src="<?= $cover; ?>" class="w-100 h-100 object-fit-cover opacity-50" alt="<?= esc($news['title_id']); ?>">
    <div class="position-absolute top-50 start-50 translate-middle text-center w-75">
        <span class="badge bg-primary text-uppercase mb-3 px-3 py-2"><?= $news['category']; ?></span>
        <h1 class="text-white fw-bold display-5 shadow-sm"><?= esc($news['title_id']); ?></h1>
        <div class="text-white-50 mt-3">
            <i class="far fa-user me-2"></i> Admin PAB &nbsp;&bull;&nbsp;
            <i class="far fa-calendar-alt me-2"></i> <?= date('d F Y', strtotime($news['created_at'])); ?>
        </div>
    </div>
</div>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 mx-auto">
                <article class="blog-post">
                    <div class="lead text-dark lh-lg mb-5 content-body">
                        <?= $news['content_id']; ?>
                    </div>

                    <style>
                        .content-body img {
                            max-width: 100% !important;
                            height: auto !important;
                            border-radius: 10px;
                            margin: 20px 0;
                        }

                        .content-body iframe {
                            width: 100%;
                            /* Untuk video Youtube responsif */
                        }
                    </style>
                </article>

                <div class="border-top border-bottom py-4 my-5 d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Bagikan tulisan ini:</span>
                    <div>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-info rounded-circle"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-success rounded-circle"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="text-center">
                    <a href="/" class="btn btn-light rounded-pill px-4"><i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-5 bg-light border-top">
    <div class="container">

        <div class="text-center mb-5">
            <h3 class="fw-bold text-dark">Eksplorasi Lebih Lanjut</h3>
            <p class="text-muted">Temukan informasi menarik lainnya.</p>

            <ul class="nav nav-pills justify-content-center d-inline-flex bg-white rounded-pill p-1 shadow-sm mt-3" id="relatedTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill px-4" id="rel-news-tab" data-bs-toggle="pill" data-bs-target="#rel-news" type="button" role="tab">
                        <i class="far fa-newspaper me-2"></i> Berita Lainnya
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4" id="rel-article-tab" data-bs-toggle="pill" data-bs-target="#rel-article" type="button" role="tab">
                        <i class="fas fa-pen-nib me-2"></i> Artikel Terkait
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="relatedTabContent">

            <div class="tab-pane fade show active" id="rel-news" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <?php if (!empty($related_news)) : ?>
                        <?php foreach ($related_news as $item) : ?>
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm hover-top overflow-hidden">
                                    <div class="overflow-hidden position-relative" style="height: 200px;">
                                        <?php $thumb = !empty($item['image']) ? '/uploads/news/' . $item['image'] : 'https://source.unsplash.com/random/800x600?office'; ?>
                                        <img src="<?= $thumb; ?>" class="card-img-top w-100 h-100 object-fit-cover transition-transform" alt="<?= esc($item['title_id']); ?>">
                                        <div class="badge bg-primary position-absolute top-0 start-0 m-3 py-1 px-2 small">NEWS</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="small text-muted mb-2"><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($item['created_at'])); ?></div>
                                        <h6 class="fw-bold mb-0">
                                            <a href="/news/<?= $item['slug']; ?>" class="text-dark text-decoration-none stretched-link">
                                                <?= esc($item['title_id']); ?>
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-12 text-center text-muted py-4">
                            <i class="far fa-folder-open fa-2x mb-2"></i>
                            <p>Tidak ada berita terkait lainnya saat ini.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="rel-article" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <?php if (!empty($related_articles)) : ?>
                        <?php foreach ($related_articles as $item) : ?>
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm hover-top overflow-hidden">
                                    <div class="overflow-hidden position-relative" style="height: 200px;">
                                        <?php $thumb = !empty($item['image']) ? '/uploads/news/' . $item['image'] : 'https://source.unsplash.com/random/800x600?book'; ?>
                                        <img src="<?= $thumb; ?>" class="card-img-top w-100 h-100 object-fit-cover transition-transform" alt="<?= esc($item['title_id']); ?>">
                                        <div class="badge bg-success position-absolute top-0 start-0 m-3 py-1 px-2 small">ARTIKEL</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="small text-muted mb-2"><i class="far fa-user me-1"></i> Admin PAB &bull; <?= date('d M Y', strtotime($item['created_at'])); ?></div>
                                        <h6 class="fw-bold mb-0">
                                            <a href="/news/<?= $item['slug']; ?>" class="text-dark text-decoration-none stretched-link">
                                                <?= esc($item['title_id']); ?>
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-12 text-center text-muted py-4">
                            <i class="far fa-folder-open fa-2x mb-2"></i>
                            <p>Tidak ada artikel edukasi lainnya saat ini.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection(); ?>