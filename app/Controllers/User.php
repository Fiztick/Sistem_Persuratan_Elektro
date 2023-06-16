<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        // $this->request = \Config\Services::request();
        // $this->session = session();
        $this->user_model = new UserModel;
        // $this->data = ['session' => $this->session,'request'=>$this->request];
    }

    public function index()
    {        
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->user_model->countAllResults();
        $this->data['users'] = $this->user_model->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['users'])? count($this->data['users']) : 0;
        $this->data['pager'] = $this->user_model->pager;

        return view('users/get', $this->data);
    }

    public function create() 
    {
        return view('users/add');
    }

    public function store()
    {
        $niu = $this->request->getVar('nomor_induk_user');
        
        if (strlen($niu) < 10) {
            return redirect()->to(site_url('user/add'))->with('error', 'Format nomor induk harus lebih besar dari 10');
        } elseif (strlen($niu) > 20) {
            return redirect()->to(site_url('user/add'))->with('error', 'Format nomor induk harus lebih kecil dari 20');
        } else {
            $data = [
                'nama_user' => $this->request->getVar('nama_user'),
                'nomor_induk_user' => $niu,
                'password_user' => password_hash($this->request->getVar('nomor_induk_user'), PASSWORD_BCRYPT),
                'jabatan_user' => $this->request->getVar('jabatan_user'),
            ];

            $this->db->table('users')->insert($data);

            if($this->db->affectedRows() > 0) {
                return redirect()->to(site_url('user'))->with('success', 'Data Berhasil Ditambahkan');
            }
        }
    }

    public function edit($id = null)
    {
        if(!empty($id)) {
            $query = $this->user_model->find($id);
            if($this->user_model->countAllResults() > 0) {
                $this->data['user'] = $query;
                return view('users/edit', $this->data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundExecption::forPageNotFound();
            }
        } else {
            return redirect()->to('user');
        }
    }

    public function updateStatus($id = null)
    {
        if(!empty($id)) {
            if($this->user_model->countAllResults() > 0) {
                $data = ['status_user' => $this->request->getVar('status_user'),];
                
                $update = $this->user_model->where('id_user',$id)->set($data)->update();
                if($update) {
                    return redirect()->to(site_url('user'))->with('success', 'Status Berhasil Diupdate');  
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundExecption::forPageNotFound();
            }
        } else {
            return redirect()->to('user');
        }
    }

    public function update($id)
    {
        $c_password = $this->request->getVar('c_password_user');
        $password = $this->request->getVar('password_user');

        if($c_password == $password) {
            $data = [
                'nama_user' => $this->request->getVar('nama_user'),
                'nomor_induk_user' => $this->request->getVar('nomor_induk_user'),
                'password_user' => password_hash($password, PASSWORD_BCRYPT),
                'jabatan_user' => $this->request->getVar('jabatan_user'),
            ];
    
            $this->user_model->where('id_user',$id)->set($data)->update();
            return redirect()->to(site_url('user'))->with('success', 'Data Berhasil Diupdate');
        } else {
            return redirect()->to(site_url('user/edit/'.$id))->with('error', 'Password dan Confirm Password Tidak Sama');
        }
    }

    public function destroy($id) {
        $this->user_model->delete($id);
        return redirect()->to(site_url('user'))->with('success', 'Data Berhasil Dihapus');
    }

    public function settings($id) {
        $query = $this->user_model->find($id);
        $this->data['user'] = $query;
                
        return view('users/settings', $this->data);
    }
}