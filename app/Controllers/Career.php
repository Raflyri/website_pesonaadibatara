<?php

namespace App\Controllers;

use App\Models\JobVacancyModel;

class Career extends BaseController
{
    protected $jobModel;

    public function __construct()
    {
        $this->jobModel = new JobVacancyModel();
    }

    public function index()
    {
        $department = $this->request->getGet('department');
        $employment_type = $this->request->getGet('employment_type');
        $location_type = $this->request->getGet('location_type');

        $query = $this->jobModel->where('status', 'Published')
                               ->groupStart()
                                   ->where('application_deadline >=', date('Y-m-d'))
                                   ->orWhere('application_deadline', null)
                               ->groupEnd();

        if ($department) {
            $query->where('department', $department);
        }
        if ($employment_type) {
            $query->where('employment_type', $employment_type);
        }
        if ($location_type) {
            $query->where('work_location_type', $location_type);
        }

        $vacancies = $query->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => lang('Frontend.career.hero_title'),
            'vacancies' => $vacancies,
            'filters' => [
                'department' => $department,
                'employment_type' => $employment_type,
                'location_type' => $location_type
            ],
            // Get unique values for filters
            'departments' => $this->jobModel->where('status', 'Published')->distinct()->select('department')->findAll(),
            'employment_types' => $this->jobModel->where('status', 'Published')->distinct()->select('employment_type')->findAll(),
            'location_types' => $this->jobModel->where('status', 'Published')->distinct()->select('work_location_type')->findAll(),
        ];

        return view('career', $data);
    }

    public function detail($slug)
    {
        $vacancy = $this->jobModel->where('slug', $slug)->where('status', 'Published')->first();

        if (!$vacancy) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $vacancy['job_title'] . ' | Karir',
            'vacancy' => $vacancy,
            'meta_title' => $vacancy['seo_meta_title'],
            'meta_desc' => $vacancy['seo_meta_description']
        ];

        return view('career_detail', $data);
    }
}
