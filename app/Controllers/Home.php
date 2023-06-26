<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if(session()->get('jabatan') == 0) {
            return redirect()->to('home/admin');
        } else {
            return redirect()->to('home/pengajuan');
        }
    }

    public function admin() 
    {
        // total surat masuk
        $query = $this->db->query('SELECT * FROM inbox WHERE status_inbox < 3');
        $data['inbox_total'] = $query->getNumRows();
        
        // total surat selesai
        $query = $this->db->query('SELECT * FROM inbox WHERE status_inbox >= 3');
        $data['inbox_selesai'] = $query->getNumRows();

        // total surat diproses
        $query = $this->db->query('SELECT * FROM inventory');
        $data[''] = $query->getNumRows();

        // user
        $query = $this->db->query('SELECT * FROM users');
        $data['users'] = $query->getNumRows();

        return view ('home', $data);
    }

    public function pengajuan()
    {
        return view('inbox/add');
    }
}
