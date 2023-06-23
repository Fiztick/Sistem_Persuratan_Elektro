<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InboxModel;
use App\Models\TipeModel;
use App\Models\UserModel;

class Status_Surat extends BaseController
{
    public function __construct()
    {
        // $this->request = \Config\Services::request();
        // $this->session = session();
        $this->inbox_model = new InboxModel();
        $this->tipe_model = new TipeModel();
        $this->user_model = new UserModel();
        $this->query = "inbox.id_user = " . session()->get('id');
        // $this->data = ['session' => $this->session,'request'=>$this->request];
    }

    public function index()
    {
        return view('status/cari_status');
    }

    public function getSurat()
    {
        $id_inbox = $this->request->getVar('id_inbox');
        $builder = $this->inbox_model->builder();

        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->where('id_inbox', $id_inbox);
        $data['inbox'] = $builder->get()->getRow();
        unset($data['inbox']->password_user);

        if(empty($data['inbox']->id_inbox)) {
            return redirect()->to(site_url('pencarian-surat'))->with('error', 'Surat tidak ditemukan tolong dicek lagi'); 
        }

        return view('status/status_surat', $data);
    }
}
