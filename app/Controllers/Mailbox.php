<?php

namespace App\Controllers;
use App\Models\InboxModel;
use App\Models\TipeModel;
use App\Models\UserModel;
use CodeIgniter\Files\File;

class Mailbox extends BaseController
{
    protected $helpers = ['form'];

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
        $keyword = $this->request->getVar('keyword');
        if (!empty($keyword)){
            return $this->search();
        }

        $query = "status_inbox >= 3";

        $builder = $this->mailbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $datas = $builder->get()->getResult();

        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->mailbox_model->where($query)->countAllResults();
        $this->data['mailbox'] = $this->mailbox_model->where($query)->orderBy('tanggal_inbox', 'DESC')->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['mailbox'])? count($this->data['mailbox']) : 0;
        $this->data['pager'] = $this->mailbox_model->pager;

        // Create an associative array of user IDs and names
        $userNames = [];
        $userEmails = [];
        $typeNames = [];
        foreach ($datas as $data) {
            $userNames[$data->id_user] = $data->nama_user;
            $userEmails[$data->id_user] = $data->email_user;
            $typeNames[$data->tipe_inbox] = $data->nama_tipe;
        }

        // Assign the user names to the $inbox array
        foreach ($this->data['mailbox'] as &$inboxItem) {
            $inboxItem['nama_user'] = $userNames[$inboxItem['id_user']] ?? '';
            $inboxItem['email_user'] = $userEmails[$inboxItem['id_user']] ?? '';
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

    private function totalChecker($keyword) 
    {
        $query = "status_inbox >= 3";

        // dd($this->users);

        if (!empty($this->users)) {
            return $this->mailbox_model->groupStart()
                ->like('email_inbox', $keyword)
                ->orWhereIn('id_user', $this->users)
                ->groupEnd()
                ->where($query)
                ->countAllResults();
        } else {
            return $this->mailbox_model->groupStart()
                ->like('email_inbox', $keyword)
                ->groupEnd()
                ->where($query)
                ->countAllResults();
        }
    }

    private function inboxChecker($keyword) 
    {
        $query = "status_inbox >= 3";

        if (!empty($this->users)) {
            return $this->mailbox_model->groupStart()
                ->like('email_inbox', $keyword, 'BOTH')
                ->orWhereIn('id_user', $this->users)
                ->where($query)
                ->groupEnd()
                ->orderBy('tanggal_inbox', 'DESC')
                ->paginate($this->data['perPage']);
        } else {
            return $this->mailbox_model->groupStart()
                ->like('email_inbox', $keyword, 'BOTH')
                ->where($query)
                ->groupEnd()
                ->orderBy('tanggal_inbox', 'DESC')
                ->paginate($this->data['perPage']);
        }
    }

    public function search()
    {
        $keyword = $this->request->getVar('keyword');

        if (empty($keyword)){
            return $this->index();
        }

        $query = "status_inbox >= 3";

        // ngambil nama user yang sesuai keyword
        $builder = $this->mailbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->where($query);
        $user_object = $builder->Like('nama_user', $keyword)->get()->getResult(); // Add this line

        foreach ($user_object as $user) {
            $this->users[] = $user->id_user;
        }

        if(!empty($this->users)) {
            $this->users = array_unique($this->users);
        }

        //ngambil smua data
        $builder = $this->mailbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->where($query);
        $datas = $builder->get()->getResult();

        // Create an associative array of user IDs and names
        $userNames = [];
        $userEmails = [];
        $typeNames = [];
        foreach ($datas as $data) {
            $userNames[$data->id_user] = $data->nama_user;
            $userEmails[$data->id_user] = $data->email_user;
            $typeNames[$data->tipe_inbox] = $data->nama_tipe;
        }

        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  15;
        $this->data['total'] = $this->totalChecker($keyword);
        $this->data['mailbox'] = $this->inboxChecker($keyword);
        $this->data['total_res'] = is_array($this->data['mailbox'])? count($this->data['mailbox']) : 0;
        $this->data['pager'] = $this->mailbox_model->pager;

        // Assign the user names to the $inbox array
        foreach ($this->data['mailbox'] as &$inboxItem) {
            $inboxItem['nama_user'] = $userNames[$inboxItem['id_user']] ?? '';
            $inboxItem['email_user'] = $userEmails[$inboxItem['id_user']] ?? '';
            $inboxItem['nama_tipe'] = $typeNames[$inboxItem['tipe_inbox']] ?? '';
        }

        return view('mailbox/get', $this->data);
        // $userEmails = [];
        // $userEmails[$data->id_user] = $data->email_user;
        // $inboxItem['email_user'] = $userEmails[$inboxItem['id_user']] ?? '';
    }
}