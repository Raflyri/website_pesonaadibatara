<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark">Dashboard</h2>
        <p class="text-muted mb-0">Selamat datang kembali, <span class="text-primary fw-bold"><?= $user_name; ?></span>!</p>
    </div>
    <div>
        <a href="/admin/news/create" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-2"></i> Tulis Berita Baru
        </a>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1 small fw-bold text-uppercase">Total Berita</p>
                    <h3 class="fw-bold mb-0"><?= $stats['news']; ?></h3>
                </div>
                <div class="icon-box bg-blue-soft">
                    <i class="far fa-newspaper"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1 small fw-bold text-uppercase">Layanan Aktif</p>
                    <h3 class="fw-bold mb-0"><?= $stats['services']; ?></h3>
                </div>
                <div class="icon-box bg-green-soft">
                    <i class="fas fa-concierge-bell"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1 small fw-bold text-uppercase">Administrator</p>
                    <h3 class="fw-bold mb-0"><?= $stats['users']; ?></h3>
                </div>
                <div class="icon-box bg-purple-soft">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1 small fw-bold text-uppercase">Pengunjung Hari Ini</p>
                    <h3 class="fw-bold mb-0" id="visitorCount">
                        <?= $stats['visitors'] ?? 0; ?>
                    </h3>
                    <small class="text-success" style="font-size: 0.7rem;">
                        <i class="fas fa-circle fa-xs me-1"></i> Realtime
                    </small>
                </div>
                <div class="icon-box bg-orange-soft">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">Aktivitas Terakhir</h6>
                <a href="#" class="text-decoration-none small">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Aktivitas</th>
                                <th>User</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold d-block text-dark">Update Berita Corporate</span>
                                    <small class="text-muted">Peningkatan Kualitas Armada...</small>
                                </td>
                                <td>Admin Utama</td>
                                <td>2 Menit lalu</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success px-3">Success</span></td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold d-block text-dark">Login System</span>
                                    <small class="text-muted">IP: 192.168.1.10</small>
                                </td>
                                <td>Rafly Rizky</td>
                                <td>1 Jam lalu</td>
                                <td><span class="badge bg-info bg-opacity-10 text-info px-3">Log</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0"><i class="fas fa-server me-2 text-primary"></i> Server Monitor</h6>
                    <small class="text-muted fw-bold" style="font-size: 0.75rem;" id="realtimeClock">
                        <i class="fas fa-spinner fa-spin"></i> Memuat waktu...
                    </small>
                </div>

                <ul class="nav nav-pills nav-fill p-1 rounded-3 bg-light" id="systemTabs" role="tablist" style="border: 1px solid var(--border-color);">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active small py-1 fw-bold rounded-3" id="status-tab" data-bs-toggle="tab" data-bs-target="#status-pane" type="button" role="tab">
                            <i class="fas fa-chart-pie me-1"></i> Status
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link small py-1 fw-bold rounded-3" id="info-tab" data-bs-toggle="tab" data-bs-target="#info-pane" type="button" role="tab">
                            <i class="fas fa-info-circle me-1"></i> Info
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4">
                <div class="tab-content" id="systemTabsContent">

                    <div class="tab-pane fade show active" id="status-pane" role="tabpanel">

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted fw-bold">Database Storage</small>
                                <small class="fw-bold text-primary"><?= $server['db_size']; ?> MB</small>
                            </div>
                            <div class="progress rounded-pill" style="height: 10px; background-color: var(--hover-bg);">
                                <div class="progress-bar bg-primary rounded-pill" role="progressbar"
                                    style="width: <?= $server['db_pct']; ?>%"
                                    aria-valuenow="<?= $server['db_pct']; ?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <small class="text-muted" style="font-size: 0.7rem;">Used: <?= $server['db_pct']; ?>%</small>
                                <small class="text-muted" style="font-size: 0.7rem;">Limit: 500MB</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted fw-bold">CPU Load</small>
                                <small class="fw-bold <?= ($server['cpu_pct'] > 80) ? 'text-danger' : 'text-success'; ?>">
                                    <?= $server['cpu_pct']; ?>%
                                </small>
                            </div>
                            <div class="progress rounded-pill" style="height: 10px; background-color: var(--hover-bg);">
                                <div class="progress-bar <?= ($server['cpu_pct'] > 80) ? 'bg-danger' : 'bg-success'; ?> rounded-pill" role="progressbar"
                                    style="width: <?= $server['cpu_pct']; ?>%"
                                    aria-valuenow="<?= $server['cpu_pct']; ?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                                Performance: <?= ($server['cpu_pct'] > 80) ? 'Heavy Load' : 'Optimal'; ?>
                            </small>
                        </div>

                        <i class="fas fa-chart-area position-absolute text-muted opacity-10" style="bottom: 20px; right: 20px; font-size: 5rem; opacity: 0.05;"></i>
                    </div>

                    <div class="tab-pane fade" id="info-pane" role="tabpanel">
                        <table class="table table-borderless table-sm mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0">Framework</td>
                                    <td class="fw-bold text-end">CodeIgniter <?= $system_info['ci_version']; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">PHP Version</td>
                                    <td class="fw-bold text-end"><?= $system_info['php_version']; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Database</td>
                                    <td class="fw-bold text-end">MySQL <?= $system_info['db_version']; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">IP Address</td>
                                    <td class="fw-bold text-end"><?= $system_info['server_ip']; ?></td>
                                </tr>
                                <tr class="border-top">
                                    <td class="text-muted ps-0 pt-2">Environment</td>
                                    <td class="text-end pt-2">
                                        <span class="badge bg-<?= ($system_info['environment'] == 'production') ? 'success' : 'warning'; ?> text-white rounded-pill px-3">
                                            <?= strtoupper($system_info['environment']); ?>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();

        // 1. Format Tanggal (Contoh: Rabu, 24 Desember 2025)
        const dateOptions = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const dateString = now.toLocaleDateString('id-ID', dateOptions);

        // 2. Format Jam (Contoh: 14:30:45)
        const timeOptions = {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false // Format 24 jam
        };
        const timeString = now.toLocaleTimeString('id-ID', timeOptions);

        // 3. Gabungkan dan Masukkan ke Element HTML
        // Hasil: Rabu, 24 Desember 2025 • 14:30:45 WIB
        const element = document.getElementById('realtimeClock');
        if (element) {
            element.innerHTML = `${dateString} <span class="mx-1">•</span> ${timeString} WIB`;
        }
    }

    // Jalankan fungsi updateClock setiap 1000ms (1 detik)
    setInterval(updateClock, 1000);

    // Jalankan sekali saat pertama load biar gak nunggu 1 detik
    updateClock();

    function fetchVisitorCount() {
        // Panggil endpoint API yang kita buat di Controller
        fetch('/admin/api/visitor-count')
            .then(response => response.json())
            .then(data => {
                const element = document.getElementById('visitorCount');
                if (element) {
                    // Animasi angka berubah (optional, biar keren)
                    element.innerText = data.count;
                }
            })
            .catch(error => console.error('Gagal mengambil data pengunjung:', error));
    }

    // Jalankan setiap 10 detik (jangan terlalu cepat biar server ga berat)
    setInterval(fetchVisitorCount, 10000);
</script>

<?= $this->endSection(); ?>