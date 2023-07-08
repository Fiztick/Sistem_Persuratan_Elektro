<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\RoleModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->user_model = new UserModel;
        $this->role_model = new RoleModel;
    }

    public function index()
    {        
        $builder = $this->user_model->builder();
        $builder->join('roles', 'roles.id_role = users.id_role');
        $datas = $builder->get()->getResult();

        $this->data['users'] = $datas;

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
                'email_user' => $this->request->getVar('email_user'),
                'password_user' => password_hash($this->request->getVar('nomor_induk_user'), PASSWORD_BCRYPT),
                'id_role' => $this->request->getVar('id_role'),
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
                'id_role' => $this->request->getVar('id_role'),
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
}