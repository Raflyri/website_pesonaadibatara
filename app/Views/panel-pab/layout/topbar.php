<nav class="topbar">
    <div class="d-flex flex-column">
        <div class="d-flex align-items-center gap-2">
            <h6 class="fw-bold m-0 text-dark">Halo, <?= esc(explode(' ', session()->get('name') ?? 'Admin')[0]); ?>! 👋</h6>
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 rounded-pill d-none d-lg-inline-block" style="font-size: 0.65rem; padding: 4px 8px;">
                Corporate Dashboard
            </span>
        </div>
        <small class="text-muted d-none d-md-block" style="font-size: 0.7rem;">PT. Pesona Adi Batara</small>
    </div>

    <div class="mx-auto d-none d-lg-flex align-items-center bg-white bg-opacity-50 px-3 py-1 rounded-pill border border-white shadow-sm clock-widget">
        <i class="far fa-clock text-primary me-2"></i>
        <span id="realtimeClock" class="fw-bold text-dark" style="font-variant-numeric: tabular-nums; letter-spacing: 0.5px;">...</span>
        <span class="mx-2 text-muted">|</span>
        <small class="text-muted"><?= date('d M Y'); ?></small>
    </div>

    <div class="d-flex align-items-center gap-3 ms-auto ms-lg-0">
        <button class="btn btn-ghost rounded-circle" id="darkModeToggle" title="Ganti Tema">
            <i class="fas fa-moon text-muted"></i>
        </button>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark p-2 rounded hover-bg-light" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="text-end me-2 d-none d-md-block">
                    <strong class="d-block small"><?= esc(session()->get('name')); ?></strong>
                    <span class="text-muted small" style="font-size: 0.7rem;"><?= esc(ucfirst(session()->get('role'))); ?></span>
                </div>
                <?php $avatar = session()->get('avatar') ? '/uploads/avatars/' . session()->get('avatar') : 'https://ui-avatars.com/api/?name=' . urlencode(session()->get('name')) . '&background=random'; ?>
                <img src="<?= $avatar; ?>" alt="user" width="35" height="35" class="rounded-circle border object-fit-cover">
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="/panel-pab/profile"><i class="fas fa-user-circle me-2"></i> Profil Saya</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="/logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>