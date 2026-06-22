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
                    <svg class="mb-4" style="max-height: 220px; width: 100%;" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="Belum ada lowongan">
                        <!-- Background shape -->
                        <ellipse cx="200" cy="260" rx="140" ry="18" fill="#E8EEF6"/>
                        <!-- Desk -->
                        <rect x="60" y="195" width="280" height="14" rx="7" fill="#CBD5E1"/>
                        <rect x="90" y="209" width="12" height="50" rx="6" fill="#94A3B8"/>
                        <rect x="298" y="209" width="12" height="50" rx="6" fill="#94A3B8"/>
                        <!-- Monitor -->
                        <rect x="130" y="115" width="140" height="82" rx="8" fill="#1E3A5F"/>
                        <rect x="136" y="121" width="128" height="64" rx="5" fill="#EFF6FF"/>
                        <!-- Screen content: magnifier -->
                        <circle cx="195" cy="148" r="18" stroke="#3B82F6" stroke-width="4" fill="none"/>
                        <line x1="208" y1="161" x2="220" y2="173" stroke="#3B82F6" stroke-width="4" stroke-linecap="round"/>
                        <!-- Question mark inside magnifier -->
                        <text x="191" y="154" font-family="Arial" font-size="16" font-weight="bold" fill="#3B82F6">?</text>
                        <!-- Monitor stand -->
                        <rect x="193" y="197" width="14" height="14" rx="2" fill="#94A3B8"/>
                        <rect x="175" y="208" width="50" height="8" rx="4" fill="#94A3B8"/>
                        <!-- Paper stack left -->
                        <rect x="70" y="170" width="50" height="8" rx="3" fill="#BFDBFE"/>
                        <rect x="72" y="163" width="46" height="8" rx="3" fill="#DBEAFE"/>
                        <rect x="74" y="156" width="42" height="8" rx="3" fill="#EFF6FF"/>
                        <!-- Small X marks on papers -->
                        <line x1="82" y1="161" x2="86" y2="165" stroke="#94A3B8" stroke-width="1.5" stroke-linecap="round"/>
                        <line x1="86" y1="161" x2="82" y2="165" stroke="#94A3B8" stroke-width="1.5" stroke-linecap="round"/>
                        <!-- Paper stack right -->
                        <rect x="280" y="170" width="50" height="8" rx="3" fill="#BFDBFE"/>
                        <rect x="282" y="163" width="46" height="8" rx="3" fill="#DBEAFE"/>
                        <rect x="284" y="156" width="42" height="8" rx="3" fill="#EFF6FF"/>
                        <!-- Small person silhouette (crossed out) -->
                        <circle cx="300" cy="95" r="14" fill="#DBEAFE" stroke="#93C5FD" stroke-width="2"/>
                        <line x1="290" y1="85" x2="310" y2="105" stroke="#EF4444" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="310" y1="85" x2="290" y2="105" stroke="#EF4444" stroke-width="2.5" stroke-linecap="round"/>
                        <!-- Stars / sparkles -->
                        <circle cx="100" cy="90" r="4" fill="#BFDBFE"/>
                        <circle cx="310" cy="140" r="3" fill="#DBEAFE"/>
                        <circle cx="85" cy="130" r="2.5" fill="#93C5FD"/>
                    </svg>
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
