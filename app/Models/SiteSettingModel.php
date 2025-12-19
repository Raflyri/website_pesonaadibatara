<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteSettingModel extends Model
{
    protected $table            = 'site_settings';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['setting_key', 'setting_value'];

    // Helper function supaya manggilnya gampang: $model->getVal('company_phone')
    public function getVal($key)
    {
        $result = $this->where('setting_key', $key)->first();
        return $result ? $result['setting_value'] : null;
    }
}