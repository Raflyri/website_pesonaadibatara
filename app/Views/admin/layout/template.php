<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel'; ?> | PAB CMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css'); ?>">
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center gap-2">
                <img src="<?= base_url('assets/img/logo-pab.png'); ?>" alt="Logo" height="30">
                <span class="fw-bold text-dark">PAB ADMIN</span>
            </div>
        </div>

        <div class="sidebar-menu">
            <small class="text-uppercase text-muted fw-bold ms-3" style="font-size: 0.75rem;">Main Menu</small>

            <a href="/admin/dashboard" class="nav-link <?= (current_url(true)->getSegment(2) == 'dashboard') ? 'active' : ''; ?> mt-2">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <a href="/admin/home-editor" class="nav-link <?= (current_url(true)->getSegment(2) == 'home-editor') ? 'active' : ''; ?>">
                <i class="fas fa-home"></i> Kelola Beranda
            </a>

            <a href="/admin/about-editor" class="nav-link <?= (current_url(true)->getSegment(2) == 'about-editor') ? 'active' : ''; ?>">
                <i class="fas fa-building"></i> Tentang Kami
            </a>

            <a href="/admin/news" class="nav-link <?= (current_url(true)->getSegment(2) == 'news') ? 'active' : ''; ?>">
                <i class="fas fa-newspaper"></i> Kelola Berita
            </a>

            <a href="/admin/team" class="nav-link <?= (current_url(true)->getSegment(2) == 'team') ? 'active' : ''; ?>">
                <i class="fas fa-users"></i> Direksi & Tim
            </a>

            <a href="/admin/contact-editor" class="nav-link <?= (current_url(true)->getSegment(2) == 'contact-editor') ? 'active' : ''; ?>">
                <i class="fas fa-envelope-open-text"></i> Kontak & Pesan
            </a>

            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menuLayanan" role="button" aria-expanded="false" aria-controls="menuLayanan">
                <span><i class="fas fa-concierge-bell"></i> Layanan Bisnis</span>
                <i class="fas fa-chevron-down small transition-icon"></i>
            </a>

            <div class="collapse <?= (current_url(true)->getSegment(2) == 'services') ? 'show' : ''; ?>" id="menuLayanan">
                <div class="ms-4 border-start border-2 ps-2 mt-1">

                    <a href="/admin/services/transportasi" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'transportasi') ? 'text-primary fw-bold' : ''; ?>">
                        Transportasi
                    </a>

                    <a href="/admin/services/kesehatan" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'kesehatan') ? 'text-primary fw-bold' : ''; ?>">
                        Kesehatan (Health Care)
                    </a>

                    <a href="/admin/services/jasa" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'jasa') ? 'text-primary fw-bold' : ''; ?>">
                        Jasa & Pengadaan
                    </a>

                    <a href="/admin/services/investasi" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'investasi') ? 'text-primary fw-bold' : ''; ?>">
                        Investasi & Usaha Lain
                    </a>
                </div>
            </div>


            <a href="/admin/banner" class="nav-link <?= (current_url(true)->getSegment(2) == 'banner') ? 'active' : ''; ?>">
                <i class="fas fa-images"></i> Banner Slider
            </a>

            <small class="text-uppercase text-muted fw-bold ms-3 mt-4 d-block" style="font-size: 0.75rem;">System</small>
            <a href="#" class="nav-link">
                <i class="fas fa-users-cog"></i> Administrator
            </a>
            <a href="/logout" class="nav-link text-danger mt-3">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content">
        <?= $this->renderSection('content'); ?>

        <footer class="mt-5 text-muted small">
            &copy; <?= date('Y'); ?> PT. Pesona Adi Batara CMS System v1.0
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts'); ?>
</body>

</html>