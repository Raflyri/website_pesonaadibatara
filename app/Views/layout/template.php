<!doctype html>
<html lang="<?= service('request')->getLocale(); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?? 'PT. Pesona Adi Batara'; ?></title>

    <meta name="description" content="<?= $meta_desc ?? lang('Layout.meta.default_description'); ?>">

    <meta name="keywords" content="<?= $meta_keywords ?? 'logistik, transportasi, ev, eo, outsourcing'; ?>">

    <meta name="author" content="PT. Pesona Adi Batara">

    <meta property="og:title" content="<?= $title ?? 'PT. Pesona Adi Batara'; ?>">
    <meta property="og:description" content="<?= $meta_desc ?? lang('Layout.meta.default_og_description'); ?>">
    <meta property="og:image" content="<?= $meta_image ?? base_url('assets/img/logo-pab.png'); ?>">
    <meta property="og:url" content="<?= current_url(); ?>">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/header.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/company-tagline.css'); ?>">

    <?= $this->renderSection('styles'); ?>

    <?php
    $settingModel = new \App\Models\SiteSettingModel();
    $fontName = $settingModel->getVal('company_tagline_font');
    ?>

    <?php if (!empty($fontName)): ?>
        <?php
        // Ubah spasi jadi plus (cth: "Open Sans" -> "Open+Sans")
        $fontUrlVal = str_replace(' ', '+', $fontName);
        ?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=<?= $fontUrlVal; ?>:wght@400;600;700&display=swap" rel="stylesheet">
    <?php endif; ?>

    <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>" type="image/x-icon">

</head>

