<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest; // <--- 1. Tambahkan ini
use App\Models\VisitorModel;

class VisitorTrack implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Asumsi URL admin dimulai dengan 'admin'
        $uri = service('uri');
        if ($uri->getSegment(1) === 'admin') {
            return;
        }

        // 2. Cek apakah ini Request Web (IncomingRequest)?
        // Karena getUserAgent() tidak ada di Request CLI
        if (!$request instanceof IncomingRequest) {
            return;
        }

        $visitorModel = new VisitorModel();
        $ip = $request->getIPAddress();
        
        // 3. Sekarang aman memanggil getUserAgent()
        $agent = $request->getUserAgent()->getAgentString();
        $today = date('Y-m-d');

        // Cek apakah IP ini sudah berkunjung HARI INI?
        $exist = $visitorModel->where('ip_address', $ip)
                              ->where('visit_date', $today)
                              ->first();

        // Jika belum ada, catat! (Unique Visitor)
        if (!$exist) {
            $visitorModel->insert([
                'ip_address' => $ip,
                'user_agent' => $agent,
                'visit_date' => $today
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}