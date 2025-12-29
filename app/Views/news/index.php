<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="py-5 bg-dark position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(45deg, #004e92, #000428); opacity: 0.9;"></div>
    <div class="container position-relative z-2 text-white text-center py-4">
        <h1 class="fw-bold display-5 mb-3"><?= $title; ?></h1>
        <p class="lead text-light opacity-75">Informasi terkini, wawasan bisnis, dan kegiatan korporasi.</p>
        
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <form action="/news" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control rounded-start-pill ps-4 py-2" name="keyword" placeholder="Cari artikel..." value="<?= $keyword ?? ''; ?>">
                        <button class="btn btn-warning rounded-end-pill px-4 fw-bold" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        
        <?php if(!empty($keyword)): ?>
            <div class="mb-4">
                <p class="text-muted">Menampilkan hasil pencarian untuk: <strong>"<?= esc($keyword); ?>"</strong></p>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <?php if (!empty($news_list)) : ?>
                <?php foreach ($news_list as $item) : ?>
                    <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 border-0 shadow-sm hover-top overflow-hidden rounded-4">
                            <div class="position-relative overflow-hidden" style="height: 220px;">
                                <?php 
                                    $imgSrc = !empty($item['image']) ? '/uploads/news/' . $item['image'] : 'https://source.unsplash.com/random/800x600?office';
                                ?>
                                <img src="<?= $imgSrc; ?>" class="card-img-top w-100 h-100 object-fit-cover transition-transform" alt="<?= esc($item['title_id']); ?>">
                                
                                <span class="badge bg-primary position-absolute top-0 start-0 m-3 shadow-sm text-uppercase ls-1" style="font-size: 0.7rem;">
                                    <?= $item['category']; ?>
                                </span>
                            </div>

                            <div class="card-body p-4 d-flex flex-column">
                                <div class="text-muted small mb-2">
                                    <i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($item['created_at'])); ?>
                                    <span class="mx-2">&bull;</span>
                                    <i class="far fa-eye me-1"></i> <?= $item['views']; ?> dilihat
                                </div>
                                
                                <h5 class="card-title fw-bold mb-3">
                                    <a href="/news/<?= $item['slug']; ?>" class="text-dark text-decoration-none hover-primary">
                                        <?= esc($item['title_id']); ?>
                                    </a>
                                </h5>
                                
                                <p class="card-text text-muted small flex-grow-1">
                                    <?= substr(strip_tags($item['content_id']), 0, 100); ?>...
                                </p>
                                
                                <a href="/news/<?= $item['slug']; ?>" class="btn btn-outline-primary btn-sm rounded-pill mt-3 w-100">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12 text-center py-5">
                    <div class="bg-white p-5 rounded-4 shadow-sm d-inline-block">
                        <i class="far fa-folder-open fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Tidak ada artikel ditemukan.</h4>
                        <a href="/news" class="btn btn-sm btn-secondary mt-2">Reset Pencarian</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-5 d-flex justify-content-center">
            <?= $pager->links('news', 'default_full') ?>
        </div>

    </div>
</section>

<?= $this->endSection(); ?>