<body>
    <div class="header-floating-wrapper fixed-top mt-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-rounded-box shadow-sm transition-all">
                <div class="container-fluid px-4">
                    <a class="navbar-brand d-flex flex-row align-items-center gap-2 gap-md-3 p-0" href="/">

                        <?php
                        $settingModel = new \App\Models\SiteSettingModel();
                        $tagline      = $settingModel->getLocalizedVal('company_tagline');
                        $fontName     = $settingModel->getVal('company_tagline_font');
                        $taglineSize  = $settingModel->getVal('company_tagline_size');
                        $taglineColor = $settingModel->getVal('company_tagline_color');
                        $iconName        = $settingModel->getVal('company_icon');
                        $companyWhatsapp = $settingModel->getVal('company_whatsapp');
                        $companyPhone    = $settingModel->getVal('company_phone');
                        $companyEmail    = $settingModel->getVal('company_email');
                        $companyAddress  = $settingModel->getVal('company_address');
                        // Default icon
                        $logoSrc = !empty($iconName) ? base_url('assets/img/' . $iconName) : base_url('assets/img/logo-pab.png');
                        ?>

                        <img src="<?= $logoSrc; ?>" alt="Logo Perusahaan" class="logo-transition">

                        <!-- <?php if ($tagline): ?>
                            <div class="company-tagline-wrapper d-flex align-items-center">
                                <span class="company-tagline m-0 lh-sm"
                                    style="<?= !empty($fontName) ? "font-family: '$fontName', sans-serif; " : '' ?><?= !empty($taglineSize) ? "font-size: {$taglineSize}px; " : '' ?><?= !empty($taglineColor) ? "color: {$taglineColor}; " : '' ?>">
                                    <?= $tagline; ?>
                                </span>
                            </div>
                        <?php endif; ?> -->

                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-center" id="navbarMain">
                        <ul class="navbar-nav align-items-center gap-3 fw-medium">

                            <li class="nav-item">
                                <!--<a class="nav-link <?= (uri_string() == '' || uri_string() == '/') ? 'active' : ''; ?>" href="/">Beranda</a>-->
                                <a class="nav-link" href="<?= base_url('/'); ?>"><?= lang('Layout.navbar.home'); ?></a>
                            </li>

                            <li class="nav-item">
                                <!--<a class="nav-link <?= (uri_string() == 'about') ? 'active' : ''; ?>" href="/about">Tentang Kami</a>-->
                                <a class="nav-link" href="<?= base_url('about'); ?>"><?= lang('Layout.navbar.about'); ?></a>
                            </li>

                            <li class="nav-item dropdown">
                                <!--<a class="nav-link dropdown-toggle <?= (strpos(uri_string(), 'layanan') === 0) ? 'active' : ''; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Layanan
                                </a>-->
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= lang('Layout.navbar.services'); ?></a>
                                <ul class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeIn" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item py-2 rounded-3 d-flex align-items-center <?= (uri_string() == 'layanan/transportasi') ? 'active bg-light' : ''; ?>" href="/layanan/transportasi">
                                            <div class="icon-small bg-blue-light me-3 text-primary"><i class="fas fa-car-side"></i></div>
                                            <div>
                                                <span class="fw-bold d-block"><?= lang('Layout.navbar.transportation'); ?></span>
                                                <small class="text-muted" style="font-size: 0.7rem;"><?= lang('Layout.navbar.transport_desc') ?></small>
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
                                                <span class="fw-bold d-block"><?= lang('Layout.navbar.health') ?></span>
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
                                                <span class="fw-bold d-block"><?= lang('Layout.navbar.services_general') ?></span>
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
                                                <span class="fw-bold d-block"><?= lang('Layout.navbar.investment') ?></span>
                                                <small class="text-muted" style="font-size: 0.7rem;">KSO & F&B</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?= (uri_string() == 'contact') ? 'active' : ''; ?>" href="/contact"><?= lang('Layout.navbar.contact'); ?></a>
                            </li>
                        </ul>

                        <!-- Mobile-only: Language Switcher & Contact Buttons -->
                        <div class="d-lg-none mobile-menu-extras border-top mt-3 pt-3">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="small fw-bold text-muted text-uppercase">Language:</span>
                                <a href="<?= base_url('language/id'); ?>" class="btn btn-sm <?= ($currentLang ?? 'id') == 'id' ? 'btn-primary' : 'btn-outline-secondary'; ?> rounded-pill px-3 d-flex align-items-center gap-1">
                                    <img src="https://flagcdn.com/w20/id.png" alt="ID" style="width: 16px;"> ID
                                </a>
                                <a href="<?= base_url('language/en'); ?>" class="btn btn-sm <?= ($currentLang ?? 'id') == 'en' ? 'btn-primary' : 'btn-outline-secondary'; ?> rounded-pill px-3 d-flex align-items-center gap-1">
                                    <img src="https://flagcdn.com/w20/gb.png" alt="EN" style="width: 16px;"> EN
                                </a>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <a href="tel:<?= preg_replace('/[^0-9+]/', '', $companyPhone ?? ''); ?>" class="btn btn-outline-primary rounded-pill d-flex align-items-center gap-2 py-2">
                                    <i class="fas fa-phone"></i> <?= lang('Layout.navbar.call_us') ?>
                                </a>
                                <a href="https://wa.me/<?= $companyWhatsapp ?? ''; ?>" target="_blank" class="btn btn-success rounded-pill d-flex align-items-center gap-2 py-2">
                                    <i class="fab fa-whatsapp"></i> <?= lang('Layout.navbar.wa_us') ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-lg-flex align-items-center ms-auto gap-3 btn-login-wrapper">
                        <div class="d-none d-lg-flex align-items-center ms-auto gap-3 btn-login-wrapper">

                            <div class="dropdown lang-switcher">
                                <button class="btn btn-light rounded-pill px-3 d-flex align-items-center gap-2 border shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">

                                    <?php
                                    // Ambil locale yang sedang aktif dari sistem
                                    $currentLang = service('request')->getLocale();
                                    ?>

                                    <img src="https://flagcdn.com/w20/<?= ($currentLang == 'en') ? 'gb' : 'id'; ?>.png" alt="Lang" style="width: 20px;">
                                    <span class="small fw-bold text-uppercase"><?= $currentLang; ?></span>
                                    <i class="fas fa-chevron-down small text-muted ms-1"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2 animate__animated animate__fadeIn">
                                    <li>
                                        <a class="dropdown-item rounded-3 d-flex align-items-center gap-2 py-2" href="<?= base_url('language/id'); ?>">
                                            <img src="https://flagcdn.com/w20/id.png" alt="ID" style="width: 20px;">
                                            <div class="d-flex flex-column">
                                                <span class="small fw-bold">Indonesia</span>
                                            </div>
                                            <?php if ($currentLang == 'id'): ?>
                                                <i class="fas fa-check text-primary ms-auto small"></i>
                                            <?php endif; ?>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item rounded-3 d-flex align-items-center gap-2 py-2" href="<?= base_url('language/en'); ?>">
                                            <img src="https://flagcdn.com/w20/gb.png" alt="EN" style="width: 20px;">
                                            <div class="d-flex flex-column">
                                                <span class="small fw-bold">English</span>
                                            </div>
                                            <?php if ($currentLang == 'en'): ?>
                                                <i class="fas fa-check text-primary ms-auto small"></i>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="position-relative contact-hover-wrapper">

                            <button class="btn btn-pab-primary rounded-pill px-4 shadow-sm position-relative z-2">
                                <?= lang('Layout.navbar.contact_us'); ?><i class="fas fa-angle-down ms-2 small"></i>
                            </button>

                            <div class="contact-popup-menu">
                                <div class="d-flex flex-column gap-2">

                                    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $companyPhone ?? ''); ?>" class="btn btn-light rounded-pill d-flex align-items-center p-2 pe-3 border-0 shadow-sm hover-scale">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <span class="ms-3 fw-bold text-dark small"><?= lang('Layout.navbar.call_us') ?></span>
                                    </a>

                                    <a href="https://wa.me/<?= $companyWhatsapp ?? ''; ?>" target="_blank" class="btn btn-light rounded-pill d-flex align-items-center p-2 pe-3 border-0 shadow-sm hover-scale">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                            <i class="fab fa-whatsapp"></i>
                                        </div>
                                        <span class="ms-3 fw-bold text-dark small"><?= lang('Layout.navbar.wa_us') ?></span>
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

    <div class="company-tagline-section position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <?php
            $settingModel = new \App\Models\SiteSettingModel();
            $footerTaglineMain = $settingModel->getLocalizedVal('company_tagline');
            $footerFontMain = $settingModel->getVal('company_tagline_font');
            $footerSizeMain = $settingModel->getVal('company_tagline_size') ?? '36';
            $footerColorMain = $settingModel->getVal('company_tagline_color') ?? '#ffffff';
            ?>
            <?php if ($footerTaglineMain): ?>
                <h2 class="company-tagline-text" style="<?= $footerFontMain ? "font-family: '$footerFontMain', sans-serif;" : ''; ?> font-size: min(<?= $footerSizeMain; ?>px, 8vw); color: <?= $footerColorMain; ?>;">
                    <?= $footerTaglineMain; ?>
                </h2>
            <?php endif; ?>
        </div>
    </div>

    <footer class="bg-dark text-white pt-5 pb-3 mt-0 border-top border-primary border-5">
        <div class="container">
            <div class="row g-4 justify-content-between">

                <div class="col-lg-4 col-md-6">
                    <div class="mb-4">
                        <img src="<?= base_url('assets/img/logo-pab.png'); ?>" alt="Logo PAB" height="85" class="bg-white rounded p-2 mb-3">
                        <h5 class="fw-bold text-white">PT. PESONA ADI BATARA</h5>

                        <p class="text-white-50 small mb-4">
                            <?= lang('Layout.footer.footer_info'); ?>
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
                    <h6 class="text-primary fw-bold text-uppercase mb-3 ls-1"><?= lang('Layout.footer.footer_sec_services'); ?></h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="/layanan/transportasi"><i class="fas fa-angle-right me-2 text-primary"></i><?= lang('Layout.footer.service_transport'); ?></a></li>
                        <li><a href="/layanan/kesehatan"><i class="fas fa-angle-right me-2 text-primary"></i><?= lang('Layout.footer.service_health'); ?></a></li>
                        <li><a href="/layanan/jasa"><i class="fas fa-angle-right me-2 text-primary"></i><?= lang('Layout.footer.service_eo'); ?></a></li>
                        <li><a href="/layanan/investasi"><i class="fas fa-angle-right me-2 text-primary"></i><?= lang('Layout.footer.service_investment'); ?></a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="text-primary fw-bold text-uppercase mb-3 ls-1"><?= lang('Layout.footer.footer_sec_company'); ?></h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="/about"><i class="fas fa-angle-right me-2 text-primary"></i><?= lang('Layout.footer.link_about'); ?></a></li>
                        <li><a href="/news"><i class="fas fa-angle-right me-2 text-primary"></i><?= lang('Layout.footer.link_news_article'); ?></a></li>
                        <li><a href="/career"><i class="fas fa-angle-right me-2 text-primary"></i><?= lang('Layout.footer.link_career'); ?></a></li>
                        <li><a href="/contact"><i class="fas fa-angle-right me-2 text-primary"></i><?= lang('Layout.footer.link_contact'); ?></a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="text-primary fw-bold text-uppercase mb-3 ls-1"><?= lang('Layout.footer.footer_office'); ?></h6>
                    <ul class="list-unstyled text-white-50 small">
                        <li class="mb-3 d-flex">
                            <i class="fas fa-map-marker-alt text-primary mt-1 me-3"></i>
                            <span><?= nl2br($companyAddress ?? ''); ?></span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="fas fa-phone-alt text-primary mt-1 me-3"></i>
                            <span><?= $companyPhone ?? ''; ?></span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="fas fa-envelope text-primary mt-1 me-3"></i>
                            <span><?= $companyEmail ?? ''; ?></span>
                        </li>
                    </ul>
                </div>
            </div>



            <hr class="border-secondary my-4 opacity-25">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <small class="text-white-50"><?= lang('Layout.footer.copyright') ?></small>
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