<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="position-relative text-white overflow-hidden" style="padding-top: 160px; padding-bottom: 80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background-image: url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=1470&auto=format&fit=crop');
                background-size: cover;
                background-position: center;
                z-index: 1;">
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background: linear-gradient(to right, rgba(0,0,0,0.85), rgba(0,50,100,0.6));
                z-index: 2;">
    </div>

    <div class="container position-relative" style="z-index: 3;">
        <nav aria-label="breadcrumb" class="mb-4 animate__animated animate__fadeInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="/career" class="text-white-50 text-decoration-none">Karir</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page"><?= $vacancy['job_title']; ?></li>
            </ol>
        </nav>

        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill animate__animated animate__fadeInLeft">
                    <?= $vacancy['department']; ?>
                </span>
                <h1 class="fw-bold display-5 mb-3 animate__animated animate__fadeInLeft animate__delay-1s">
                    <?= $vacancy['job_title']; ?>
                </h1>
                <div class="d-flex flex-wrap gap-4 text-white-50 animate__animated animate__fadeInUp animate__delay-1s">
                    <span><i class="fas fa-briefcase me-2"></i> <?= $vacancy['employment_type']; ?></span>
                    <span><i class="fas fa-map-marker-alt me-2"></i> <?= $vacancy['work_location_type']; ?> (<?= $vacancy['office_location']; ?>)</span>
                    <span><i class="far fa-calendar-alt me-2"></i> Batas: <?= $vacancy['application_deadline'] ? date('d M Y', strtotime($vacancy['application_deadline'])) : 'Selalu Terbuka'; ?></span>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <div class="p-4 bg-white bg-opacity-10 rounded-4 backdrop-blur animate__animated animate__fadeInRight animate__delay-1s">
                    <p class="small text-white-50 mb-1">Estimasi Gaji</p>
                    <h3 class="fw-bold text-white mb-0">
                        <?php if ($vacancy['hide_salary']): ?>
                            Disclose on Interview
                        <?php else: ?>
                            Rp <?= number_format($vacancy['min_salary'], 0, ',', '.'); ?> - <?= number_format($vacancy['max_salary'], 0, ',', '.'); ?>
                        <?php endif; ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="job-content mb-5">
                    <h4 class="fw-bold border-start border-primary border-4 ps-3 mb-4">Deskripsi Pekerjaan</h4>
                    <div class="text-muted lh-lg">
                        <?= $vacancy['job_description']; ?>
                    </div>
                </div>

                <div class="job-content mb-5">
                    <h4 class="fw-bold border-start border-primary border-4 ps-3 mb-4">Kualifikasi / Persyaratan</h4>
                    <div class="text-muted lh-lg">
                        <?= $vacancy['job_requirement']; ?>
                    </div>
                </div>

                <?php if ($vacancy['benefits']): ?>
                <div class="job-content mb-5">
                    <h4 class="fw-bold border-start border-primary border-4 ps-3 mb-4">Benefit & Fasilitas</h4>
                    <div class="text-muted lh-lg">
                        <?= nl2br($vacancy['benefits']); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <div class="sticky-top" style="top: 120px;">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="fw-bold mb-4">Tertarik dengan Posisi Ini?</h5>
                        <p class="text-muted small mb-4">
                            Klik tombol di bawah ini untuk memulai proses pendaftaran Anda. Pastikan dokumen Anda sudah siap.
                        </p>

                        <?php if ($vacancy['application_link']): ?>
                            <a href="<?= $vacancy['application_link']; ?>" target="_blank" class="btn btn-primary btn-lg rounded-pill w-100 mb-3">
                                Lamar Sekarang <i class="fas fa-external-link-alt ms-2 small"></i>
                            </a>
                        <?php else: ?>
                            <?php
                                $settingModel = new \App\Models\SiteSettingModel();
                                $hrEmail = $settingModel->getVal('company_email') ?? 'hrd@pesonaadibatara.co.id';
                            ?>
                            <a href="mailto:<?= $hrEmail; ?>?subject=Lamaran Kerja: <?= $vacancy['job_title']; ?>" class="btn btn-primary btn-lg rounded-pill w-100 mb-3">
                                Lamar via Email <i class="fas fa-envelope ms-2 small"></i>
                            </a>
                        <?php endif; ?>

                        <div class="text-center">
                            <p class="small text-muted mb-0">Atau bagikan info ini:</p>
                            <div class="d-flex justify-content-center gap-3 mt-2">
                                <a href="https://wa.me/?text=Lowongan%20Kerja:%20<?= urlencode($vacancy['job_title']); ?>%20di%20PT.%20Pesona%20Adi%20Batara.%20Cek%20di:%20<?= current_url(); ?>" target="_blank" class="text-success"><i class="fab fa-whatsapp fa-lg"></i></a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= current_url(); ?>" target="_blank" class="text-primary"><i class="fab fa-linkedin fa-lg"></i></a>
                                <a href="https://twitter.com/intent/tweet?text=Lowongan%20Kerja:%20<?= urlencode($vacancy['job_title']); ?>&url=<?= current_url(); ?>" target="_blank" class="text-info"><i class="fab fa-twitter fa-lg"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 bg-light rounded-4 p-4">
                        <h6 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Informasi Tambahan</h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-muted">ID Lowongan:</span>
                                <span class="fw-bold">#VAC-<?= str_pad($vacancy['id'], 4, '0', STR_PAD_LEFT); ?></span>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-muted">Diposting:</span>
                                <span><?= date('d M Y', strtotime($vacancy['created_at'])); ?></span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span class="text-muted">Kategori:</span>
                                <span><?= $vacancy['department']; ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<style>
    .backdrop-blur {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
    .job-content ul {
        padding-left: 1.5rem;
    }
    .job-content p {
        margin-bottom: 1rem;
    }
</style>
<?= $this->endSection(); ?>
