<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Tidak Ditemukan - Pesona Adi Batara</title>
    
    <link href="/assets/css/style.css" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #000428, #004e92); /* Warna Khas Pesona Trans */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }
        .error-container {
            text-align: center;
            position: relative;
            z-index: 2;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 800;
            line-height: 1;
            opacity: 0.3;
            letter-spacing: -5px;
        }
        .error-icon {
            font-size: 5rem;
            color: #ffc107; /* Warna Kuning Warning */
            margin-bottom: 20px;
        }
        .btn-home {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-home:hover {
            background-color: #e0a800;
            transform: translateY(-2px);
        }
        /* Background abstract decoration */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            z-index: 1;
        }
    </style>
</head>
<body>

    <div class="circle" style="width: 500px; height: 500px; top: -100px; left: -100px;"></div>
    <div class="circle" style="width: 300px; height: 300px; bottom: -50px; right: -50px;"></div>

    <div class="container error-container">
        <div class="animate__animated animate__bounceIn">
            <i class="fas fa-map-marked-alt error-icon"></i>
        </div>

        <h1 class="display-4 fw-bold mb-3">Opps! Jalur Salah</h1>
        <p class="lead mb-4 opacity-75">
            Sepertinya halaman yang Anda cari sedang "off-road" atau tidak tersedia.<br>
            Mari kembali ke rute utama.
        </p>

        <a href="/" class="btn btn-home btn-lg rounded-pill px-5 shadow-lg">
            <i class="fas fa-home me-2"></i> Kembali ke Beranda
        </a>

        <div class="mt-5 error-code animate__animated animate__fadeInUp">
            404
        </div>
        
        <p class="small text-muted mt-3">
            PT. Pesona Adi Batara &copy; <?= date('Y'); ?>
        </p>
    </div>

</body>
</html>