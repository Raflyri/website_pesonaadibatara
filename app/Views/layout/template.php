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
                            <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                        </ul>
                    </div>

                    <div class="d-none d-lg-flex gap-2 header-actions">
                        <a href="tel:+622112345678" class="btn btn-outline-primary rounded-pill btn-morph d-flex align-items-center">
                            <i class="fas fa-phone"></i>
                            <span class="btn-text ms-2">Hubungi Kami</span>
                        </a>

                        <a href="https://wa.me/62812345678" target="_blank" class="btn btn-success rounded-pill btn-morph d-flex align-items-center">
                            <i class="fab fa-whatsapp"></i>
                            <span class="btn-text ms-2">WhatsApp Kami</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <main>
        <?= $this->renderSection('content'); ?>
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <small>&copy; <?= date('Y'); ?> PT. Pesona Adi Batara - Member of YKP BTN</small>
        </div>
    </footer>



    <?= $this->renderSection('scripts'); ?>

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

</body>

</html>