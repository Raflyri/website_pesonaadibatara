<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrator | PT. Pesona Adi Batara</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
</head>

<body>

    <div class="login-wrapper">
        
        <div class="login-visual">
            <div class="visual-overlay"></div>
            <div class="visual-content">
                <h1 class="display-5 fw-bold mb-2">Corporate Portal</h1>
                <p class="lead opacity-75 mb-4">Sistem Manajemen Terintegrasi PT. Pesona Adi Batara.</p>
                
                <p class="small text-uppercase fw-bold letter-spacing-1 mb-3" style="letter-spacing: 2px; opacity: 0.8;">4 Pilar Bisnis Utama:</p>
                
                <div class="d-flex flex-wrap gap-2">
                    <div class="core-business-badge">
                        <i class="fas fa-bus-alt"></i> Bisnis Transportasi
                    </div>
                    <div class="core-business-badge">
                        <i class="fas fa-heartbeat"></i> Bisnis Kesehatan
                    </div>
                    <div class="core-business-badge">
                        <i class="fas fa-concierge-bell"></i> Bisnis Jasa
                    </div>
                    <div class="core-business-badge">
                        <i class="fas fa-chart-line"></i> Bisnis Investasi
                    </div>
                </div>

                <div class="mt-5 pt-3 border-top border-light border-opacity-25">
                    <small class="opacity-75">&copy; <?= date('Y'); ?> PT. Pesona Adi Batara. All rights reserved.</small>
                </div>
            </div>
        </div>

        <div class="login-form-container">
            <div class="form-wrapper">
                
                <div class="d-flex align-items-center mb-4">
                    <div class="logo-box me-3">
                        <i class="fas fa-building"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold m-0 text-dark">Selamat Datang</h4>
                        <p class="text-muted small m-0">Silakan login ke akun Anda</p>
                    </div>
                </div>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger border-0 shadow-sm rounded-3 fade show mb-4 py-2 small" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="/auth/process" method="post">
                    <?= csrf_field(); ?>
                    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                        <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label text-muted small" style="padding-top: 2px;" for="rememberMe">Ingat Saya</label>
                        </div>
                        <a href="#" class="text-decoration-none small fw-bold" style="color: var(--primary-color);">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn btn-login w-100 shadow-sm">
                        Masuk Dashboard <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </form>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>