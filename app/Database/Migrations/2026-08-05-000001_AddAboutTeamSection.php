<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Section "Tim Kami" di halaman About kini menampilkan foto grup perusahaan
 * di samping daftar anggota. Fotonya disimpan di `page_sections.media_url`
 * supaya bisa diganti lewat About Editor, sama seperti gambar Sejarah.
 *
 * Tabel `page_sections` sudah punya semua kolom yang dibutuhkan, jadi migrasi
 * ini hanya menambahkan barisnya.
 */
class AddAboutTeamSection extends Migration
{
    public function up()
    {
        $exists = $this->db->table('page_sections')
            ->where('section_key', 'about_team')
            ->countAllResults();

        if ($exists > 0) {
            return;
        }

        $this->db->table('page_sections')->insert([
            'section_key' => 'about_team',
            'title_id'    => 'Tim Kami',
            'title_en'    => 'Our Team',
            'content_id'  => '',
            'content_en'  => '',
            'media_url'   => null,
        ]);
    }

    public function down()
    {
        $this->db->table('page_sections')->where('section_key', 'about_team')->delete();
    }
}
