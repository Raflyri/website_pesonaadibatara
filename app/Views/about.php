<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/about.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<section class="position-relative text-white text-center overflow-hidden" style="padding-top: 160px; padding-bottom: 100px;">

    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200'); 
                background-size: cover; 
                background-position: center; 
                z-index: 1;">
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,50,100,0.9)); 
                z-index: 2;">
    </div>

    <div class="container position-relative" style="z-index: 3;">
        <span class="badge rounded-pill bg-info text-dark mb-3 px-3 py-2 animate__animated animate__fadeInDown">
            <i class="fas fa-building me-2"></i><?= lang('Frontend.about.badge_profile') ?>
        </span>

        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown animate__delay-1s">
            <?= lang('Frontend.about.title'); ?>
        </h1>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead opacity-75 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <?= lang('Frontend.about.subtitle') ?>
                </p>
            </div>
        </div>

        <div class="animate__animated animate__fadeInUp animate__delay-2s mt-2">
            <i class="fas fa-chevron-down fa-2x opacity-50"></i>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <?php $img = !empty($history['media_url']) ? base_url('uploads/about/' . $history['media_url']) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800'; ?>
                <img src="<?= $img; ?>" class="img-fluid rounded-4 shadow-lg" alt="Sejarah PAB">
            </div>
            <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                <?php
                $currentLang = service('request')->getLocale();
                $historyTitle = ($currentLang == 'en' && !empty($history['title_en'])) ? $history['title_en'] : $history['title_id'];
                $historyContent = ($currentLang == 'en' && !empty($history['content_en'])) ? $history['content_en'] : $history['content_id'];
                ?>
                <h6 class="text-primary fw-bold text-uppercase mb-2"><?= lang('Frontend.about.history_title'); ?></h6>
                <h2 class="fw-bold mb-4"><?= $historyTitle; ?></h2>
                <div class="text-muted">
                    <?= nl2br($historyContent); ?>
                </div>

                <?php
                $downloadUrl = '#';
                $labelButton = lang('Frontend.about.download_profile');
                $isDisabled  = false;

                if (!empty($compro_link)) {
                    $downloadUrl = $compro_link;
                } elseif (!empty($compro_file) && file_exists('uploads/doc/' . $compro_file)) {
                    $downloadUrl = base_url('uploads/doc/' . $compro_file);
                } else {
                    $isDisabled = true;
                    $labelButton = lang('Frontend.about.compro_unavailable');
                }
                ?>

                <div class="mt-4">
                    <a href="<?= $downloadUrl; ?>"
                        target="_blank"
                        class="btn btn-primary shadow-sm py-2 px-4 rounded-pill <?= $isDisabled ? 'disabled' : ''; ?>">
                        <i class="fas fa-file-pdf me-2"></i> <?= $labelButton; ?>
                    </a>

                    <div class="mt-2 text-muted small">
                        <i class="fas fa-info-circle me-1"></i> <?= lang('Frontend.about.format_pdf') ?>
                        <?php if (!empty($compro_link)) : ?> (Via Google Drive) <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-5 text-center">
                        <div class="icon-circle bg-blue-light mb-4 mx-auto text-primary">
                            <i class="fas fa-eye fa-2x"></i>
                        </div>
                        <?php
                        $visionContent = ($currentLang == 'en' && !empty($vision['content_en'])) ? $vision['content_en'] : $vision['content_id'];
                        ?>
                        <h3 class="fw-bold mb-3"><?= lang('Frontend.about.vision_title'); ?></h3>
                        <p class="lead text-muted fst-italic">
                            "<?= $visionContent; ?>"
                        </p>
                    </div>
                    <div class="bg-primary h-1 w-100"></div>
                </div>
            </div>

            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="icon-circle bg-green-light mb-4 mx-auto text-success">
                                <i class="fas fa-bullseye fa-2x"></i>
                            </div>
                            <h3 class="fw-bold"><?= lang('Frontend.about.mission_title'); ?></h3>
                        </div>
                        <ul class="list-unstyled">
                            <?php
                            $missionContent = ($currentLang == 'en' && !empty($mission['content_en'])) ? $mission['content_en'] : $mission['content_id'];
                            $misiList = explode("\n", $missionContent);
                            foreach ($misiList as $m):
                                if (trim($m) == "") continue;
                            ?>
                                <li class="d-flex mb-3 text-muted">
                                    <i class="fas fa-check-circle text-success mt-1 me-3"></i>
                                    <span><?= $m; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="bg-success h-1 w-100"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 org-section">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="org-section-badge">
                <i class="fas fa-sitemap me-2"></i><?= lang('Frontend.about.organization') ?>
            </span>
            <h2 class="org-section-title mt-3"><?= lang('Frontend.about.board_structure') ?></h2>
            <div class="org-section-divider mx-auto"></div>
        </div>

        <?php $currentLangTeam = service('request')->getLocale(); ?>

        <?php if (!empty($teams)) : ?>
            <div class="team-grid" data-aos="fade-up">
                <?php foreach ($teams as $member) : ?>
                    <?php
                    // Cek file fisiknya, bukan cuma kolom DB — kalau file hilang
                    // (mis. DB di-dump dari server tapi folder uploads belum ikut)
                    // jatuhkan ke avatar inisial supaya tidak jadi broken image.
                    $hasPhoto = !empty($member['image']) && is_file(FCPATH . 'uploads/teams/' . $member['image']);
                    $foto = $hasPhoto
                        ? base_url('uploads/teams/' . $member['image'])
                        : 'https://ui-avatars.com/api/?size=256&background=135ef9&color=ffffff&bold=true&name=' . urlencode($member['name']);

                    $positionKey = 'position_' . $currentLangTeam;
                    $position = !empty($member[$positionKey]) ? $member[$positionKey] : $member['position_id'];

                    $bioKey = 'bio_' . $currentLangTeam;
                    $bio = !empty($member[$bioKey]) ? $member[$bioKey] : ($member['bio_id'] ?? '');
                    ?>
                    <div class="team-card">
                        <div class="team-card-circle">
                            <div class="team-card-circle-inner">
                                <img src="<?= esc($foto, 'attr'); ?>" alt="<?= esc($member['name']); ?>">
                            </div>
                            <button type="button" class="team-card-arrow"
                                data-bs-toggle="modal" data-bs-target="#teamProfileModal"
                                data-name="<?= esc($member['name'], 'attr'); ?>"
                                data-position="<?= esc($position, 'attr'); ?>"
                                data-photo="<?= esc($foto, 'attr'); ?>"
                                data-placeholder="<?= $hasPhoto ? '0' : '1'; ?>"
                                data-bio="<?= esc($bio, 'attr'); ?>"
                                aria-label="<?= esc(lang('Frontend.about.profile_detail') . ': ' . $member['name'], 'attr'); ?>">
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="team-card-info">
                            <span class="team-card-dot"></span>
                            <div class="team-card-text">
                                <h5><?= esc($member['name']); ?></h5>
                                <span><?= esc($position); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Popup detail profil anggota tim (satu modal, diisi ulang via data-* tombol panah) -->
