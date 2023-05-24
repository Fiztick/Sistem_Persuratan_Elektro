<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // total surat masuk
        $query = $this->db->query('SELECT * FROM inbox');
        $data['inbox_total'] = $query->getNumRows();

        // total surat diproses
        $query = $this->db->query('SELECT * FROM inbox WHERE status_inbox<3');
        $data['inbox_diproses'] = $query->getNumRows();

        // total surat selesai
        $query = $this->db->query('SELECT * FROM inbox WHERE status_inbox>=3');
        $data['inbox_selesai'] = $query->getNumRows();

        // user
        $query = $this->db->query('SELECT * FROM users');
        $data['users'] = $query->getNumRows();

        return view ('home', $data);
    }
}
