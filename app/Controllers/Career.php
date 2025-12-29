<?php

namespace App\Controllers;

class Career extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Karir & Lowongan'
        ];
        return view('career', $data);
    }
}