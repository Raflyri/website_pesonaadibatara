<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login System | Pesona Adi Batara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f1f5f9; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 100%; max-width: 400px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-pab { background-color: #135ef9; color: white; }
        .btn-pab:hover { background-color: #0d4cdb; color: white; }
    </style>
</head>
<body>
    <div class="card login-card p-4">
        <div class="card-body">
            <h4 class="text-center fw-bold mb-4" style="color: #135ef9;">PESONA ADI BATARA</h4>
            <p class="text-center text-muted mb-4">Silakan login untuk mengelola website</p>
            
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="/auth/process" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-pab w-100 py-2">Masuk Dashboard</button>
            </form>
        </div>
    </div>
</body>
</html>