<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPostedAtToJobVacancies extends Migration
{
    public function up()
    {
        $this->forge->addColumn('job_vacancies', [
            'posted_at' => [
                'type'       => 'DATE',
                'null'       => true,
                'default'    => null,
                'after'      => 'application_deadline',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('job_vacancies', 'posted_at');
    }
}
