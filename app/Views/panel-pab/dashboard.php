<?= $this->extend('panel-pab/layout/template'); ?>

<?= $this->section('styles'); ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="dashboard-hero animate__animated animate__fadeIn">
    <div class="hero-content d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <span class="badge bg-white text-primary bg-opacity-10 border border-white border-opacity-25 mb-2 px-3 py-2 rounded-pill">
                <i class="fas fa-building me-2"></i> Corporate Dashboard
            </span>
            <h2 class="fw-bold mb-1">Halo, <?= $user_name; ?>! 👋</h2>
            <p class="mb-0 opacity-75">Selamat datang di panel kontrol terintegrasi PT. Pesona Adi Batara.</p>
        </div>
        <div class="text-end d-none d-md-block">
            <h5 class="m-0 fw-bold" id="realtimeClock">...</h5>
            <small class="opacity-75"><i class="fas fa-calendar-alt me-1"></i> <?= date('d F Y'); ?></small>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    
    <div class="col-md-3">
        <div class="stat-card-modern stat-border-primary">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="fw-bold mb-0 text-dark"><?= $stats['news']; ?></h2>
                    <p class="text-muted small fw-bold text-uppercase mt-1">Total Artikel</p>
                </div>
                <div class="icon-box-modern bg-light-primary">
                    <i class="far fa-newspaper"></i>
                </div>
            </div>
            <div class="mt-3">
                <a href="/panel-pab/news" class="text-decoration-none small text-primary fw-bold">
                    Kelola Berita <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card-modern stat-border-success">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="fw-bold mb-0 text-dark"><?= $stats['services']; ?></h2>
                    <p class="text-muted small fw-bold text-uppercase mt-1">Layanan Aktif</p>
                </div>
                <div class="icon-box-modern bg-light-success">
                    <i class="fas fa-briefcase"></i>
                </div>
            </div>
            <div class="mt-3">
                <a href="/panel-pab/services/transportasi" class="text-decoration-none small text-success fw-bold">
                    Cek Layanan <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card-modern stat-border-info">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="fw-bold mb-0 text-dark"><?= $stats['users']; ?></h2>
                    <p class="text-muted small fw-bold text-uppercase mt-1">Administrator</p>
                </div>
                <div class="icon-box-modern bg-light-info">
                    <i class="fas fa-users-cog"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="text-muted small">Tim Pengelola</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card-modern stat-border-warning">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="fw-bold mb-0 text-dark" id="visitorCount"><?= $stats['visitors'] ?? 0; ?></h2>
                    <p class="text-muted small fw-bold text-uppercase mt-1">Pengunjung</p>
                </div>
                <div class="icon-box-modern bg-light-warning">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
            <div class="mt-3">
                <small class="text-warning fw-bold"><i class="fas fa-circle fa-xs me-1"></i> Realtime View</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    
    <div class="col-lg-8">
        
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <a href="/panel-pab/news/create" class="btn-quick shadow-sm">
                    <i class="fas fa-pen-nib fa-2x text-primary mb-2"></i>
                    <span class="fw-bold">Tulis Berita</span>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/panel-pab/team" class="btn-quick shadow-sm">
                    <i class="fas fa-user-tie fa-2x text-success mb-2"></i>
                    <span class="fw-bold">Data Pegawai</span>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/panel-pab/about-editor" class="btn-quick shadow-sm">
                    <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                    <span class="fw-bold">Update Compro</span>
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h6 class="fw-bold m-0"><i class="fas fa-history me-2 text-primary"></i>Aktivitas Terakhir</h6>
            </div>
            <div class="card-body p-4">
                <div class="timeline-activity">
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <p class="fw-bold mb-1 text-dark">Update Berita Corporate</p>
                        <p class="text-muted small mb-2">User: Admin Utama &bull; <i class="far fa-clock ms-1"></i> 2 menit lalu</p>
                        <span class="badge bg-success bg-opacity-10 text-success">Published</span>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot" style="background-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.2);"></div>
                        <p class="fw-bold mb-1 text-dark">Login System</p>
                        <p class="text-muted small mb-2">User: Rafly Rizky &bull; <i class="far fa-clock ms-1"></i> 1 jam lalu</p>
                        <span class="badge bg-light text-dark border">IP: 192.168.1.10</span>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot" style="background-color: #10b981; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);"></div>
                        <p class="fw-bold mb-1 text-dark">Backup Database Otomatis</p>
                        <p class="text-muted small mb-0">System &bull; <i class="far fa-clock ms-1"></i> 5 jam lalu</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card server-card border-0 shadow-lg h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-white bg-opacity-10 p-2 rounded-3 me-3">
                        <i class="fas fa-server fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Server Status</h6>
                        <small class="text-white-50">Monitoring Realtime</small>
                    </div>
                    <div class="ms-auto">
                        <span class="badge bg-success rounded-pill animate__animated animate__pulse animate__infinite">Online</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <small class="fw-bold">Database Storage</small>
                        <small><?= $server['db_size']; ?> MB</small>
                    </div>
                    <div class="progress progress-thin">
                        <div class="progress-bar bg-primary progress-bar-glow" role="progressbar" style="width: <?= $server['db_pct']; ?>%"></div>
                    </div>
                    <small class="text-white-50 mt-1 d-block" style="font-size: 0.75rem;">Limit: 500MB</small>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <small class="fw-bold">CPU Load</small>
                        <small><?= $server['cpu_pct']; ?>%</small>
                    </div>
                    <div class="progress progress-thin">
                        <div class="progress-bar <?= ($server['cpu_pct'] > 80) ? 'bg-danger' : 'bg-success'; ?> progress-bar-glow" role="progressbar" style="width: <?= $server['cpu_pct']; ?>%"></div>
                    </div>
                </div>

                <hr class="border-white border-opacity-10 my-4">

                <div class="row g-3 text-center">
                    <div class="col-6">
                        <div class="p-2 rounded bg-white bg-opacity-10">
                            <small class="d-block text-white-50 mb-1">PHP Version</small>
                            <span class="fw-bold"><?= $system_info['php_version']; ?></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 rounded bg-white bg-opacity-10">
                            <small class="d-block text-white-50 mb-1">CI Version</small>
                            <span class="fw-bold">v<?= $system_info['ci_version']; ?></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Script Jam Realtime
    function updateClock() {
        const now = new Date();
        const timeOptions = { hour: '2-digit', minute: '2-digit', hour12: false };
        document.getElementById('realtimeClock').innerText = now.toLocaleTimeString('id-ID', timeOptions) + ' WIB';
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Script Update Visitor Realtime
    function fetchVisitorCount() {
        fetch('/panel-pab/api/visitor-count')
            .then(response => response.json())
            .then(data => {
                const element = document.getElementById('visitorCount');
                if (element) element.innerText = data.count;
            })
            .catch(e => console.log('Visitor fetch error'));
    }
    setInterval(fetchVisitorCount, 10000);
</script>

<?= $this->endSection(); ?>