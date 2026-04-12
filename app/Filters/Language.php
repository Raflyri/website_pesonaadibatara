<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;

class Language implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Cek apakah ini request Web (bukan CLI)
        if (!$request instanceof IncomingRequest) {
            return;
        }

        $session = session();
        $lang = $request->getGet('lang'); // Gunakan getGet khusus untuk query params

        // 2. Jika ada request ganti bahasa di URL (?lang=xx)
        if ($lang) {
            $validLangs = ['id', 'en'];

            if (in_array($lang, $validLangs)) {
                // Simpan ke session
                $session->set('lang', $lang);
                $request->setLocale($lang);
            }

            // --- CARA CLEAN MEMBERSIHKAN URL ---

            // 1. Ambil URI Object saat ini
            $uri = $request->getUri();

            // 2. Ambil semua query string sebagai Array (lebih aman daripada Regex)
            // Contoh: ['lang' => 'id', 'search' => 'mobil']
            $queryParams = $request->getGet();

            // 3. Buang key 'lang' dari array
            unset($queryParams['lang']);

            // 4. Update URI dengan query string yang sudah bersih
            // method setQuery otomatis menghandle format ?key=value
            $uri->setQuery(http_build_query($queryParams));

            // 5. Redirect ke URI yang sudah bersih
            // Kita cast (string) $uri agar menjadi full URL
            return redirect()->to((string) $uri);
        }

        // 3. Jika tidak ada request di URL, gunakan session
        if ($session->has('lang')) {
            $request->setLocale($session->get('lang'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
