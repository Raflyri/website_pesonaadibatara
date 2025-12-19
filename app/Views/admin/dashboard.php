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
                    <h3 class="fw-bold mb-0">1,240</h3>
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
        <div class="card border-0 shadow-sm rounded-4 bg-primary text-white h-100">
            <div class="card-body p-4 position-relative overflow-hidden">
                <h5 class="fw-bold mb-4">System Status</h5>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <small>Database Storage</small>
                        <small>45%</small>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-white" style="width: 45%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <small>CPU Usage</small>
                        <small>12%</small>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-white" style="width: 12%"></div>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-top border-white border-opacity-25">
                    <small class="opacity-75">Server Time: <?= date('d M Y H:i'); ?></small>
                </div>

                <i class="fas fa-server position-absolute" style="font-size: 10rem; opacity: 0.1; right: -20px; bottom: -20px;"></i>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>