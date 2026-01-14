<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Language extends BaseController
{
    public function index($locale)
    {
        $session = session();
        
        // Validasi bahasa yang dipilih
        $validLocales = ['id', 'en'];
        if(in_array($locale, $validLocales)){
            $session->set('lang', $locale);
        }
        
        // Kembali ke halaman sebelumnya
        return redirect()->back();
    }
}