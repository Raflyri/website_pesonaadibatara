<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest; // <--- PENTING: Tambahkan ini

class Language implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // PENTING: Cek dulu apakah ini IncomingRequest (Web) bukan CLI
        if (!$request instanceof IncomingRequest) {
            return;
        }

        $session = session();
        
        // Sekarang aman memanggil getVar()
        $lang = $request->getVar('lang'); 

        if ($lang) {
            if (in_array($lang, ['id', 'en'])) {
                $session->set('lang', $lang);
                
                $locale = ($lang == 'id') ? 'id' : 'en';
                service('request')->setLocale($locale);
            }
            return redirect()->to(current_url());
        }

        if ($session->get('lang')) {
            $locale = ($session->get('lang') == 'id') ? 'id' : 'en';
            service('request')->setLocale($locale);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}