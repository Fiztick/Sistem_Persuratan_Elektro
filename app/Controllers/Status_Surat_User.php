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
        $keyword = $this->request->getVar('keyword');
        if (!empty($keyword)){
            return $this->search();
        }

        

        $builder = $this->inbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->where($this->query);
        $datas = $builder->get()->getResult();

        // dd($this->query);

        // Create an associative array of user IDs and names
        $userNames = [];
        $typeNames = [];
        foreach ($datas as $data) {
            $userNames[$data->id_user] = $data->nama_user;
            $typeNames[$data->tipe_inbox] = $data->nama_tipe;
        }

        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] = 15;
        $this->data['total'] =  $this->inbox_model->where($this->query)->countAllResults();
        $this->data['inbox'] = $this->inbox_model->where($this->query)->orderBy('tanggal_inbox', 'DESC')->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['inbox'])? count($this->data['inbox']) : 0;
        $this->data['pager'] = $this->inbox_model->pager;

        // Assign the user names to the $inbox array
        foreach ($this->data['inbox'] as &$inboxItem) {
            $inboxItem['nama_user'] = $userNames[$inboxItem['id_user']] ?? '';
            $inboxItem['nama_tipe'] = $typeNames[$inboxItem['tipe_inbox']] ?? '';
        }

        return view('status/status_surat_user', $this->data);
    }

    public function search()
    {
        $keyword = $this->request->getVar('keyword');

        if (empty($keyword)){
            return $this->index();
        }

        // ngambil nama user yang sesuai keyword
        $builder = $this->inbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->where($this->query);
        $user_object = $builder->Like('nama_user', $keyword)->get()->getResult(); // Add this line

        foreach ($user_object as $user) {
            $this->users[] = $user->id_user;
        }

        if(!empty($this->users)) {
            $this->users = array_unique($this->users);
        }

        //ngambil smua data
        $builder = $this->inbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->where($this->query);
        $datas = $builder->get()->getResult();

        // Create an associative array of user IDs and names
        $userNames = [];
        $typeNames = [];
        foreach ($datas as $data) {
            $userNames[$data->id_user] = $data->nama_user;
            $typeNames[$data->tipe_inbox] = $data->nama_tipe;
        }

        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  15;
        $this->data['total'] = $this->totalChecker($keyword);
        $this->data['inbox'] = $this->inboxChecker($keyword);
        $this->data['total_res'] = is_array($this->data['inbox'])? count($this->data['inbox']) : 0;
        $this->data['pager'] = $this->inbox_model->pager;

        // Assign the user names to the $inbox array
        foreach ($this->data['inbox'] as &$inboxItem) {
            $inboxItem['nama_user'] = $userNames[$inboxItem['id_user']] ?? '';
            $inboxItem['nama_tipe'] = $typeNames[$inboxItem['tipe_inbox']] ?? '';
        }

        return view('status/status_surat_user', $this->data);
    }
    // public function kode_surat()
    // {
    //     $this->data['id_surat'] = session()->get('id_surat');

    //     return view('status/kode_surat', $this->data);
    // }
}
