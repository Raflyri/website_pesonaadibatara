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
        /* Sedikit perbaikan style agar editor tidak terlalu rapat */
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

    <style>
        /* Sedikit style tambahan agar dropdown di sidebar rapi */
        .dropdown-toggle::after {
            vertical-align: middle;
        }

        .sidebar-menu .nav-link {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: 0.3s;
        }

        .sidebar-menu .nav-link:hover {
            background: #e9ecef;
        }

        .sidebar-menu .nav-link.active {
            background: #0d6efd;
            color: white;
        }

        .sidebar-menu .nav-link.active i {
            color: white;
        }

        .sidebar-menu i {
            width: 25px;
            text-align: center;
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <div class="sidebar d-flex flex-column p-3 bg-white shadow-sm" style="width: 280px; height: 100vh; position: fixed; overflow-y: auto;">

        <div class="sidebar-header border-bottom pb-3 mb-3">
            <div class="d-flex align-items-center mb-3">
                <img src="<?= base_url('assets/img/logo-pab.png'); ?>" alt="Logo" height="50" class="me-2">
                <!--span class="fw-bold fs-5 text-dark">PAB Dashboard</span-->
            </div>


            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark p-2 rounded hover-bg-light" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php $avatar = session()->get('avatar') ? '/uploads/avatars/' . session()->get('avatar') : 'https://ui-avatars.com/api/?name=' . urlencode(session()->get('name')) . '&background=random'; ?>
                    <img src="<?= $avatar; ?>" alt="mdo" width="32" height="32" class="rounded-circle me-2 object-fit-cover">

                    <div class="small">
                        <strong class="d-block"><?= esc(session()->get('name')); ?></strong>
                        <span class="text-muted" style="font-size: 0.75rem;"><?= ucfirst(session()->get('role')); ?></span>
                    </div>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="/admin/profile"><i class="fas fa-user-circle me-2"></i> Profil Saya</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-danger" href="/logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>

        <div class="sidebar-menu">
            <small class="text-uppercase text-muted fw-bold mb-2 d-block" style="font-size: 0.75rem;">Main Menu</small>

            <a href="/admin/dashboard" class="nav-link <?= (current_url(true)->getSegment(2) == 'dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <a href="/admin/home-editor" class="nav-link <?= (current_url(true)->getSegment(2) == 'home-editor') ? 'active' : ''; ?>">
                <i class="fas fa-home"></i> Kelola Beranda
            </a>

            <a href="/admin/about-editor" class="nav-link <?= (current_url(true)->getSegment(2) == 'about-editor') ? 'active' : ''; ?>">
                <i class="fas fa-building"></i> Tentang Kami
            </a>

            <a href="/admin/partners" class="nav-link <?= (url_is('admin/partners*')) ? 'active' : ''; ?>">
                <i class="fas fa-handshake"></i>Partner & Klien
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

            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menuLayanan" role="button" aria-expanded="<?= (current_url(true)->getSegment(2) == 'services') ? 'true' : 'false'; ?>">
                <span><i class="fas fa-concierge-bell"></i> Layanan Bisnis</span>
                <i class="fas fa-chevron-down small" style="font-size: 0.7rem;"></i>
            </a>
            <div class="collapse <?= (current_url(true)->getSegment(2) == 'services') ? 'show' : ''; ?>" id="menuLayanan">
                <div class="ms-3 border-start ps-2 my-1">
                    <a href="/admin/services/transportasi" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'transportasi') ? 'text-primary fw-bold bg-light' : ''; ?>">Transportasi</a>
                    <a href="/admin/services/kesehatan" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'kesehatan') ? 'text-primary fw-bold bg-light' : ''; ?>">Kesehatan</a>
                    <a href="/admin/services/jasa" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'jasa') ? 'text-primary fw-bold bg-light' : ''; ?>">Jasa & Pengadaan</a>
                    <a href="/admin/services/investasi" class="nav-link py-1 small <?= (current_url(true)->getSegment(3) == 'investasi') ? 'text-primary fw-bold bg-light' : ''; ?>">Investasi</a>
                </div>
            </div>

            <a href="/admin/banner" class="nav-link <?= (current_url(true)->getSegment(2) == 'banner') ? 'active' : ''; ?>">
                <i class="fas fa-images"></i> Banner Slider
            </a>

            <hr class="my-3">

            <small class="text-uppercase text-muted fw-bold mb-2 d-block" style="font-size: 0.75rem;">System</small>

            <?php if (session()->get('role') == 'superadmin'): ?>
                <a href="/admin/users" class="nav-link <?= (current_url(true)->getSegment(2) == 'users') ? 'active' : ''; ?>">
                    <i class="fas fa-users-cog"></i> Administrator
                </a>
                <a href="/admin/backup-db" class="nav-link text-warning">
                    <i class="fas fa-database"></i> Backup Database
                </a>
            <?php endif; ?>

            <a href="/logout" class="nav-link text-danger mt-1">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content d-flex flex-column" style="margin-left: 280px; padding: 20px; min-height: 100vh;">

        <div class="flex-grow-1">
            <?= $this->renderSection('content'); ?>
        </div>

        <footer class="mt-5 pt-4 border-top text-muted small text-center">
            &copy; 2025 PT. Pesona Adi Batara CMS System v1.0
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            // Targetkan semua textarea dengan class 'summernote'
            $('.summernote').summernote({
                placeholder: 'Tulis konten artikel di sini...',
                tabsize: 2,
                height: 400, // Tinggi editor
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
    </script>
    <?= $this->renderSection('scripts'); ?>
</body>

</html>