<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel'; ?> | PAB CMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css'); ?>">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        /* Fix Summernote Style */
        .note-editor .dropdown-toggle::after {
            all: unset;
        }

        .note-editor .note-dropdown-menu {
            box-sizing: content-box;
        }

        .note-editor .note-modal-footer {
            box-sizing: content-box;
        }
    </style>
</head>

<body>

    <div class="sidebar d-flex flex-column shadow-sm">

        <div class="sidebar-header d-flex align-items-center justify-content-center py-3 border-bottom">
            <img src="<?= base_url('assets/img/logo-pab.png'); ?>" alt="Logo" height="40">
        </div>

        <div class="sidebar-menu p-3">
            <small class="text-uppercase text-muted fw-bold mb-2 d-block ls-1 section-title">Main Menu</small>

            <a href="/admin/dashboard" class="nav-link <?= (current_url(true)->getSegment(2) == 'dashboard') ? 'active' : ''; ?>" title="Dashboard">
                <i class="fas fa-th-large"></i> <span class="sidebar-text">Dashboard</span>
            </a>

            <a href="/admin/home-editor" class="nav-link <?= (current_url(true)->getSegment(2) == 'home-editor') ? 'active' : ''; ?>" title="Kelola Beranda">
                <i class="fas fa-home"></i> <span class="sidebar-text">Kelola Beranda</span>
            </a>

            <a href="/admin/about-editor" class="nav-link <?= (current_url(true)->getSegment(2) == 'about-editor') ? 'active' : ''; ?>" title="Tentang Kami">
                <i class="fas fa-building"></i> <span class="sidebar-text">Tentang Kami</span>
            </a>

            <a href="/admin/partners" class="nav-link <?= (url_is('admin/partners*')) ? 'active' : ''; ?>" title="Partner & Klien">
                <i class="fas fa-handshake"></i> <span class="sidebar-text">Partner & Klien</span>
            </a>

            <a href="/admin/news" class="nav-link <?= (current_url(true)->getSegment(2) == 'news') ? 'active' : ''; ?>" title="Kelola Berita">
                <i class="fas fa-newspaper"></i> <span class="sidebar-text">Kelola Berita</span>
            </a>

            <a href="/admin/team" class="nav-link <?= (current_url(true)->getSegment(2) == 'team') ? 'active' : ''; ?>" title="Direksi & Tim">
                <i class="fas fa-users"></i> <span class="sidebar-text">Direksi & Tim</span>
            </a>

            <a href="/admin/contact-editor" class="nav-link <?= (current_url(true)->getSegment(2) == 'contact-editor') ? 'active' : ''; ?>" title="Kontak & Pesan">
                <i class="fas fa-envelope-open-text"></i> <span class="sidebar-text">Kontak & Pesan</span>
            </a>

            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menuLayanan" role="button" aria-expanded="<?= (current_url(true)->getSegment(2) == 'services') ? 'true' : 'false'; ?>" title="Layanan Bisnis">
                <div class="d-flex align-items-center">
                    <i class="fas fa-concierge-bell"></i> <span class="sidebar-text">Layanan Bisnis</span>
                </div>
                <i class="fas fa-chevron-down small sidebar-text" style="font-size: 0.7rem;"></i>
            </a>
            <div class="collapse <?= (current_url(true)->getSegment(2) == 'services') ? 'show' : ''; ?>" id="menuLayanan">
                <div class="ms-3 border-start ps-2 my-1">
                    <a href="/admin/services/transportasi" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'transportasi') ? 'text-primary fw-bold bg-light' : ''; ?>">
                        <span class="sidebar-text">Transportasi</span>
                    </a>
                    <a href="/admin/services/kesehatan" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'kesehatan') ? 'text-primary fw-bold bg-light' : ''; ?>">
                        <span class="sidebar-text">Kesehatan</span>
                    </a>
                    <a href="/admin/services/jasa" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'jasa') ? 'text-primary fw-bold bg-light' : ''; ?>">
                        <span class="sidebar-text">Jasa & Pengadaan</span>
                    </a>
                    <a href="/admin/services/investasi" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'investasi') ? 'text-primary fw-bold bg-light' : ''; ?>">
                        <span class="sidebar-text">Investasi</span>
                    </a>
                </div>
            </div>

            <a href="/admin/banner" class="nav-link <?= (current_url(true)->getSegment(2) == 'banner') ? 'active' : ''; ?>" title="Banner Slider">
                <i class="fas fa-images"></i> <span class="sidebar-text">Banner Slider</span>
            </a>

            <hr class="my-3">

            <small class="text-uppercase text-muted fw-bold mb-2 d-block section-title" style="font-size: 0.75rem;">System</small>

            <?php if (session()->get('role') == 'superadmin'): ?>
                <a href="/admin/users" class="nav-link <?= (current_url(true)->getSegment(2) == 'users') ? 'active' : ''; ?>" title="Administrator">
                    <i class="fas fa-users-cog"></i> <span class="sidebar-text">Administrator</span>
                </a>
                <a href="/admin/backup-db" class="nav-link text-warning" title="Backup Database">
                    <i class="fas fa-database"></i> <span class="sidebar-text">Backup Database</span>
                </a>
            <?php endif; ?>

            <a href="/logout" class="nav-link text-danger mt-1" title="Logout">
                <i class="fas fa-sign-out-alt"></i> <span class="sidebar-text">Logout</span>
            </a>
        </div>
    </div>
    <nav class="topbar shadow-sm">

        <div class="d-flex align-items-center gap-3 ms-auto">

            <button class="btn btn-ghost rounded-circle" id="darkModeToggle" title="Ganti Tema">
                <i class="fas fa-moon text-muted"></i>
            </button>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark p-2 rounded hover-bg-light" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="text-end me-2 d-none d-md-block">
                        <strong class="d-block small"><?= esc(session()->get('name')); ?></strong>
                        <span class="text-muted small" style="font-size: 0.7rem;"><?= ucfirst(session()->get('role')); ?></span>
                    </div>
                    <?php $avatar = session()->get('avatar') ? '/uploads/avatars/' . session()->get('avatar') : 'https://ui-avatars.com/api/?name=' . urlencode(session()->get('name')) . '&background=random'; ?>
                    <img src="<?= $avatar; ?>" alt="user" width="35" height="35" class="rounded-circle border object-fit-cover">
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="/admin/profile"><i class="fas fa-user-circle me-2"></i> Profil Saya</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-danger" href="/logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-content d-flex flex-column">

        <div class="flex-grow-1">
            <?= $this->renderSection('content'); ?>
        </div>

        <footer class="mt-5 pt-4 border-top text-muted small text-center">
            &copy; 2025 PT. Pesona Adi Batara CMS System v2.0
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            // Summernote Init
            $('.summernote').summernote({
                placeholder: 'Tulis konten artikel di sini...',
                tabsize: 2,
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        const body = document.body;
        const darkModeToggle = document.getElementById('darkModeToggle');
        const icon = darkModeToggle.querySelector('i');

        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }
        darkModeToggle.addEventListener('click', () => {
            if (document.documentElement.getAttribute('data-theme') === 'dark') {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        });
    </script>
    <?= $this->renderSection('scripts'); ?>
</body>

</html>