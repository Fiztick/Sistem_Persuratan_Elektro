<?php

namespace App\Controllers;
use Ramsey\Uuid\Uuid;
use App\Models\InboxModel;
use App\Models\TipeModel;
use App\Models\UserModel;
use CodeIgniter\Files\File;

class Inbox extends BaseController
{
    protected $helpers = ['form'];

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
        $keyword = $this->request->getVar('keyword');
        if (!empty($keyword)){
            return $this->search();
        }

        $query = "status_inbox < 3";

        $builder = $this->inbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->where('status_inbox < 3');
        $datas = $builder->get()->getResult();

        // Create an associative array of user IDs and names
        $userNames = [];
        $typeNames = [];
        foreach ($datas as $data) {
            $userNames[$data->id_user] = $data->nama_user;
            $typeNames[$data->tipe_inbox] = $data->nama_tipe;
        }

        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] = 15;
        $this->data['total'] =  $this->inbox_model->where($query)->countAllResults();
        $this->data['inbox'] = $this->inbox_model->where($query)->orderBy('tanggal_inbox', 'DESC')->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['inbox'])? count($this->data['inbox']) : 0;
        $this->data['pager'] = $this->inbox_model->pager;

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
        $data = $this->inbox_model->find($id);
        $tanggal_file = strtotime($data['tanggal_inbox']);
        $tanggal_file = date('d-m-Y', $tanggal_file);
        $file = WRITEPATH . 'uploads/' . $tanggal_file . '/' . $data['file_inbox'];
        
        //apus file di server
        if(!empty($data['file_inbox'])){
            unlink($file);
        }

        //apus di database
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
        $rules = [
            'email_inbox' => 'required',
            'tipe_inbox' => 'required',
            'deskripsi_inbox' => 'required|max_length[50]',
        ];

        if (! $this->validate($rules)) {
            $data['tipe'] = $this->tipe_model->findAll();

            $validation = \Config\Services::validation();
            return redirect()->to(site_url('home/pengajuan'))->withInput()->with('error', $validation->listErrors());
        }

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

    function download($id)
    {
        $data = $this->inbox_model->find($id);
        $tanggal_file = strtotime($data['tanggal_inbox']);
        $tanggal_file = date('d-m-Y', $tanggal_file);
        $file = WRITEPATH . 'uploads/' . $tanggal_file . '/' . $data['file_inbox'];
        return $this->response->download($file, null);
    }

    private function totalChecker($keyword) 
    {
        $query = "status_inbox < 3";

        // dd($this->users);

        if (!empty($this->users)) {
            return $this->inbox_model->groupStart()
                ->like('email_inbox', $keyword)
                ->orWhereIn('id_user', $this->users)
                ->groupEnd()
                ->where($query)
                ->countAllResults();
        } else {
            return $this->inbox_model->groupStart()
                ->like('email_inbox', $keyword)
                ->groupEnd()
                ->where($query)
                ->countAllResults();
        }
    }

    private function inboxChecker($keyword) 
    {
        $query = "status_inbox < 3";

        if (!empty($this->users)) {
            return $this->inbox_model->groupStart()
                ->like('email_inbox', $keyword, 'BOTH')
                ->orWhereIn('id_user', $this->users)
                ->where($query)
                ->groupEnd()
                ->orderBy('tanggal_inbox', 'DESC')
                ->paginate($this->data['perPage']);
        } else {
            return $this->inbox_model->groupStart()
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

        // ngambil nama user yang sesuai keyword
        $builder = $this->inbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->where('status_inbox <', 2);
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
        $builder->where('status_inbox < 3');
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

        return view('inbox/get', $this->data);
    }

    // status kebawah nnti pindahin ke controller sendiri biar lebih enak ama routingnya diubah
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