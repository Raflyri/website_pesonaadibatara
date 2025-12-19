<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: #f8f9fa; }
        .card-header { background: #135ef9; color: white; }
        .translate-btn { cursor: pointer; transition: 0.3s; }
        .translate-btn:hover { transform: scale(1.05); }
    </style>
</head>
<body class="p-4">

<div class="container">
    <div class="card shadow-lg border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-newspaper me-2"></i> Tulis Berita Baru</h5>
            <a href="/admin/news" class="btn btn-sm btn-light text-primary fw-bold">Kembali</a>
        </div>
        <div class="card-body p-4">
            
            <form action="/admin/news/store" method="post">
                <?= csrf_field(); ?>

                <div class="mb-4">
                    <label class="fw-bold">Kategori Berita</label>
                    <select name="category" class="form-select w-25">
                        <option value="Corporate">Corporate</option>
                        <option value="CSR">CSR (Sosial)</option>
                        <option value="Training">Training & Development</option>
                    </select>
                </div>

                <hr>

                <div class="row g-4">
                    
                    <div class="col-md-6 border-end">
                        <h6 class="text-muted text-uppercase fw-bold mb-3"><img src="https://flagcdn.com/16x12/id.png"> Bahasa Indonesia (Utama)</h6>
                        
                        <div class="mb-3">
                            <label>Judul Berita</label>
                            <input type="text" name="title_id" id="source_title" class="form-control form-control-lg fw-bold" placeholder="Contoh: Perusahaan Meraih Penghargaan..." required>
                        </div>

                        <div class="mb-3">
                            <label>Isi Konten</label>
                            <textarea name="content_id" id="source_content" class="form-control" rows="8" placeholder="Tulis isi berita lengkap di sini..." required></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 bg-light rounded-3 p-3">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="text-muted text-uppercase fw-bold"><img src="https://flagcdn.com/16x12/gb.png"> English Translation</h6>
                            
                            <button type="button" onclick="autoTranslate()" class="btn btn-sm btn-warning fw-bold text-dark translate-btn shadow-sm">
                                <i class="fas fa-magic me-2"></i> Auto Translate
                            </button>
                        </div>
                        
                        <div class="mb-3">
                            <label>News Title (Auto-fill)</label>
                            <input type="text" name="title_en" id="target_title" class="form-control form-control-lg bg-white" placeholder="Waiting for translation...">
                        </div>

                        <div class="mb-3">
                            <label>Content (Auto-fill)</label>
                            <textarea name="content_en" id="target_content" class="form-control bg-white" rows="8" placeholder="Click 'Auto Translate' button..."></textarea>
                        </div>
                    </div>

                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow">
                        <i class="fas fa-paper-plane me-2"></i> Tayangkan Berita
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    async function autoTranslate() {
        // 1. Ambil teks dari kolom Indonesia
        const textTitle = document.getElementById('source_title').value;
        const textContent = document.getElementById('source_content').value;

        // Validasi kosong
        if(!textTitle || !textContent) {
            alert("Mohon isi Judul dan Konten Bahasa Indonesia dulu ya!");
            return;
        }

        // Ubah tombol jadi 'Loading...' biar user tau proses jalan
        const btn = document.querySelector('.translate-btn');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Translating...';
        btn.disabled = true;

        try {
            // 2. Tembak ke API Penerjemah Gratis (MyMemory API)
            // Catatan IT Consultant: Ini API gratisan, ada limit harian. Kalau mau produksi besar, nanti kita ganti ke Google Cloud API.
            
            // Translate Judul
            const resTitle = await fetch(`https://api.mymemory.translated.net/get?q=${encodeURIComponent(textTitle)}&langpair=id|en`);
            const jsonTitle = await resTitle.json();
            
            // Translate Konten
            // Tips: API gratisan punya limit karakter per request (500 chars).
            // Jadi sementara kita translate potongan awal saja untuk demo.
            const resContent = await fetch(`https://api.mymemory.translated.net/get?q=${encodeURIComponent(textContent.substring(0, 450))}&langpair=id|en`);
            const jsonContent = await resContent.json();

            // 3. Isi kolom Inggris otomatis
            document.getElementById('target_title').value = jsonTitle.responseData.translatedText;
            document.getElementById('target_content').value = jsonContent.responseData.translatedText;

            // Beritahu sukses
            // alert("Penerjemahan selesai! Silakan review hasilnya.");

        } catch (error) {
            console.error(error);
            alert("Maaf, gagal menghubungi layanan penerjemah. Cek koneksi internet.");
        } finally {
            // Balikin tombol seperti semula
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    }
</script>

</body>
</html>