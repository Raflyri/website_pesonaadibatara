<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Menjadikan `service_pages` sebagai master kategori layanan bisnis,
 * supaya menu layanan tidak lagi hardcode dan bisa dikelola dari CMS.
 */
class AddMenuFieldsToServicePages extends Migration
{
    public function up()
    {
        $this->forge->addColumn('service_pages', [
            'nav_label' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'category',
            ],
            'nav_label_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'nav_label',
            ],
            'nav_desc' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'after'      => 'nav_label_en',
            ],
            'nav_desc_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'after'      => 'nav_desc',
            ],
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => true,
                'default'    => 'fas fa-concierge-bell',
                'after'      => 'nav_desc_en',
            ],
            'color' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'default'    => 'blue',
                'after'      => 'icon',
            ],
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'after'      => 'color',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'after'      => 'sort_order',
            ],
        ]);

        // Isi ulang 4 kategori bawaan dengan label/ikon/warna yang persis
        // sama seperti versi hardcode, supaya tampilan tidak berubah.
        $seed = [
            'transportasi' => ['Transportasi', 'Transportation', 'Luxury Car & Operasional', 'Luxury Car & Operational', 'fas fa-car-side', 'blue', 1],
            'kesehatan'    => ['Kesehatan', 'Healthcare', 'Batara Health Care', 'Batara Health Care', 'fas fa-heartbeat', 'green', 2],
            'jasa'         => ['Jasa', 'Services', 'Fasade & EO', 'Facade & EO', 'fas fa-concierge-bell', 'orange', 3],
            'investasi'    => ['Investasi', 'Investment', 'KSO & F&B', 'KSO & F&B', 'fas fa-chart-line', 'purple', 4],
        ];

        foreach ($seed as $category => $row) {
            $this->db->table('service_pages')
                ->where('category', $category)
                ->update([
                    'nav_label'    => $row[0],
                    'nav_label_en' => $row[1],
                    'nav_desc'     => $row[2],
                    'nav_desc_en'  => $row[3],
                    'icon'         => $row[4],
                    'color'        => $row[5],
                    'sort_order'   => $row[6],
                    'is_active'    => 1,
                ]);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('service_pages', [
            'nav_label',
            'nav_label_en',
            'nav_desc',
            'nav_desc_en',
            'icon',
            'color',
            'sort_order',
            'is_active',
        ]);
    }
}
