<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'PT. Pesona Adi Batara'; ?></title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>" type="image/x-icon">
</head>

<body>
    <div class="header-floating-wrapper fixed-top mt-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-rounded-box shadow-sm transition-all">
                <div class="container-fluid px-4">
                    <a class="navbar-brand" href="/">
                        <img src="<?= base_url('assets/img/logo-pab.png'); ?>" alt="Logo PAB" class="logo-transition">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav align-items-center gap-3 fw-medium">

                            <li class="nav-item">
                                <a class="nav-link <?= (uri_string() == '' || uri_string() == '/') ? 'active' : ''; ?>" href="/">Beranda</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?= (uri_string() == 'about') ? 'active' : ''; ?>" href="/about">Tentang Kami</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle <?= (strpos(uri_string(), 'layanan') === 0) ? 'active' : ''; ?>" href="#" id="navbarDropdown" role="button" aria-expanded="false">
                                    Layanan
                                </a>
                                <ul class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeIn" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item py-2 rounded-3 d-flex align-items-center <?= (uri_string() == 'layanan/transportasi') ? 'active bg-light' : ''; ?>" href="/layanan/transportasi">
                                            <div class="icon-small bg-blue-light me-3 text-primary"><i class="fas fa-car-side"></i></div>
                                            <div>
                                                <span class="fw-bold d-block">Transportasi</span>
                                                <small class="text-muted" style="font-size: 0.7rem;">Luxury Car & Operasional</small>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider my-1">
                                    </li>

                                    <li>
                                        <a class="dropdown-item py-2 rounded-3 d-flex align-items-center <?= (uri_string() == 'layanan/kesehatan') ? 'active bg-light' : ''; ?>" href="/layanan/kesehatan">
                                            <div class="icon-small bg-green-light me-3 text-success"><i class="fas fa-heartbeat"></i></div>
                                            <div>
                                                <span class="fw-bold d-block">Kesehatan</span>
                                                <small class="text-muted" style="font-size: 0.7rem;">Batara Health Care</small>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider my-1">
                                    </li>

                                    <li>
                                        <a class="dropdown-item py-2 rounded-3 d-flex align-items-center <?= (uri_string() == 'layanan/jasa') ? 'active bg-light' : ''; ?>" href="/layanan/jasa">
                                            <div class="icon-small bg-orange-light me-3 text-warning"><i class="fas fa-concierge-bell"></i></div>
                                            <div>
                                                <span class="fw-bold d-block">Jasa</span>
                                                <small class="text-muted" style="font-size: 0.7rem;">Fasade & EO</small>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider my-1">
                                    </li>

                                    <li>
                                        <a class="dropdown-item py-2 rounded-3 d-flex align-items-center <?= (uri_string() == 'layanan/investasi') ? 'active bg-light' : ''; ?>" href="/layanan/investasi">
                                            <div class="icon-small bg-purple-light me-3 text-info"><i class="fas fa-chart-line"></i></div>
                                            <div>
                                                <span class="fw-bold d-block">Investasi</span>
                                                <small class="text-muted" style="font-size: 0.7rem;">KSO & F&B</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?= (uri_string() == 'contact') ? 'active' : ''; ?>" href="/contact">Kontak</a>
                            </li>
                        </ul>
                    </div>

                    <div class="d-none d-lg-flex align-items-center ms-auto gap-3 btn-login-wrapper">

                        <div class="dropdown lang-switcher">
                            <button class="btn btn-light rounded-pill px-3 d-flex align-items-center gap-2 border shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">

                                <?php $currentLang = session()->get('lang') ?? 'id'; ?>
                                <img src="https://flagcdn.com/w20/<?= ($currentLang == 'en') ? 'gb' : 'id'; ?>.png" alt="Lang" style="width: 20px;">
                                <span class="small fw-bold text-uppercase"><?= $currentLang; ?></span>
                                <i class="fas fa-chevron-down small text-muted ms-1"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2 animate__animated animate__fadeIn">
                                <li>
                                    <a class="dropdown-item rounded-3 d-flex align-items-center gap-2 py-2" href="<?= current_url(); ?>?lang=id">
                                        <img src="https://flagcdn.com/w20/id.png" alt="ID" style="width: 20px;">
                                        <span class="small fw-bold">Indonesia</span>
                                        <?php if ($currentLang == 'id'): ?>
                                            <i class="fas fa-check text-primary ms-auto small"></i>
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <!--li>
                                    <a class="dropdown-item rounded-3 d-flex align-items-center gap-2 py-2" href="<?= current_url(); ?>?lang=en">
                                        <img src="https://flagcdn.com/w20/gb.png" alt="EN" style="width: 20px;">
                                        <span class="small fw-bold">English</span>
                                        <?php if ($currentLang == 'en'): ?>
                                            <i class="fas fa-check text-primary ms-auto small"></i>
                                        <?php endif; ?>
                                    </a>
                                </li-->
                            </ul>
                        </div>

                        <div class="position-relative contact-hover-wrapper">

                            <button class="btn btn-pab-primary rounded-pill px-4 shadow-sm position-relative z-2">
                                Hubungi Kami <i class="fas fa-angle-down ms-2 small"></i>
                            </button>

                            <div class="contact-popup-menu">
                                <div class="d-flex flex-column gap-2">

                                    <a href="tel:+622112345678" class="btn btn-light rounded-pill d-flex align-items-center p-2 pe-3 border-0 shadow-sm hover-scale">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <span class="ms-3 fw-bold text-dark small">Telepon Kami</span>
                                    </a>

                                    <a href="https://wa.me/62812345678" target="_blank" class="btn btn-light rounded-pill d-flex align-items-center p-2 pe-3 border-0 shadow-sm hover-scale">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                            <i class="fab fa-whatsapp"></i>
                                        </div>
                                        <span class="ms-3 fw-bold text-dark small">WhatsApp Kami</span>
                                    </a>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </nav>
        </div>
    </div>

    <main>
        <?= $this->renderSection('content'); ?>
    </main>

    <footer class="bg-dark text-white pt-5 pb-3 mt-5 border-top border-primary border-5">
        <div class="container">
            <div class="row g-4 justify-content-between">

                <div class="col-lg-4 col-md-6">
                    <div class="mb-4">
                        <img src="<?= base_url('assets/img/logo-pab.png'); ?>" alt="Logo PAB" height="50" class="bg-white rounded p-2 mb-3">
                        <h5 class="fw-bold text-white">PT. PESONA ADI BATARA</h5>
                        <p class="text-white-50 small mb-4">
                            Memberikan nilai tambah bagi perusahaan dan stakeholder melalui layanan terintegrasi yang profesional dan terpercaya.
                        </p>

                        <div class="d-flex gap-3">
                            <?php
                            $db = \Config\Database::connect();
                            $ig = $db->table('site_settings')->where('setting_key', 'sosmed_instagram')->get()->getRow()->setting_value ?? '#';
                            $fb = $db->table('site_settings')->where('setting_key', 'sosmed_facebook')->get()->getRow()->setting_value ?? '#';
                            $li = $db->table('site_settings')->where('setting_key', 'sosmed_linkedin')->get()->getRow()->setting_value ?? '#';
                            $yt = $db->table('site_settings')->where('setting_key', 'sosmed_youtube')->get()->getRow()->setting_value ?? '#';
                            ?>

                            <a href="<?= $ig; ?>" target="_blank" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="<?= $fb; ?>" target="_blank" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                            <a href="<?= $li; ?>" target="_blank" class="text-white me-3"><i class="fab fa-linkedin fa-lg"></i></a>
                            <a href="<?= $yt; ?>" target="_blank" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="text-primary fw-bold text-uppercase mb-3 ls-1">Layanan Kami</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="/layanan/transportasi"><i class="fas fa-angle-right me-2 text-primary"></i>Transportasi</a></li>
                        <li><a href="/layanan/kesehatan"><i class="fas fa-angle-right me-2 text-primary"></i>Kesehatan</a></li>
                        <li><a href="/layanan/jasa"><i class="fas fa-angle-right me-2 text-primary"></i>Jasa & EO</a></li>
                        <li><a href="/layanan/investasi"><i class="fas fa-angle-right me-2 text-primary"></i>Investasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="text-primary fw-bold text-uppercase mb-3 ls-1">Perusahaan</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="/about"><i class="fas fa-angle-right me-2 text-primary"></i>Tentang Kami</a></li>
                        <li><a href="/news"><i class="fas fa-angle-right me-2 text-primary"></i>Berita & Artikel</a></li>
                        <li><a href="/career"><i class="fas fa-angle-right me-2 text-primary"></i>Karir</a></li>
                        <li><a href="/contact"><i class="fas fa-angle-right me-2 text-primary"></i>Hubungi Kami</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="text-primary fw-bold text-uppercase mb-3 ls-1">Kantor Pusat</h6>
                    <ul class="list-unstyled text-white-50 small">
                        <li class="mb-3 d-flex">
                            <i class="fas fa-map-marker-alt text-primary mt-1 me-3"></i>
                            <span>
                                The Archies Sudirman (D/H T Plaza),<br>
                                Tower B, Ruko B No.B4.<br>
                                Jl. Penjernihan I No.1 Kav.1,<br>
                                Jakarta Pusat 10210
                            </span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="fas fa-phone-alt text-primary mt-1 me-3"></i>
                            <span>021-39705142</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="fas fa-envelope text-primary mt-1 me-3"></i>
                            <span>administrasi_div@pesonaadibatara.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="border-secondary my-4 opacity-25">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <small class="text-white-50">&copy; <?= date('Y'); ?> <strong>PT. Pesona Adi Batara</strong>. All Rights Reserved.</small>
                </div>
                <!--div class="col-md-6 text-center text-md-end">
                    <span class="text-white-50 small me-2">Member of:</span>
                    <span class="fw-bold text-white border border-light px-2 py-1 rounded">YKP BTN</span>
                </div-->
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
        // Logic Sticky Header (Simplified)
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            const navbarWrapper = document.querySelector(".header-floating-wrapper");

            // Jarak scroll trigger (misal 50px)
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                // Scroll Down: Tambah Class 'sticky-active'
                // CSS akan otomatis mengecilkan logo & tombol
                navbarWrapper.classList.add("sticky-active");

            } else {
                // Scroll Up/Top: Hapus Class
                // CSS akan mengembalikan ukuran semula
                navbarWrapper.classList.remove("sticky-active");
            }
        }
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 800, // Durasi animasi 1 detik

            // UBAH DARI TRUE MENJADI FALSE
            once: false, // false = Animasi akan jalan TERUS setiap kali elemen terlihat

            // TAMBAHKAN INI (Opsional, biar makin smooth)
            mirror: true, // true = Elemen akan animasi 'keluar' saat di-scroll melewatinya
        });
    </script>

    <?= $this->renderSection('scripts'); ?>

</body>

</html>