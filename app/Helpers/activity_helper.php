<?php

if (!function_exists('log_activity')) {
    /**
     * Catat aktivitas ke tabel activity_logs
     *
     * @param string $action      Nama aksi, misal: "Login", "Tambah Berita"
     * @param string $description Detail tambahan, misal: judul berita atau IP
     * @param string $type        Warna dot: info | success | warning | danger
     */
    function log_activity(string $action, string $description = '', string $type = 'info'): void
    {
        $logModel = new \App\Models\ActivityLogModel();
        $logModel->log($action, $description, $type);
    }
}
