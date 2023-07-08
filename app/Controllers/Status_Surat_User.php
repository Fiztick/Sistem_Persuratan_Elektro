<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InboxModel;
use App\Models\TipeModel;
use App\Models\UserModel;

class Status_Surat_User extends BaseController
{
    public function __construct()
    {
        $this->inbox_model = new InboxModel();
        $this->tipe_model = new TipeModel();
        $this->user_model = new UserModel();
        $this->query = "inbox.id_user = " . session()->get('id');
    }

    public function index()
    {      
        $builder = $this->inbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->join('status', 'status.id_status = inbox.status_inbox');
        $builder->where($this->query);
        $datas = $builder->get()->getResult();

        $this->data['inbox'] = $datas;

        return view('status/status_surat_user', $this->data);
    }
}
