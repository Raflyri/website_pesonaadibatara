<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="position-relative text-white text-center overflow-hidden" style="padding-top: 160px; padding-bottom: 100px;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1470&auto=format&fit=crop'); 
                background-size: cover; 
                background-position: center; 
                z-index: 1;">
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: linear-gradient(to bottom, rgba(0,0,0,0.7), rgba(0,50,100,0.8)); 
                z-index: 2;">
    </div>

    <div class="container position-relative" style="z-index: 3;">
        <h1 class="fw-bold display-4 mb-3 animate__animated animate__fadeInDown">
            <?= lang('Frontend.career.hero_title') ?>
        </h1>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead opacity-75 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <?= lang('Frontend.career.hero_desc') ?>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <!-- Filter Section -->
        <div class="card shadow-sm border-0 rounded-4 mb-5 p-3 animate__animated animate__fadeIn">
            <form action="/career" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Department</label>
                    <select name="department" class="form-select border-0 bg-light rounded-3">
                        <option value="">Semua Departemen</option>
                        <?php foreach($departments as $dept): ?>
                            <?php if($dept['department']): ?>
                                <option value="<?= $dept['department'] ?>" <?= $filters['department'] == $dept['department'] ? 'selected' : '' ?>><?= $dept['department'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Tipe Kerja</label>
                    <select name="employment_type" class="form-select border-0 bg-light rounded-3">
                        <option value="">Semua Tipe</option>
                        <?php foreach($employment_types as $type): ?>
                            <?php if($type['employment_type']): ?>
                                <option value="<?= $type['employment_type'] ?>" <?= $filters['employment_type'] == $type['employment_type'] ? 'selected' : '' ?>><?= $type['employment_type'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Model Kerja</label>
                    <select name="location_type" class="form-select border-0 bg-light rounded-3">
                        <option value="">Semua Lokasi</option>
                        <?php foreach($location_types as $loc): ?>
                            <?php if($loc['work_location_type']): ?>
                                <option value="<?= $loc['work_location_type'] ?>" <?= $filters['location_type'] == $loc['work_location_type'] ? 'selected' : '' ?>><?= $loc['work_location_type'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-grid gap-2 d-md-flex">
                        <button type="submit" class="btn btn-primary rounded-3 px-4 w-100">
                            <i class="fas fa-search me-2"></i> Cari
                        </button>
                        <a href="/career" class="btn btn-outline-secondary rounded-3 px-3">
                            <i class="fas fa-undo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <?php if (!empty($vacancies)) : ?>
            <div class="row g-4">
                <?php foreach ($vacancies as $job) : ?>
                    <div class="col-md-6 col-lg-4 animate__animated animate__fadeInUp">
                        <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift transition-all">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-blue-light text-primary rounded-pill px-3 py-2 small fw-bold">
                                        <?= $job['department']; ?>
                                    </span>
                                    <span class="text-muted small">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <?= $job['application_deadline'] ? date('d M Y', strtotime($job['application_deadline'])) : 'Always Open'; ?>
                                    </span>
                                </div>
                                <h4 class="fw-bold mb-3 h5"><?= $job['job_title']; ?></h4>
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                    <span class="small text-muted me-3"><i class="fas fa-briefcase me-1"></i> <?= $job['employment_type']; ?></span>
                                    <span class="small text-muted"><i class="fas fa-map-marker-alt me-1"></i> <?= $job['work_location_type']; ?></span>
                                </div>
                                <hr class="opacity-10 mb-4">
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <div class="text-primary fw-bold">
                                        <?php if ($job['hide_salary']): ?>
                                            <span class="small text-muted fw-normal">Gaji:</span> Disclose on Interview
                                        <?php else: ?>
                                            <span class="small text-muted fw-normal">Gaji up to:</span>
                                            <?= number_format($job['max_salary'], 0, ',', '.'); ?>
                                        <?php endif; ?>
                                    </div>
                                    <a href="/career/<?= $job['slug']; ?>" class="btn btn-outline-primary rounded-pill px-4 btn-sm">
                                        Detail <i class="fas fa-arrow-right ms-1 small"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="row justify-content-center align-items-center py-5">
                <div class="col-md-6 text-center">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/hiring-staff-illustration-download-in-svg-png-gif-file-formats--recruitment-job-vacancy-business-join-our-team-pack-illustrations-4438787.png"
                         class="img-fluid mb-4" style="max-height: 250px;" alt="No Vacancy">
                    <h3 class="fw-bold"><?= lang('Frontend.career.no_vacancy_title') ?></h3>
                    <p class="text-muted mb-4">
                        <?= lang('Frontend.career.no_vacancy_desc') ?>
                    </p>
                    <a href="https://linkedin.com" target="_blank" class="btn btn-primary rounded-pill px-4">
                        <i class="fab fa-linkedin me-2"></i> <?= lang('Frontend.career.follow_linkedin') ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection(); ?>
