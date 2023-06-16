<?php

namespace App\Controllers;
use Ramsey\Uuid\Uuid;
use App\Models\InboxModel;
use App\Models\TipeModel;
use App\Models\UserModel;
use CodeIgniter\Files\File;

class Inbox extends BaseController
{
    public function __construct()
    {
        // $this->request = \Config\Services::request();
        // $this->session = session();
        $this->inbox_model = new InboxModel();
        $this->tipe_model = new TipeModel();
        $this->user_model = new UserModel();
        // $this->data = ['session' => $this->session,'request'=>$this->request];
    }

    public function index()
    {
        $query = "status_inbox < 3";

        $builder = $this->inbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->where('status_inbox <', 2);
        $datas = $builder->get()->getResult();
        // var_dump($datas);

        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->inbox_model->where($query)->countAllResults();
        $this->data['inbox'] = $this->inbox_model->where($query)->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['inbox'])? count($this->data['inbox']) : 0;
        $this->data['pager'] = $this->inbox_model->pager;

        // Create an associative array of user IDs and names
        $userNames = [];
        $typeNames = [];
        foreach ($datas as $data) {
            $userNames[$data->id_user] = $data->nama_user;
            $typeNames[$data->tipe_inbox] = $data->nama_tipe;
        }

        // Assign the user names to the $inbox array
        foreach ($this->data['inbox'] as &$inboxItem) {
            $inboxItem['nama_user'] = $userNames[$inboxItem['id_user']] ?? '';
            $inboxItem['nama_tipe'] = $typeNames[$inboxItem['tipe_inbox']] ?? '';
        }

        return view('inbox/get', $this->data);
    }

    public function update($id)
    {
        if(!empty($id)) {
            if($this->inbox_model->countAllResults() > 0) {
                $data = ['status_inbox' => $this->request->getVar('status_inbox'),];

                $update = $this->inbox_model->where('id_inbox',$id)->set($data)->update();
                if($update) {
                    return redirect()->to(site_url('inbox'))->with('success', 'Status Berhasil Diupdate');  
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundExecption::forPageNotFound();
            }
        } else {
            return redirect()->to('inbox');
        }
    }

    public function destroy($id) {
        $this->inbox_model->delete($id);
        return redirect()->to(site_url('inbox'))->with('success', 'Data Berhasil Dihapus');
    }

    public function create() 
    {
        $data['tipe'] = $this->tipe_model->findAll();

        return view('inbox/add', $data);
    }

    public function store()
    {
        $id_surat = Uuid::uuid4()->toString();
        $data = [
            'id_inbox' => $id_surat,
            'email_inbox' => $this->request->getVar('email_inbox'),
            'tipe_inbox' => $this->request->getVar('tipe_inbox'),
            'deskripsi_inbox' => $this->request->getVar('deskripsi_inbox'),
            'id_user' => session()->get('id'),
            'file_inbox' => null,
        ];

        $file_inbox = $this->request->getFile('file_inbox');

        if($file_inbox->getSize() > 0) {
            if (!$file_inbox->hasMoved()) {
                $file_name = $file_inbox->getRandomName();
                $file_inbox->move(WRITEPATH . 'uploads/' . date('d-m-Y'), $file_name);
                
                $data['file_inbox'] = $file_name;
            } else {
                return redirect()->to(site_url('home/pengajuan'))->with('error', 'File Gagal Diupload');
            }
        }

        $query = $this->inbox_model->allowEmptyInserts(true)->insert($data);
        
        return redirect()->to(site_url('home/kode-surat'))->with('success', 'Surat Berhasil Dikirim')->with('id_surat', $id_surat);
    }

    public function kode_surat()
    {
        $this->data['id_surat'] = session()->get('id_surat');
        return view('inbox/kode_surat', $this->data);
    }

    public function pencarian_surat()
    {
        return view('inbox/cari_status');
    }

    public function status()
    {
        $id_inbox = $this->request->getVar('id_inbox');
        $builder = $this->inbox_model->builder();

        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->where('id_inbox', $id_inbox);
        $data['inbox'] = $builder->get()->getRow();
        unset($data['inbox']->password_user);       

        return view('inbox/status', $data);
    }
}