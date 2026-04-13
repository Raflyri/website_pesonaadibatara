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

    /**
     * Get a locale-aware setting value.
     * If locale is not 'id', try '{key}_{locale}' first (e.g., 'company_tagline_en').
     * Falls back to the base '{key}' if the localized version doesn't exist or is empty.
     *
     * Usage: $model->getLocalizedVal('company_tagline')
     */
    public function getLocalizedVal(string $key): ?string
    {
        $locale = service('request')->getLocale();

        // For non-default locales, try the localized key first
        if ($locale !== 'id') {
            $localized = $this->getVal($key . '_' . $locale);
            if (!empty($localized)) {
                return $localized;
            }
        }

        // Default: return the base key value
        return $this->getVal($key);
    }
}