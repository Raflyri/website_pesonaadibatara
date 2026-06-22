<?php

namespace App\Models;

use CodeIgniter\Model;

class JobVacancyModel extends Model
{
    protected $table            = 'job_vacancies';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'job_title',
        'slug',
        'job_description',
        'job_requirement',
        'department',
        'employment_type',
        'work_location_type',
        'office_location',
        'min_salary',
        'max_salary',
        'hide_salary',
        'benefits',
        'application_deadline',
        'posted_at',
        'status',
        'application_link',
        'seo_meta_title',
        'seo_meta_description'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get published and active vacancies
     */
    public function getActiveVacancies()
    {
        return $this->where('status', 'Published')
                    ->groupStart()
                        ->where('application_deadline >=', date('Y-m-d'))
                        ->orWhere('application_deadline', null)
                    ->groupEnd()
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}
