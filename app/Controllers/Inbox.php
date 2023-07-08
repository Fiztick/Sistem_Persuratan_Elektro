<?php
namespace App\Controllers;
use App\Models\InboxModel;
use App\Models\TipeModel;
use App\Models\UserModel;
use App\Models\StatusModel;
use CodeIgniter\Files\File;

class Inbox extends BaseController
{
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->inbox_model = new InboxModel();
        $this->tipe_model = new TipeModel();
        $this->user_model = new UserModel();
        $this->status_model = new StatusModel();
    }

    public function index()
    {
        $query = "status_inbox < 3";

        $builder = $this->inbox_model->builder();
        $builder->join('users', 'users.id_user = inbox.id_user');
        $builder->join('tipe', 'tipe.id_tipe = inbox.tipe_inbox');
        $builder->join('status', 'status.id_status = inbox.status_inbox');
        $builder->where($query);
        $builder->orderBy('tanggal_inbox', 'DESC');
        $datas = $builder->get()->getResult();

        $this->data['status'] = $this->status_model->get()->getResult();
        $this->data['inbox'] = $datas;

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

        $builder = $this->inbox_model->builder();
        $jml_row_submission = (int)$builder->countAllResults();

        $niu = session()->get('niu');

        $id_surat = $niu . '_' . ($jml_row_submission + 1);
        
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
        
        return redirect()->to(site_url('home/pengajuan'))->with('success', 'Surat Berhasil Dikirim')->with('id_surat', $id_surat);
    }

    function download($id)
    {
        $data = $this->inbox_model->find($id);
        $tanggal_file = strtotime($data['tanggal_inbox']);
        $tanggal_file = date('d-m-Y', $tanggal_file);
        $file = WRITEPATH . 'uploads/' . $tanggal_file . '/' . $data['file_inbox'];
        return $this->response->download($file, null);
    }  
}