<div class="modal fade" id="teamProfileModal" tabindex="-1" aria-labelledby="teamProfileModalName" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered team-modal-dialog">
        <div class="modal-content team-modal-content">
            <button type="button" class="team-modal-close" data-bs-dismiss="modal" aria-label="<?= esc(lang('Frontend.about.close'), 'attr'); ?>">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>

            <div class="team-modal-photo" id="teamProfileModalPhotoBox">
                <img src="" alt="" id="teamProfileModalPhoto">
            </div>

            <div class="team-modal-body">
                <span class="team-modal-dot"></span>
                <h4 id="teamProfileModalName"></h4>
                <p class="team-modal-position" id="teamProfileModalPosition"></p>
                <div class="team-modal-bio" id="teamProfileModalBio"></div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        var modal = document.getElementById('teamProfileModal');
        if (!modal) return;

        var photo = document.getElementById('teamProfileModalPhoto');
        var photoBox = document.getElementById('teamProfileModalPhotoBox');
        var name = document.getElementById('teamProfileModalName');
        var position = document.getElementById('teamProfileModalPosition');
        var bioBox = document.getElementById('teamProfileModalBio');

        modal.addEventListener('show.bs.modal', function(event) {
            var trigger = event.relatedTarget;
            if (!trigger) return;

            var memberName = trigger.getAttribute('data-name') || '';

            photo.src = trigger.getAttribute('data-photo') || '';
            photo.alt = memberName;

            // Avatar inisial di-'contain' agar tidak ter-zoom di kolom portrait.
            photoBox.classList.toggle('is-placeholder', trigger.getAttribute('data-placeholder') === '1');

            name.textContent = memberName;
            position.textContent = trigger.getAttribute('data-position') || '';

            // Isi bio sebagai teks (bukan HTML) supaya input admin tidak bisa
            // menyuntikkan markup; baris kosong dipecah jadi paragraf terpisah.
            bioBox.textContent = '';
            var bio = (trigger.getAttribute('data-bio') || '').trim();

            bioBox.hidden = bio === '';
            if (bio === '') return;

            bio.split(/\n\s*\n/).forEach(function(paragraph) {
                if (paragraph.trim() === '') return;
                var p = document.createElement('p');
                p.textContent = paragraph.trim();
                bioBox.appendChild(p);
            });
        });
    })();
</script>

<?= $this->endSection(); ?>