<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        $session = \Config\Services::session();
        $locale = $session->get('lang');
        if ($locale) {
            $request->setLocale($locale);
        }

        // [ANTIGRAVITY] Global Data for Views
        // Load SiteSettingModel manually since we can't use model() helper in strict BaseController without loading helper
        $settingModel = new \App\Models\SiteSettingModel();

        // Menu layanan bisnis dikelola dari CMS, jadi navbar & footer perlu
        // datanya di semua halaman — bukan cuma di controller Services.
        // Satu query saja: sidebar admin butuh semua kategori (termasuk yang
        // non-aktif), menu publik hanya yang aktif.
        $serviceMenuAll = [];
        try {
            $serviceMenuAll = (new \App\Models\ServicePageModel())->getAllOrdered();
        } catch (\Throwable $e) {
            // Jangan sampai seluruh situs mati kalau tabel/kolomnya belum
            // dimigrasi; menu cukup tampil kosong.
            log_message('error', 'Gagal memuat menu layanan: ' . $e->getMessage());
        }

        $serviceMenu = array_values(array_filter(
            $serviceMenuAll,
            static fn ($row) => (int) ($row['is_active'] ?? 1) === 1
        ));

        // Share data globally to all Views
        $globalData = [
            'whatsapp'       => $settingModel->getVal('company_whatsapp') ?? '', // Empty fallback if not set in DB
            'serviceMenu'    => $serviceMenu,
            'serviceMenuAll' => $serviceMenuAll,
        ];

        \Config\Services::renderer()->setData($globalData, 'raw');

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');
    }
}
