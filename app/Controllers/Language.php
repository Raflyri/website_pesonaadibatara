<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Language extends BaseController
{
    public function index($locale)
    {
        $session = session();
        
        // 1. Validasi Input (Security Best Practice)
        $validLocales = ['id', 'en'];
        if (in_array($locale, $validLocales)) {
            // 2. Set Session
            $session->set('lang', $locale);
            
            // 3. Set Locale CodeIgniter secara realtime agar efeknya instan
            $this->request->setLocale($locale);
        }
        
        // 4. Redirect Logic (Agar user tidak terjebak di halaman kosong)
        // Coba kembali ke halaman sebelumnya (referrer)
        return redirect()->back(); 
    }
}