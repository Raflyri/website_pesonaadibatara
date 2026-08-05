<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicePageModel extends Model
{
    protected $table            = 'service_pages';
    protected $primaryKey       = 'category';
    protected $allowedFields    = [
        'category',
        'page_title',
        'page_description',
        'hero_image',
        'nav_label',
        'nav_label_en',
        'nav_desc',
        'nav_desc_en',
        'home_desc',
        'home_desc_en',
        'icon',
        'color',
        'sort_order',
        'is_active',
    ];
    protected $useTimestamps    = true;
    protected $updatedField     = 'updated_at';

    /**
     * Tabel ini tidak punya kolom `created_at`. Dikosongkan supaya CI4 tidak
     * mencoba mengisinya saat insert (dulu tidak ketahuan karena model ini
     * hanya dipakai meng-update 4 kategori bawaan, tidak pernah insert).
     */
    protected $createdField     = '';

    /**
     * Primary key-nya berupa slug (bukan auto-increment), jadi CI tidak bisa
     * menebak insert vs update sendiri saat save().
     */
    protected $useAutoIncrement = false;

    /**
     * Warna yang boleh dipakai menu -> pasangan class background & teks
     * yang sudah tersedia di style.css.
     */
    public const COLOR_MAP = [
        'blue'   => ['bg' => 'bg-blue-light',   'text' => 'text-primary'],
        'green'  => ['bg' => 'bg-green-light',  'text' => 'text-success'],
        'orange' => ['bg' => 'bg-orange-light', 'text' => 'text-warning'],
        'purple' => ['bg' => 'bg-purple-light', 'text' => 'text-info'],
    ];

    /**
     * Kategori layanan yang tampil di menu publik, terurut.
     */
    public function getMenu(): array
    {
        return $this->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('category', 'ASC')
            ->findAll();
    }

    /**
     * Semua kategori untuk keperluan admin (termasuk yang non-aktif).
     */
    public function getAllOrdered(): array
    {
        return $this->orderBy('sort_order', 'ASC')
            ->orderBy('category', 'ASC')
            ->findAll();
    }

    /**
     * Label menu sesuai locale, dengan fallback ke label Indonesia lalu slug.
     */
    public static function label(array $row, string $locale): string
    {
        if ($locale === 'en' && !empty($row['nav_label_en'])) {
            return $row['nav_label_en'];
        }

        return $row['nav_label'] ?: ucfirst($row['category']);
    }

    /**
     * Deskripsi singkat menu sesuai locale (boleh kosong).
     */
    public static function desc(array $row, string $locale): string
    {
        if ($locale === 'en' && !empty($row['nav_desc_en'])) {
            return $row['nav_desc_en'];
        }

        return $row['nav_desc'] ?? '';
    }

    /**
     * Deskripsi kartu pilar bisnis di homepage, jatuh ke nav_desc bila kosong.
     */
    public static function homeDesc(array $row, string $locale): string
    {
        if ($locale === 'en' && !empty($row['home_desc_en'])) {
            return $row['home_desc_en'];
        }

        if (!empty($row['home_desc'])) {
            return $row['home_desc'];
        }

        return self::desc($row, $locale);
    }

    /**
     * Pasangan class warna, jatuh ke biru kalau nilainya tidak dikenal.
     */
    public static function colorClasses(?string $color): array
    {
        return self::COLOR_MAP[$color] ?? self::COLOR_MAP['blue'];
    }
}
