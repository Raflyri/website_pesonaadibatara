<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Deskripsi kartu "Pilar Bisnis" di homepage sebelumnya diambil dari file
 * bahasa (hardcode 4 pilar). Dipindah ke DB supaya bidang bisnis baru yang
 * dibuat lewat CMS ikut tampil di homepage.
 *
 * Dipisah dari nav_desc karena panjangnya beda: nav_desc itu label pendek
 * di dropdown ("Luxury Car & Operasional"), sedangkan ini satu kalimat penuh.
 */
class AddHomeDescToServicePages extends Migration
{
    public function up()
    {
        $this->forge->addColumn('service_pages', [
            'home_desc' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'nav_desc_en',
            ],
            'home_desc_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'home_desc',
            ],
        ]);

        // Seed dengan teks yang persis sama seperti di Language/{id,en}/Home.php
        // agar tampilan homepage tidak berubah sedikit pun.
        $seed = [
            'transportasi' => [
                'Solusi armada lengkap mulai dari Luxury Car, EV, hingga logistik operasional.',
                'Complete fleet solutions ranging from Luxury Cars, EVs, to operational logistics.',
            ],
            'kesehatan' => [
                'Layanan medis terpadu melalui Batara Health Care, MCU, dan Apotek.',
                'Integrated medical services through Batara Health Care, MCU, and Pharmacy.',
            ],
            'jasa' => [
                'Pembersihan Fasade gedung, Event Organizer, dan Pengadaan barang.',
                'Building Facade cleaning, Event Organizer, and Goods Procurement.',
            ],
            'investasi' => [
                'Pengembangan bisnis KSO, Food & Beverages, Laundry, dan Sport Center.',
                'Business development in Joint Operations (KSO), Food & Beverages, Laundry, and Sport Centers.',
            ],
        ];

        foreach ($seed as $category => $row) {
            $this->db->table('service_pages')
                ->where('category', $category)
                ->update([
                    'home_desc'    => $row[0],
                    'home_desc_en' => $row[1],
                ]);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('service_pages', ['home_desc', 'home_desc_en']);
    }
}
