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
        <!--<span class="badge rounded-pill bg-warning text-dark mb-3 px-3 py-2 animate__animated animate__fadeInDown">
            <i class="fas fa-briefcase me-2"></i>WE ARE HIRING
        </span>-->
        
        <h1 class="fw-bold display-4 mb-3 animate__animated animate__fadeInDown animate__delay-1s">
            <?= lang('Frontend.career.hero_title') ?>
        </h1>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead opacity-75 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <?= lang('Frontend.career.hero_desc') ?>
                </p>
            </div>
        </div>

        <!--<a href="#lowongan" class="btn btn-outline-light rounded-pill px-4 py-2 animate__animated animate__fadeInUp animate__delay-2s">
            Lihat Lowongan <i class="fas fa-arrow-down ms-2"></i>
        </a>-->
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 text-center mb-4 mb-md-0">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/hiring-staff-illustration-download-in-svg-png-gif-file-formats--recruitment-job-vacancy-business-join-our-team-pack-illustrations-4438787.png" 
                     class="img-fluid" style="max-height: 300px;" alt="Career Illustration">
            </div>
            <div class="col-md-6 text-center text-md-start">
                <div class="p-4 border rounded-4 shadow-sm bg-light position-relative overflow-hidden">
                    <div class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill">Information</div>
                    <h3 class="fw-bold mb-3"><?= lang('Frontend.career.no_vacancy_title') ?></h3>
                    <p class="text-muted mb-4">
                        <?= lang('Frontend.career.no_vacancy_desc') ?>
                    </p>
                    <p class="text-muted">
                        <?= lang('Frontend.career.check_back') ?>
                    </p>
                    
                    <hr>
                    
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <a href="/" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fas fa-home me-2"></i> <?= lang('Frontend.global.back_to_home') ?>
                        </a>
                        <a href="https://linkedin.com" target="_blank" class="btn btn-primary rounded-pill px-4">
                            <i class="fab fa-linkedin me-2"></i> <?= lang('Frontend.career.follow_linkedin') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>