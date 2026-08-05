<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBioToTeams extends Migration
{
    public function up()
    {
        $this->forge->addColumn('teams', [
            'bio_id' => [
                'type'  => 'TEXT',
                'null'  => true,
                'after' => 'position_en',
            ],
            'bio_en' => [
                'type'  => 'TEXT',
                'null'  => true,
                'after' => 'bio_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('teams', ['bio_id', 'bio_en']);
    }
}
