<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="swiper mySwiper hero-slider">
    <div class="swiper-wrapper">
        <?php foreach ($banners as $banner): ?>
            <div class="swiper-slide">

                <div class="slide-bg" style="background-image: url('<?= base_url('uploads/banners/' . $banner['image']); ?>');"></div>

                <div class="overlay-gradient"></div>

                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-md-8 col-lg-7">
                            <div class="hero-content text-white">
                                <h5 class="text-warning fw-bold mb-3 animate__animated animate__fadeInDown" style="animation-delay: 0.3s;">
                                    PT. PESONA ADI BATARA
                                </h5>
                                <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
                                    <?= $banner['title']; ?>
                                </h1>
                                <p class="lead mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.7s;">
                                    <?= $banner['subtitle']; ?>
                                </p>

                                <?php if (!empty($banner['button_text'])): ?>
                                    <a href="<?= $banner['button_link']; ?>" class="btn btn-pab-cta btn-lg animate__animated animate__fadeInUp" style="animation-delay: 0.9s;">
                                        <?= $banner['button_text']; ?> <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="swiper-button-next text-white"></div>
    <div class="swiper-button-prev text-white"></div>
    <div class="swiper-pagination"></div>
</div>

<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase ls-2">Layanan Kami</h6>
            <h2 class="fw-bold">4 Pilar Bisnis Utama</h2>
            <p class="text-muted col-lg-6 mx-auto">Solusi terintegrasi untuk mendukung pertumbuhan bisnis Anda secara berkelanjutan.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <a href="/layanan/transportasi" class="card-service text-decoration-none h-100 d-block">
                    <div class="card h-100 border-0 shadow-sm hover-top overflow-hidden">
                        <div class="card-body p-4 text-center">
                            <div class="icon-circle bg-blue-light mb-4 mx-auto">
                                <i class="fas fa-car-side fa-2x text-primary"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-3">Transportasi</h5>
                            <p class="text-muted small mb-0">Solusi armada lengkap mulai dari Luxury Car, EV, hingga logistik operasional.</p>
                        </div>
                        <div class="card-footer bg-white border-0 pb-4 text-center">
                            <span class="text-primary fw-bold small">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <a href="/layanan/kesehatan" class="card-service text-decoration-none h-100 d-block">
                    <div class="card h-100 border-0 shadow-sm hover-top overflow-hidden">
                        <div class="card-body p-4 text-center">
                            <div class="icon-circle bg-green-light mb-4 mx-auto">
                                <i class="fas fa-heartbeat fa-2x text-success"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-3">Kesehatan</h5>
                            <p class="text-muted small mb-0">Layanan medis terpadu melalui Batara Health Care, MCU, dan Apotek.</p>
                        </div>
                        <div class="card-footer bg-white border-0 pb-4 text-center">
                            <span class="text-primary fw-bold small">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <a href="/layanan/jasa" class="card-service text-decoration-none h-100 d-block">
                    <div class="card h-100 border-0 shadow-sm hover-top overflow-hidden">
                        <div class="card-body p-4 text-center">
                            <div class="icon-circle bg-orange-light mb-4 mx-auto">
                                <i class="fas fa-concierge-bell fa-2x text-warning"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-3">Jasa</h5>
                            <p class="text-muted small mb-0">Pembersihan Fasade gedung, Event Organizer, dan Pengadaan barang.</p>
                        </div>
                        <div class="card-footer bg-white border-0 pb-4 text-center">
                            <span class="text-primary fw-bold small">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <a href="/layanan/investasi" class="card-service text-decoration-none h-100 d-block">
                    <div class="card h-100 border-0 shadow-sm hover-top overflow-hidden">
                        <div class="card-body p-4 text-center">
                            <div class="icon-circle bg-purple-light mb-4 mx-auto">
                                <i class="fas fa-chart-line fa-2x text-info"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-3">Investasi</h5>
                            <p class="text-muted small mb-0">Pengembangan bisnis KSO, Food & Beverages, Laundry, dan Sport Center.</p>
                        </div>
                        <div class="card-footer bg-white border-0 pb-4 text-center">
                            <span class="text-primary fw-bold small">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center">

            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="position-relative" style="height: 400px;">

                    <?php
                    $mediaUrl = $why_choose_us['media_url'] ?? '';
                    $isImage = false;

                    if (!empty($mediaUrl)) {
                        $ext = pathinfo($mediaUrl, PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp']);
                    }

                    // Tentukan Source Path
                    if (strpos($mediaUrl, 'http') !== false) {
                        $src = $mediaUrl;
                    } else {
                        // Default fallback jika kosong
                        $src = !empty($mediaUrl) ? base_url('uploads/home/' . $mediaUrl) : 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=1000';
                        // Kalau kosong banget, anggap image dummy
                        if (empty($mediaUrl)) $isImage = true;
                    }
                    ?>

                    <?php if ($isImage): ?>
                        <img src="<?= $src; ?>" class="img-fluid rounded-4 shadow-lg position-relative z-2 w-100 h-100" style="object-fit: cover;" alt="Why Choose Us">

                    <?php else: ?>
                        <video id="whyUsVideo" class="img-fluid rounded-4 shadow-lg position-relative z-2 w-100 h-100" style="object-fit: cover;" muted loop playsinline poster="">
                            <source src="<?= $src; ?>" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    <?php endif; ?>

                    <div class="position-absolute bg-primary rounded-4" style="width: 100%; height: 100%; top: 20px; left: -20px; z-index: 1; opacity: 0.1;"></div>
                </div>
            </div>

            <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                <h6 class="text-primary fw-bold text-uppercase mb-2">Kenapa Memilih Kami?</h6>

                <h2 class="fw-bold mb-4">
                    <?= !empty($why_choose_us['title_id']) ? $why_choose_us['title_id'] : 'Mitra Strategis Pendukung Operasional Bisnis Anda'; ?>
                </h2>

                <p class="text-muted mb-4">
                    <?= !empty($why_choose_us['content_id']) ? $why_choose_us['content_id'] : 'PT. Pesona Adi Batara hadir dengan standar layanan prima...'; ?>
                </p>

                <div class="d-flex mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex-shrink-0">
                        <div class="bg-light text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-shield-alt fa-lg"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold">Jaminan Kualitas Layanan</h5>
                        <p class="text-muted mb-0">Standar operasional prosedur (SOP) ketat.</p>
                    </div>
                </div>
                <a href="/about" class="btn btn-pab-primary rounded-pill px-4 mt-2">Pelajari Profil Kami</a>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-dark">Wawasan & Informasi</h2>
            <p class="text-muted mb-4">Kabar terbaru seputar korporasi dan artikel edukatif untuk Anda.</p>

            <ul class="nav nav-pills justify-content-center d-inline-flex bg-white rounded-pill p-1 shadow-sm" id="newsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill px-4" id="pills-news-tab" data-bs-toggle="pill" data-bs-target="#pills-news" type="button" role="tab" aria-controls="pills-news" aria-selected="true">
                        <i class="far fa-newspaper me-2"></i> Berita Korporat
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4" id="pills-article-tab" data-bs-toggle="pill" data-bs-target="#pills-article" type="button" role="tab" aria-controls="pills-article" aria-selected="false">
                        <i class="fas fa-pen-nib me-2"></i> Artikel & Tips
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="newsTabContent">

            <div class="tab-pane fade show active" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
                <div class="row g-4">
                    <?php if (!empty($latest_news)) : ?>
                        <?php foreach ($latest_news as $news) : ?>
                            <div class="col-md-4" data-aos="fade-up">
                                <div class="card h-100 border-0 shadow-sm overflow-hidden group-hover">
                                    <div class="overflow-hidden position-relative" style="height: 220px;">
                                        <?php
                                        // FIX 1: Ganti 'thumbnail' jadi 'image'
                                        $thumb = !empty($news['image']) ? '/uploads/news/' . $news['image'] : 'https://source.unsplash.com/random/800x600?business';
                                        ?>
                                        <img src="<?= $thumb; ?>" class="card-img-top w-100 h-100 object-fit-cover transition-transform" alt="<?= esc($news['title_id']); ?>">
                                        <div class="badge bg-primary position-absolute top-0 start-0 m-3 py-2 px-3">NEWS</div>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="mb-2 text-muted small">
                                            <i class="far fa-calendar-alt me-2"></i> <?= date('d M Y', strtotime($news['created_at'])); ?>
                                        </div>
                                        <h5 class="card-title fw-bold mb-3">
                                            <a href="/news/<?= $news['slug']; ?>" class="text-dark text-decoration-none stretched-link">
                                                <?= esc($news['title_id']); ?>
                                            </a>
                                        </h5>
                                        <p class="card-text text-muted small">
                                            <?= substr(strip_tags($news['content_id']), 0, 100); ?>...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <div class="col-12 text-center mt-4">
                            <a href="/news/category/berita" class="btn btn-outline-primary rounded-pill px-4">
                                Lihat Berita Lainnya <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>

                    <?php else : ?>
                        <div class="col-12 text-center py-5">
                            <div class="bg-white rounded-4 p-5 shadow-sm d-inline-block">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" width="80" class="mb-3 opacity-50" alt="Empty">
                                <h5 class="fw-bold text-muted">Belum ada berita terbaru</h5>
                                <p class="text-muted small mb-0">Tim kami sedang menyusun informasi menarik untuk Anda.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-article" role="tabpanel" aria-labelledby="pills-article-tab">
                <div class="row g-4">
                    <?php if (!empty($latest_articles)) : ?>
                        <?php foreach ($latest_articles as $article) : ?>
                            <div class="col-md-4" data-aos="fade-up">
                                <div class="card h-100 border-0 shadow-sm overflow-hidden group-hover">
                                    <div class="overflow-hidden position-relative" style="height: 220px;">
                                        <?php
                                        // FIX 1: image
                                        $thumb = !empty($article['image']) ? '/uploads/news/' . $article['image'] : 'https://source.unsplash.com/random/800x600?learning';
                                        ?>
                                        <img src="<?= $thumb; ?>" class="card-img-top w-100 h-100 object-fit-cover transition-transform" alt="<?= esc($article['title_id']); ?>">
                                        <div class="badge bg-success position-absolute top-0 start-0 m-3 py-2 px-3">ARTIKEL</div>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="mb-2 text-muted small">
                                            <i class="far fa-user me-2"></i> Admin PAB &bull;
                                            <?= date('d M Y', strtotime($article['created_at'])); ?>
                                        </div>
                                        <h5 class="card-title fw-bold mb-3">
                                            <a href="/news/<?= $article['slug']; ?>" class="text-dark text-decoration-none stretched-link">
                                                <?= esc($article['title_id']); ?>
                                            </a>
                                        </h5>
                                        <p class="card-text text-muted small">
                                            <?= substr(strip_tags($article['content_id']), 0, 100); ?>...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <div class="col-12 text-center mt-4">
                            <a href="/news/category/artikel" class="btn btn-outline-success rounded-pill px-4">
                                Baca Artikel Lainnya <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>

                    <?php else : ?>
                        <div class="col-12 text-center py-5">
                            <div class="bg-white rounded-4 p-5 shadow-sm d-inline-block">
                                <img src="https://cdn-icons-png.flaticon.com/512/6195/6195678.png" width="80" class="mb-3 opacity-50" alt="Empty">
                                <h5 class="fw-bold text-muted">Belum ada artikel edukasi</h5>
                                <p class="text-muted small mb-0">Nantikan tips dan wawasan menarik segera!</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-5 bg-white border-top" data-aos="fade-up">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-3">Siap Meningkatkan Efisiensi Operasional Anda?</h2>
        <p class="lead text-muted mb-4 col-lg-7 mx-auto">
            Diskusikan kebutuhan manajemen aset, transportasi, dan tenaga alih daya perusahaan Anda bersama konsultan ahli kami.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#" class="btn btn-pab-primary btn-lg rounded-pill px-5 shadow-sm">
                Hubungi Kami
            </a>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success btn-lg rounded-pill px-4 shadow-sm">
                <i class="fab fa-whatsapp me-2"></i> WhatsApp
            </a>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script>
    // Inisialisasi Swiper dengan Fitur Lengkap
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 0,
        centeredSlides: true,
        effect: "fade",
        speed: 1000,

        // REVISI 2: Autoplay 3 Detik
        autoplay: {
            delay: 3000, // 3000ms = 3 detik
            disableOnInteraction: false, // Tetap jalan walau user nge-swipe manual
        },

        pagination: {
            el: ".swiper-pagination",
            clickable: true, // Titik bisa diklik
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        // Fitur tambahan: Keyboard control
        keyboard: {
            enabled: true,
        },
    });

    document.addEventListener("DOMContentLoaded", function() {
        const videoElement = document.getElementById('whyUsVideo');

        if (videoElement) {
            // Kita pakai "Mata-mata" (Intersection Observer)
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    // Jika video terlihat di layar (min 30%)
                    if (entry.isIntersecting) {
                        videoElement.play(); // Putar Video
                    } else {
                        videoElement.pause(); // Stop Video (Hemat resource)
                    }
                });
            }, {
                threshold: 0.3
            }); // 0.3 artinya video akan play saat 30% badannya terlihat

            observer.observe(videoElement);
        }
    });
</script>

<?= $this->endSection(); ?>