<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="py-5 bg-light text-center">
    <div class="container py-5">
        <h1 class="fw-bold display-5 animate__animated animate__fadeInDown">Karir Bersama Kami</h1>
        <p class="lead text-muted mb-0 animate__animated animate__fadeInUp">Bergabunglah menjadi bagian dari pertumbuhan PT. Pesona Adi Batara</p>
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
                    <h3 class="fw-bold mb-3">Belum Ada Lowongan Tersedia</h3>
                    <p class="text-muted mb-4">
                        Terima kasih atas antusiasme Anda untuk bergabung dengan PT. Pesona Adi Batara. 
                        Saat ini kami belum membuka posisi lowongan pekerjaan baru.
                    </p>
                    <p class="text-muted">
                        Silakan cek halaman ini secara berkala atau ikuti media sosial kami untuk mendapatkan informasi terbaru mengenai peluang karir di masa depan.
                    </p>
                    
                    <hr>
                    
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <a href="/" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fas fa-home me-2"></i> Kembali ke Beranda
                        </a>
                        <a href="https://linkedin.com" target="_blank" class="btn btn-primary rounded-pill px-4">
                            <i class="fab fa-linkedin me-2"></i> Ikuti LinkedIn Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>