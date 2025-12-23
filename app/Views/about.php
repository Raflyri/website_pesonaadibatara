<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="py-5 bg-primary text-white position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200') center/cover;"></div>
    <div class="container position-relative z-2 py-5 text-center">
        <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Tentang Kami</h1>
        <p class="lead animate__animated animate__fadeInUp">Mengenal lebih dekat PT. Pesona Adi Batara</p>
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
                <h6 class="text-primary fw-bold text-uppercase mb-2">Sejarah Kami</h6>
                <h2 class="fw-bold mb-4"><?= $history['title_id']; ?></h2>
                <div class="text-muted">
                    <?= nl2br($history['content_id']); ?>
                </div>

                <div class="mt-4 p-3 bg-light rounded border-start border-4 border-primary">
                    <p class="mb-0 small fw-bold text-dark">
                        <i class="fas fa-certificate me-2 text-primary"></i>
                        Disahkan Kemenkumham: C2-4.195 HT.01.01 TH 97
                    </p>
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
                        <h3 class="fw-bold mb-3">Visi</h3>
                        <p class="lead text-muted fst-italic">
                            "<?= $vision['content_id']; ?>"
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
                            <h3 class="fw-bold">Misi</h3>
                        </div>
                        <ul class="list-unstyled">
                            <?php
                            $misiList = explode("\n", $mission['content_id']);
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

<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase">Organisasi</h6>
            <h2 class="fw-bold">Struktur Dewan Direksi</h2>
        </div>

        <div class="org-tree-wrapper overflow-auto pb-5" data-aos="zoom-in">
            <div class="org-tree">

                <?php
                // Fungsi Rekursif untuk Menggambar HTML (UL > LI)
                function renderTreeHTML($items)
                {
                    echo "<ul>";
                    foreach ($items as $item) {
                        echo "<li>";

                        // Gambar Kotak Member
                        $foto = $item['image'] ? base_url('uploads/teams/' . $item['image']) : 'https://ui-avatars.com/api/?name=' . urlencode($item['fullname']);

                        // Cek Level untuk styling (Level 1 & 2 besar, sisanya kecil)
                        $cardClass = ($item['level'] > 2) ? 'member-card small-card' : 'member-card';

                        echo '
                        <div class="' . $cardClass . '">
                            <div class="img-box"><img src="' . $foto . '"></div>
                            <div class="info-box">
                                <h5>' . $item['fullname'] . '</h5>
                                <span>' . $item['position_id'] . '</span>
                            </div>
                        </div>';

                        // Jika punya anak buah, panggil fungsi ini lagi (Looping ke dalam)
                        if (!empty($item['children'])) {
                            renderTreeHTML($item['children']);
                        }

                        echo "</li>";
                    }
                    echo "</ul>";
                }

                // PANGGIL FUNGSI PERTAMA KALI
                if (!empty($teams)) {
                    renderTreeHTML($teams);
                }
                ?>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>