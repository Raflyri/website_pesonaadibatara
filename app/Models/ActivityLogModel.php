<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table         = 'activity_logs';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'user_id', 'user_name', 'action', 'description', 'type', 'ip_address', 'created_at'
    ];

    protected $useTimestamps = false; // kita set manual created_at

    /**
     * Catat aktivitas baru
     */
    public function log(string $action, string $description = '', string $type = 'info'): void
    {
        try {
            $this->insert([
                'user_id'     => session()->get('id'),
                'user_name'   => session()->get('name') ?? 'System',
                'action'      => $action,
                'description' => $description ?: null,
                'type'        => $type,
                'ip_address'  => service('request')->getIPAddress(),
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            // Jangan crash aplikasi hanya karena logging gagal
            log_message('error', 'ActivityLog gagal: ' . $e->getMessage());
        }
    }

    /**
     * Ambil N aktivitas terbaru
     */
    public function getRecent(int $limit = 10): array
    {
        return $this->orderBy('created_at', 'DESC')->limit($limit)->findAll();
    }

    /**
     * Format waktu relatif (2 menit lalu, 1 jam lalu, dst)
     */
    public static function timeAgo(string $datetime): string
    {
        $diff = time() - strtotime($datetime);

        if ($diff < 60)        return $diff . ' detik lalu';
        if ($diff < 3600)      return floor($diff / 60) . ' menit lalu';
        if ($diff < 86400)     return floor($diff / 3600) . ' jam lalu';
        if ($diff < 604800)    return floor($diff / 86400) . ' hari lalu';

        return date('d M Y', strtotime($datetime));
    }
}
