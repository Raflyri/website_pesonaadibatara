<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJobVacanciesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'job_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'job_description' => [
                'type' => 'TEXT',
            ],
            'job_requirement' => [
                'type' => 'TEXT',
            ],
            'department' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'employment_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'work_location_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'office_location' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'min_salary' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'max_salary' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'hide_salary' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'benefits' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'application_deadline' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Draft', 'Published', 'Closed'],
                'default'    => 'Draft',
            ],
            'application_link' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'seo_meta_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
                'null'       => true,
            ],
            'seo_meta_description' => [
                'type'       => 'VARCHAR',
                'constraint' => '160',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('job_vacancies');
    }

    public function down()
    {
        $this->forge->dropTable('job_vacancies');
    }
}
