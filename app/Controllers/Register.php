<?php

namespace App\Controllers;
use App\Models\UserModel;

class Register extends BaseController
{
    public function __construct()
    {
        $this->user_model = new UserModel;
    }

    public function index()
    {
        return view('auth/register');
    }

    public function proses()
    {
        $rules = [
            'nama' => 'required',
            'niu' => 'required',
            'email' => 'required',
            'password' => 'required|min_length[8]',
            'cpassword' => 'required|min_length[8]',
            'jabatan' => 'required',
        ];

        if (! $this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->to(site_url('register'))->withInput()->with('error', $validation->listErrors());
        }

        $nama = $this->request->getVar('nama');
        $niu = $this->request->getVar('niu');   
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $cpassword = $this->request->getVar('cpassword');
        $jabatan = $this->request->getVar('jabatan');

        $user = $this->user_model->where('nomor_induk_user', $niu)->get()->getRow();

        $data = [
            'nama_user' => $nama,
            'nomor_induk_user' => $niu,
            'email_user' => $email,
            'id_role' => $jabatan,
        ];

        if($password != $cpassword) {
            return redirect()->to(site_url('register'))->with('error', 'Password Tidak Sama')->with('data', $data);
        } else if(!empty($user) && !empty($user->nomor_induk_user)) {
            return redirect()->to(site_url('register'))->with('error', 'Nomor Induk User sudah Terdaftar')->with('data', $data);
        } else {
            $data['password_user'] = password_hash($password, PASSWORD_BCRYPT);
            
            $query = $this->user_model->insert($data);
            
            if($query) {
                return redirect()->to(site_url())->with('success', 'Akun berhasil dibuat');
            } else {
                return redirect()->to(site_url())->with('error', 'Akun gagal dibuat');
            }
        }
    }
}
