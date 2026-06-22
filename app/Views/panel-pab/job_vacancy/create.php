<?= $this->extend('panel-pab/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid px-4">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/panel-pab/job-vacancies/save" method="POST">
                <?= csrf_field(); ?>

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="job_title" class="form-label">Job Title (Judul Pekerjaan) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="job_title" name="job_title" value="<?= old('job_title'); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug / URL Custom</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="<?= old('slug'); ?>">
                            <small class="text-muted">Generate otomatis dari judul jika dikosongkan.</small>
                        </div>

                        <div class="mb-3">
                            <label for="job_description" class="form-label">Job Description (Deskripsi Pekerjaan) <span class="text-danger">*</span></label>
                            <textarea class="form-control summernote" id="job_description" name="job_description"><?= old('job_description'); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="job_requirement" class="form-label">Job Requirement (Kualifikasi / Persyaratan) <span class="text-danger">*</span></label>
                            <textarea class="form-control summernote" id="job_requirement" name="job_requirement"><?= old('job_requirement'); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="benefits" class="form-label">Benefits (Fasilitas tambahan)</label>
                            <textarea class="form-control" id="benefits" name="benefits" rows="3" placeholder="Contoh: Asuransi Kesehatan, BPJS, Makan Siang Gratis"><?= old('benefits'); ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="department" class="form-label">Department / Category</label>
                                    <select class="form-select" id="department" name="department">
                                        <option value="">Pilih Departemen</option>
                                        <option value="IT & Software" <?= old('department') == 'IT & Software' ? 'selected' : ''; ?>>IT & Software</option>
                                        <option value="Finance" <?= old('department') == 'Finance' ? 'selected' : ''; ?>>Finance</option>
                                        <option value="HR" <?= old('department') == 'HR' ? 'selected' : ''; ?>>HR</option>
                                        <option value="Marketing" <?= old('department') == 'Marketing' ? 'selected' : ''; ?>>Marketing</option>
                                        <option value="Operations" <?= old('department') == 'Operations' ? 'selected' : ''; ?>>Operations</option>
                                        <option value="Logistics" <?= old('department') == 'Logistics' ? 'selected' : ''; ?>>Logistics</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label d-block">Employment Type (Tipe Kontrak)</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employment_type" id="full_time" value="Full-time" <?= old('employment_type', 'Full-time') == 'Full-time' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="full_time">Full-time</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employment_type" id="part_time" value="Part-time" <?= old('employment_type') == 'Part-time' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="part_time">Part-time</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employment_type" id="contract" value="Contract" <?= old('employment_type') == 'Contract' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="contract">Contract</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employment_type" id="internship" value="Internship" <?= old('employment_type') == 'Internship' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="internship">Internship</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label d-block">Work Location Type (Model Kerja)</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="work_location_type" id="onsite" value="On-site (WFO)" <?= old('work_location_type', 'On-site (WFO)') == 'On-site (WFO)' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="onsite">On-site</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="work_location_type" id="remote" value="Remote (WFH)" <?= old('work_location_type') == 'Remote (WFH)' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="remote">Remote</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="work_location_type" id="hybrid" value="Hybrid" <?= old('work_location_type') == 'Hybrid' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="hybrid">Hybrid</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="office_location" class="form-label">Office Location (Lokasi Fisik)</label>
                                    <input type="text" class="form-control" id="office_location" name="office_location" value="<?= old('office_location'); ?>" placeholder="Contoh: Jakarta Barat">
                                </div>
                            </div>
                        </div>

                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="min_salary" class="form-label">Min Salary</label>
                                            <input type="number" class="form-control" id="min_salary" name="min_salary" value="<?= old('min_salary'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="max_salary" class="form-label">Max Salary</label>
                                            <input type="number" class="form-control" id="max_salary" name="max_salary" value="<?= old('max_salary'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="hide_salary" name="hide_salary" value="1" <?= old('hide_salary') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="hide_salary">Hide Salary (Sembunyikan Gaji)</label>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="application_deadline" class="form-label">Application Deadline</label>
                                    <input type="date" class="form-control" id="application_deadline" name="application_deadline" value="<?= old('application_deadline'); ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="posted_at" class="form-label">Tanggal Posting <small class="text-muted">(opsional)</small></label>
                                    <input type="date" class="form-control" id="posted_at" name="posted_at" value="<?= old('posted_at'); ?>">
                                    <small class="text-muted">Kosongkan untuk menggunakan tanggal saat ini.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status Lowongan <span class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="Draft" <?= old('status') == 'Draft' ? 'selected' : ''; ?>>Draft</option>
                                        <option value="Published" <?= old('status', 'Published') == 'Published' ? 'selected' : ''; ?>>Published</option>
                                        <option value="Closed" <?= old('status') == 'Closed' ? 'selected' : ''; ?>>Closed</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="application_link" class="form-label">Application Link (Eksternal)</label>
                                    <input type="url" class="form-control" id="application_link" name="application_link" value="<?= old('application_link'); ?>" placeholder="https://...">
                                    <small class="text-muted">Kosongkan jika ingin menggunakan default behavior.</small>
                                </div>
                            </div>
                        </div>

                        <div class="card border-primary mb-3">
                            <div class="card-header bg-primary text-white">Optimasi SEO</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="seo_meta_title" class="form-label d-flex justify-content-between">
                                        Meta Title
                                        <span id="titleCounter" class="small text-muted">0 / 60</span>
                                    </label>
                                    <input type="text" class="form-control" id="seo_meta_title" name="seo_meta_title" value="<?= old('seo_meta_title'); ?>" maxlength="60">
                                </div>
                                <div class="mb-3">
                                    <label for="seo_meta_description" class="form-label d-flex justify-content-between">
                                        Meta Description
                                        <span id="descCounter" class="small text-muted">0 / 160</span>
                                    </label>
                                    <textarea class="form-control" id="seo_meta_description" name="seo_meta_description" rows="3" maxlength="160"><?= old('seo_meta_description'); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Simpan Lowongan</button>
                            <a href="/panel-pab/job-vacancies" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function() {
        // Auto-generate slug from Job Title
        $('#job_title').on('input', function() {
            let title = $(this).val();
            let slug = title.toLowerCase()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            $('#slug').val(slug);
        });

        // Character counter for SEO
        $('#seo_meta_title').on('input', function() {
            $('#titleCounter').text($(this).val().length + ' / 60');
        });

        $('#seo_meta_description').on('input', function() {
            $('#descCounter').text($(this).val().length + ' / 160');
        });

        // Trigger counters on load
        $('#seo_meta_title, #seo_meta_description').trigger('input');
    });
</script>
<?= $this->endSection(); ?>
