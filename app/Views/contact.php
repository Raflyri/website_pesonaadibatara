<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="position-relative text-white text-center overflow-hidden" style="padding-top: 160px; padding-bottom: 100px;">

    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background-image: url('<?= !empty($intro['media_url']) ? base_url('uploads/pages/' . $intro['media_url']) : 'https://images.unsplash.com/photo-1423666639041-f140481eb936?auto=format&fit=crop&w=1200' ?>'); 
                background-size: cover; 
                background-position: center; 
                z-index: 1;">
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,50,100,0.9)); 
                z-index: 2;">
    </div>

    <div class="container position-relative" style="z-index: 3;">
        <span class="badge rounded-pill bg-danger text-white mb-3 px-3 py-2 animate__animated animate__fadeInDown">
            <i class="fas fa-headset me-2"></i><?= lang('Frontend.contact.badge_support') ?>
        </span>

        <?php
        $currentLang = service('request')->getLocale();
        $introTitle = ($currentLang == 'en' && !empty($intro['title_en'])) ? $intro['title_en'] : ($intro['title_id'] ?? lang('Frontend.contact.title'));
        $introContent = ($currentLang == 'en' && !empty($intro['content_en'])) ? $intro['content_en'] : ($intro['content_id'] ?? lang('Frontend.contact.subtitle'));
        ?>

        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown animate__delay-1s">
            <?= $introTitle; ?>
        </h1>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead opacity-75 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <?= $introContent; ?>
                </p>
            </div>
        </div>

    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-4">

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success rounded-3 mb-5 shadow-sm">
                <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger rounded-3 mb-5 shadow-sm">
                <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <h3 class="fw-bold mb-4 text-primary"><?= lang('Frontend.contact.address_label'); ?></h3>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="bg-light text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-map-marker-alt fa-lg"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="fw-bold mb-1"><?= lang('Frontend.contact.address_label'); ?></h6>
                        <p class="text-muted mb-0"><?= nl2br($address); ?></p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="bg-light text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="fw-bold mb-1"><?= lang('Frontend.contact.phone_label'); ?></h6>
                        <p class="text-muted mb-0"><?= $whatsapp; ?> / <?= $phone; ?></p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="bg-light text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-envelope fa-lg"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="fw-bold mb-1"><?= lang('Frontend.contact.email_label'); ?></h6>
                        <p class="text-muted mb-0"><?= $email; ?></p>
                    </div>
                </div>

                <div class="card bg-primary text-white border-0 rounded-4 mt-5 overflow-hidden">
                    <div class="card-body p-4 position-relative">
                        <h5 class="fw-bold position-relative z-2"><?= lang('Frontend.contact.quick_response') ?></h5>
                        <p class="position-relative z-2 mb-3"><?= lang('Frontend.contact.quick_response_desc') ?></p>
                        <a href="https://wa.me/<?= $whatsapp; ?>" target="_blank" class="btn btn-light text-primary fw-bold rounded-pill px-4 position-relative z-2">
                            <i class="fab fa-whatsapp me-2"></i> <?= lang('Frontend.contact.chat_whatsapp') ?>
                        </a>
                        <i class="fab fa-whatsapp position-absolute text-white" style="font-size: 10rem; opacity: 0.1; right: -20px; bottom: -30px;"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-5">
                        <h3 class="fw-bold mb-4"><?= lang('Frontend.contact.form_title'); ?></h3>
                        <form action="/contact/send" method="post">
                            <?= csrf_field(); ?>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><?= lang('Frontend.contact.name'); ?></label>
                                    <input type="text" name="name" class="form-control bg-light border-0 py-3" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><?= lang('Frontend.contact.phone'); ?></label>
                                    <input type="text" name="phone" class="form-control bg-light border-0 py-3">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold"><?= lang('Frontend.contact.email'); ?></label>
                                    <input type="email" name="email" class="form-control bg-light border-0 py-3" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold"><?= lang('Frontend.contact.subject'); ?></label>
                                    <select name="subject" class="form-select bg-light border-0 py-3">
                                        <option value="General Inquiry"><?= lang('Frontend.contact.opt_general') ?></option>
                                        <option value="Partnership"><?= lang('Frontend.contact.opt_partnership') ?></option>
                                        <option value="Service Request"><?= lang('Frontend.contact.opt_service') ?></option>
                                        <option value="Recruitment"><?= lang('Frontend.contact.opt_career') ?></option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold"><?= lang('Frontend.contact.message'); ?></label>
                                    <textarea name="message" class="form-control bg-light border-0" rows="5" required></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-pab-primary w-100 rounded-pill py-3 fw-bold shadow">
                                        <?= lang('Frontend.contact.btn_submit'); ?> <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="position-relative">
    <div class="w-100" style="height: 450px; background: #eee;">
        <iframe src="<?= $maps; ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<?= $this->endSection(); ?>