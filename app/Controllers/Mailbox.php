<?php

namespace App\Controllers;
use App\Models\InboxModel;
use App\Models\TipeModel;
use App\Models\UserModel;
use App\Models\StatusModel;
use CodeIgniter\Files\File;

class Mailbox extends BaseController
{
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->mailbox_model = new InboxModel;
        $this->tipe_model = new TipeModel();
        $this->user_model = new UserModel();
        $this->status_model = new StatusModel();
    }

    public function index()
    {
        $query = "status_inbox >= 3";

        $builder = $this->mailbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->join('status', 'status.id_status = inbox.status_inbox');
        $builder->where($query);
        $datas = $builder->get()->getResult();

        // // Create an associative array of user IDs and names
        // $userNames = [];
        // $userEmails = [];
        // $typeNames = [];
        // $statusInbox = [];
        // foreach ($datas as $data) {
        //     $userNames[$data->id_user] = $data->nama_user;
        //     $userEmails[$data->id_user] = $data->email_user;
        //     $typeNames[$data->tipe_inbox] = $data->nama_tipe;
        //     $statusInbox[$data->status_inbox] = $data->nama_status;
        // }

        $this->data['status'] = $this->status_model->get()->getResult();
        $this->data['mailbox'] = $datas;

        // // Assign the user names to the $inbox array
        // foreach ($this->data['mailbox'] as &$inboxItem) {
        //     $inboxItem->nama_user = $userNames[$inboxItem->id_user] ?? '';
        //     $inboxItem->email_user = $userEmails[$inboxItem->id_user] ?? '';
        //     $inboxItem->nama_tipe = $typeNames[$inboxItem->tipe_inbox] ?? '';
        //     $inboxItem->nama_status = $statusInbox[$inboxItem->status_inbox] ?? '';
        // }

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

    function download($id)
    {
        $data = $this->mailbox_model->find($id);
        $tanggal_file = strtotime($data['tanggal_inbox']);
        $tanggal_file = date('d-m-Y', $tanggal_file);
        $file = WRITEPATH . 'uploads/' . $tanggal_file . '/' . $data['file_inbox'];
        return $this->response->download($file, null);
    }

    public function destroy($id) {
        $this->mailbox_model->delete($id);
        return redirect()->to(site_url('mailbox'))->with('success', 'Data Berhasil Dihapus');
    }
}