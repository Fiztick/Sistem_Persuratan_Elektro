<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('jabatan') != 0) {
            return redirect()->to('home/pengajuan')->with('error', 'Perintah Tidak diizinkan!');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // if (session()->get('jabatan') > 0) {
        //     return redirect()->to('home/pengajuan')->with('pesan', 'Tidak diizinkan!');
        // }
    }
}
