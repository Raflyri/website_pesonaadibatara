<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="swiper mySwiper hero-slider">
    <div class="swiper-wrapper">
        <?php foreach ($banners as $banner): ?>
            <div class="swiper-slide">
                <div class="slide-bg" style="background-image: url('<?= $banner['image']; ?>');"></div>

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
                <div class="position-relative" style="height: 400px;"> <video id="whyUsVideo" class="img-fluid rounded-4 shadow-lg position-relative z-2 w-100 h-100" style="object-fit: cover;" muted loop playsinline poster="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=1000">
                        <source src="assets\video\logo-pab-animated.mp4" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>

                    <div class="position-absolute bg-primary rounded-4" style="width: 100%; height: 100%; top: 20px; left: -20px; z-index: 1; opacity: 0.1;"></div>
                </div>
            </div>

            <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                <h6 class="text-primary fw-bold text-uppercase mb-2">Kenapa Memilih Kami?</h6>
                <h2 class="fw-bold mb-4">Mitra Strategis Pendukung Operasional Bisnis Anda</h2>
                <p class="text-muted mb-4">PT. Pesona Adi Batara hadir dengan standar layanan prima yang terintegrasi, memastikan operasional bisnis Anda berjalan tanpa hambatan dengan efisiensi tinggi.</p>

                <div class="d-flex mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex-shrink-0">
                        <div class="bg-light text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-shield-alt fa-lg"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold">Jaminan Kualitas Layanan</h5>
                        <p class="text-muted mb-0">Standar operasional prosedur (SOP) ketat yang mengacu pada standar perbankan nasional.</p>
                    </div>
                </div>

                <div class="d-flex mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex-shrink-0">
                        <div class="bg-light text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-user-tie fa-lg"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold">SDM Profesional & Terlatih</h5>
                        <p class="text-muted mb-0">Seluruh tenaga kerja telah melalui proses seleksi ketat dan pelatihan berkala.</p>
                    </div>
                </div>

                <a href="#" class="btn btn-pab-primary rounded-pill px-4 mt-2" data-aos="zoom-in">Pelajari Profil Kami</a>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
            <div>
                <h2 class="fw-bold text-dark">Berita & Artikel</h2>
                <p class="text-muted mb-0">Informasi terbaru seputar kegiatan perusahaan</p>
            </div>
            <a href="#" class="btn btn-outline-primary rounded-pill px-4 d-none d-md-block">Lihat Semua <i class="fas fa-arrow-right ms-2"></i></a>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm overflow-hidden group-hover">
                    <div class="overflow-hidden position-relative" style="height: 220px;">
                        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=800" class="card-img-top w-100 h-100 object-fit-cover transition-transform" alt="News">
                        <div class="badge bg-primary position-absolute top-0 start-0 m-3 py-2 px-3">CORPORATE</div>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-2 text-muted small"><i class="far fa-calendar-alt me-2"></i> 19 Des 2025</div>
                        <h5 class="card-title fw-bold mb-3">
                            <a href="#" class="text-dark text-decoration-none stretched-link">Peningkatan Kualitas Armada Operasional Tahun 2025</a>
                        </h5>
                        <p class="card-text text-muted small">Dalam rangka mendukung operasional klien, PAB meremajakan 50 unit kendaraan baru...</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm overflow-hidden group-hover">
                    <div class="overflow-hidden position-relative" style="height: 220px;">
                        <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=800" class="card-img-top w-100 h-100 object-fit-cover transition-transform" alt="News">
                        <div class="badge bg-success position-absolute top-0 start-0 m-3 py-2 px-3">TRAINING</div>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-2 text-muted small"><i class="far fa-calendar-alt me-2"></i> 15 Des 2025</div>
                        <h5 class="card-title fw-bold mb-3">
                            <a href="#" class="text-dark text-decoration-none stretched-link">Pelatihan Safety Driving untuk Driver Korporat</a>
                        </h5>
                        <p class="card-text text-muted small">Kegiatan rutin tahunan untuk memastikan standar keamanan berkendara bagi seluruh driver...</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm overflow-hidden group-hover">
                    <div class="overflow-hidden position-relative" style="height: 220px;">
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800" class="card-img-top w-100 h-100 object-fit-cover transition-transform" alt="News">
                        <div class="badge bg-info position-absolute top-0 start-0 m-3 py-2 px-3 text-white">FACILITY</div>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-2 text-muted small"><i class="far fa-calendar-alt me-2"></i> 10 Des 2025</div>
                        <h5 class="card-title fw-bold mb-3">
                            <a href="#" class="text-dark text-decoration-none stretched-link">Implementasi Sistem Kebersihan Baru di Gedung Pusat</a>
                        </h5>
                        <p class="card-text text-muted small">Penerapan teknologi cleaning service terbaru untuk efisiensi dan kebersihan maksimal...</p>
                    </div>
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