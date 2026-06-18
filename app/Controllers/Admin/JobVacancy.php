<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JobVacancyModel;

class JobVacancy extends BaseController
{
    protected $jobModel;

    public function __construct()
    {
        $this->jobModel = new JobVacancyModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Lowongan Kerja',
            'vacancies' => $this->jobModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('panel-pab/job_vacancy/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Lowongan Kerja'
        ];
        return view('panel-pab/job_vacancy/create', $data);
    }

    public function save()
    {
        $rules = [
            'job_title' => 'required',
            'job_description' => 'required',
            'job_requirement' => 'required',
            'status' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Mohon lengkapi field yang wajib diisi.');
        }

        $slug = $this->request->getPost('slug') ?: url_title($this->request->getPost('job_title'), '-', true);

        // Ensure slug is unique
        $checkSlug = $this->jobModel->where('slug', $slug)->first();
        if ($checkSlug) {
            $slug = $slug . '-' . time();
        }

        $data = [
            'job_title' => $this->request->getPost('job_title'),
            'slug' => $slug,
            'job_description' => $this->request->getPost('job_description'),
            'job_requirement' => $this->request->getPost('job_requirement'),
            'department' => $this->request->getPost('department'),
            'employment_type' => $this->request->getPost('employment_type'),
            'work_location_type' => $this->request->getPost('work_location_type'),
            'office_location' => $this->request->getPost('office_location'),
            'min_salary' => $this->request->getPost('min_salary') ?: null,
            'max_salary' => $this->request->getPost('max_salary') ?: null,
            'hide_salary' => $this->request->getPost('hide_salary') ? 1 : 0,
            'benefits' => $this->request->getPost('benefits'),
            'application_deadline' => $this->request->getPost('application_deadline') ?: null,
            'status' => $this->request->getPost('status'),
            'application_link' => $this->request->getPost('application_link'),
            'seo_meta_title' => $this->request->getPost('seo_meta_title'),
            'seo_meta_description' => $this->request->getPost('seo_meta_description'),
        ];

        $this->jobModel->insert($data);
        return redirect()->to('/panel-pab/job-vacancies')->with('success', 'Lowongan kerja berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $vacancy = $this->jobModel->find($id);
        if (!$vacancy) {
            return redirect()->to('/panel-pab/job-vacancies')->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Lowongan Kerja',
            'vacancy' => $vacancy
        ];
        return view('panel-pab/job_vacancy/edit', $data);
    }

    public function update($id)
    {
        $vacancy = $this->jobModel->find($id);
        if (!$vacancy) {
            return redirect()->to('/panel-pab/job-vacancies')->with('error', 'Data tidak ditemukan.');
        }

        $rules = [
            'job_title' => 'required',
            'job_description' => 'required',
            'job_requirement' => 'required',
            'status' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Mohon lengkapi field yang wajib diisi.');
        }

        $slug = $this->request->getPost('slug') ?: url_title($this->request->getPost('job_title'), '-', true);

        // Ensure slug is unique but ignore current record
        $checkSlug = $this->jobModel->where('slug', $slug)->where('id !=', $id)->first();
        if ($checkSlug) {
            $slug = $slug . '-' . time();
        }

        $data = [
            'job_title' => $this->request->getPost('job_title'),
            'slug' => $slug,
            'job_description' => $this->request->getPost('job_description'),
            'job_requirement' => $this->request->getPost('job_requirement'),
            'department' => $this->request->getPost('department'),
            'employment_type' => $this->request->getPost('employment_type'),
            'work_location_type' => $this->request->getPost('work_location_type'),
            'office_location' => $this->request->getPost('office_location'),
            'min_salary' => $this->request->getPost('min_salary') ?: null,
            'max_salary' => $this->request->getPost('max_salary') ?: null,
            'hide_salary' => $this->request->getPost('hide_salary') ? 1 : 0,
            'benefits' => $this->request->getPost('benefits'),
            'application_deadline' => $this->request->getPost('application_deadline') ?: null,
            'status' => $this->request->getPost('status'),
            'application_link' => $this->request->getPost('application_link'),
            'seo_meta_title' => $this->request->getPost('seo_meta_title'),
            'seo_meta_description' => $this->request->getPost('seo_meta_description'),
        ];

        $this->jobModel->update($id, $data);
        return redirect()->to('/panel-pab/job-vacancies')->with('success', 'Lowongan kerja berhasil diperbarui.');
    }

    public function delete($id)
    {
        $vacancy = $this->jobModel->find($id);
        if (!$vacancy) {
            return redirect()->to('/panel-pab/job-vacancies')->with('error', 'Data tidak ditemukan.');
        }

        $this->jobModel->delete($id);
        return redirect()->to('/panel-pab/job-vacancies')->with('success', 'Lowongan kerja berhasil dihapus.');
    }
}
