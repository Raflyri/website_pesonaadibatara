<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Media extends BaseController
{
    public function index()
    {
        // Folder utama yang akan discan
        $targetRoots = [
            'uploads',      // Ini akan discan sampai ke dalam-dalamnya (news, team, dll)
            'assets/img',   
            'assets/video'
        ];

        $files = [];

        foreach ($targetRoots as $rootFolder) {
            $absPath = FCPATH . $rootFolder;

            // Cek apakah folder utama ada
            if (!is_dir($absPath)) {
                continue;
            }

            // --- MAGIC STARTS HERE ---
            // Menggunakan RecursiveDirectoryIterator untuk masuk ke semua sub-folder
            $dirIterator = new \RecursiveDirectoryIterator($absPath, \FilesystemIterator::SKIP_DOTS);
            $iterator    = new \RecursiveIteratorIterator($dirIterator, \RecursiveIteratorIterator::SELF_FIRST);
            // -------------------------

            foreach ($iterator as $file) {
                // $file adalah object SplFileInfo
                
                // 1. Pastikan ini File (bukan folder)
                if (!$file->isFile()) {
                    continue;
                }

                $filename = $file->getFilename();

                // 2. Filter file sistem/git
                if (in_array($filename, ['index.html', '.gitignore', '.gitkeep', 'Thumbs.db']) || strpos($filename, '.') === 0) {
                    continue;
                }

                // 3. Tentukan Path untuk URL
                // Kita harus menghitung path relatif dari FCPATH (folder public)
                // Contoh Real Path: C:\xampp\htdocs\public\uploads\news\foto.jpg
                // FCPATH: C:\xampp\htdocs\public\
                // Relative: uploads\news\foto.jpg
                
                $realPath = $file->getRealPath();
                // Hapus bagian FCPATH dari path file untuk dapat relative path
                $relativePath = str_replace(FCPATH, '', $realPath);
                
                // Normalisasi slash (Windows pakai backslash, Browser butuh forward slash)
                $relativePath = str_replace('\\', '/', $relativePath);
                
                // Bersihkan slash di awal jika ada
                $relativePath = ltrim($relativePath, '/');

                // 4. Ambil Info File
                try {
                    $mime = mime_content_type($realPath);
                    $size = $file->getSize();
                } catch (\Exception $e) {
                    $mime = 'application/octet-stream';
                    $size = 0;
                }

                // Tentukan Tipe Visual
                $type = 'file';
                if (strpos($mime, 'image') !== false) $type = 'image';
                elseif (strpos($mime, 'video') !== false) $type = 'video';

                // Tentukan Label Folder (misal: "uploads/news")
                // dirname($relativePath) akan mengambil nama foldernya saja
                $folderLabel = dirname($relativePath);
                // Jika folder labelnya cuma "." (artinya di root), ganti nama aslinya
                if($folderLabel == '.') $folderLabel = $rootFolder;

                $files[] = [
                    'name'          => $filename,
                    'relative_path' => $relativePath, // path lengkap termasuk subfolder
                    'url'           => base_url($relativePath),
                    'folder'        => $folderLabel, // Akan muncul sebagai "uploads/news", "uploads/team", dll
                    'type'          => $type,
                    'size'          => $this->formatSize($size),
                    // Hanya boleh hapus jika file berada di dalam root 'uploads'
                    // Kita cek string depannya apakah dimulai dengan 'uploads'
                    'is_deletable'  => (strpos($relativePath, 'uploads') === 0)
                ];
            }
        }

        // Sorting: File terbaru di atas (berdasarkan Modified Time)
        usort($files, function($a, $b) {
            $timeA = @filemtime(FCPATH . $a['relative_path']);
            $timeB = @filemtime(FCPATH . $b['relative_path']);
            return $timeB - $timeA; 
        });

        $data = [
            'title' => 'Media Library',
            'files' => $files 
        ];

        return view('admin/media/index', $data);
    }

    public function upload()
    {
        $file = $this->request->getFile('file_upload');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', $file->getErrorString());
        }

        $validationRule = [
            'file_upload' => [
                'label' => 'File Media',
                'rules' => 'uploaded[file_upload]'
                    . '|mime_in[file_upload,image/jpg,image/jpeg,image/png,image/gif,image/webp,video/mp4]'
                    . '|max_size[file_upload,10240]', // Naikkan ke 10MB buat video pendek
            ],
        ];

        if (! $this->validate($validationRule)) {
             return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload SELALU masuk ke folder 'uploads' agar folder assets tetap bersih
        $newName = $file->getRandomName(); 
        $file->move(FCPATH . 'uploads', $newName);

        return redirect()->to('/panel-pab/media')->with('success', 'File berhasil diupload ke folder Uploads!');
    }

    public function delete()
    {
        // Kita terima 'relative_path' (misal: uploads/gambar.jpg)
        $relativePath = $this->request->getPost('relative_path');
        
        // SECURITY CHECK: Cegah Directory Traversal (../)
        if (strpos($relativePath, '..') !== false) {
            return redirect()->to('/panel-pab/media')->with('error', 'Invalid path.');
        }

        // SECURITY CHECK: Pastikan hanya menghapus file di folder 'uploads'
        // Jika Rafly ingin bisa hapus aset juga, hapus blok if ini.
        if (strpos($relativePath, 'uploads/') !== 0) {
            return redirect()->to('/panel-pab/media')->with('error', 'File sistem/aset tidak boleh dihapus demi keamanan layout.');
        }

        $fullPath = FCPATH . $relativePath;

        if (is_file($fullPath)) {
            unlink($fullPath);
            return redirect()->to('/panel-pab/media')->with('success', 'File berhasil dihapus.');
        }

        return redirect()->to('/panel-pab/media')->with('error', 'File tidak ditemukan.');
    }

    // Helper kecil untuk format ukuran
    private function formatSize($bytes)
    {
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576) return number_format($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024) return number_format($bytes / 1024, 2) . ' KB';
        return $bytes . ' bytes';
    }
}