<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

class Settings extends BaseController
{
    public function __construct()
    {
        $this->user_model = new UserModel;
        $this->role_model = new RoleModel;
    }

    public function index()
    {
        $id = session()->get('id');
        $user = $this->user_model->find($id);
        
        $role_id = $user['id_role'];
        $role = $this->role_model->find($role_id);
        $user['role_user'] = $role['nama_role'];

        $this->data['user'] = $user;

        return view('users/settings', $this->data);
    }

    public function update($id)
    {
        $rules = [
            'password_user' => 'required|min_length[8]',
            'c_password_user' => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->to(site_url('settings'))->withInput()->with('error', $validation->listErrors());
        }

        $c_password = $this->request->getVar('c_password_user');
        $password = $this->request->getVar('password_user');

        if($c_password == $password) {
            $data = [
                'password_user' => password_hash($password, PASSWORD_BCRYPT),
            ];
    
            $this->user_model->where('id_user',$id)->set($data)->update();
            return redirect()->to(site_url('settings'))->with('success', 'Password Berhasil Diupdate');
        } else {
            return redirect()->to(site_url('settings'))->with('error', 'Password dan Confirm Password Tidak Sama');
        }
    }
}
