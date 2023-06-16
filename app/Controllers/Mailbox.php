<?php

namespace App\Controllers;
use App\Models\InboxModel;
use App\Models\TipeModel;
use App\Models\UserModel;

class Mailbox extends BaseController
{
    public function __construct()
    {
        // $this->request = \Config\Services::request();
        // $this->session = session();
        $this->mailbox_model = new InboxModel;
        $this->tipe_model = new TipeModel();
        $this->user_model = new UserModel();
        // $this->data = ['session' => $this->session,'request'=>$this->request];
    }

    public function index()
    {
        $query = "status_inbox >= 3";

        $builder = $this->mailbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $datas = $builder->get()->getResult();

        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->mailbox_model->where($query)->countAllResults();
        $this->data['mailbox'] = $this->mailbox_model->where($query)->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['mailbox'])? count($this->data['mailbox']) : 0;
        $this->data['pager'] = $this->mailbox_model->pager;

        // Create an associative array of user IDs and names
        $userNames = [];
        $typeNames = [];
        foreach ($datas as $data) {
            $userNames[$data->id_user] = $data->nama_user;
            $typeNames[$data->tipe_inbox] = $data->nama_tipe;
        }

        // Assign the user names to the $inbox array
        foreach ($this->data['mailbox'] as &$inboxItem) {
            $inboxItem['nama_user'] = $userNames[$inboxItem['id_user']] ?? '';
            $inboxItem['nama_tipe'] = $typeNames[$inboxItem['tipe_inbox']] ?? '';
        }

        return view('mailbox/get', $this->data);
    }

    public function update($id)
    {
        if(!empty($id)) {
            if($this->mailbox_model->countAllResults() > 0) {
                $data = ['status_inbox' => $this->request->getVar('status_inbox'),];

                $update = $this->mailbox_model->where('id_inbox',$id)->set($data)->update();
                if($update) {
                    return redirect()->to(site_url('mailbox'))->with('success', 'Status Berhasil Diupdate');  
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundExecption::forPageNotFound();
            }
        } else {
            return redirect()->to('inventory');
        }
    }

    public function destroy($id) {
        $this->mailbox_model->delete($id);
        return redirect()->to(site_url('mailbox'))->with('success', 'Data Berhasil Dihapus');
    }
}