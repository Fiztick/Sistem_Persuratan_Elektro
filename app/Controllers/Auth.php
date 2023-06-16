<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{

    public function __construct()
    {
        // $this->request = \Config\Services::request();
        $this->session = session();
        $this->user_model = new UserModel;
        // $this->data = ['session' => $this->session,'request'=>$this->request];
    }

    public function index()
    {
        return view('auth/login');
    }

    public function proses()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $user = $this->user_model->where('nomor_induk_user', $username)->get()->getRow();

        if(empty($user)) {
            return redirect()->to(site_url('auth'))->with('error', 'Username Tidak Terdaftar');
        } else if(!password_verify($password, $user->password_user)) {
            return redirect()->to(site_url('auth'))->with('error', 'Password salah ');
        } else if ($user->status_user == 0) {
            return redirect()->to(site_url('auth'))->with('error', 'Status User Tidak Aktif Silahkan Hubungi Admin');
        } else {
            $data = [
                'id' => $user->id_user,
                'nama' => $user->nama_user,
                'niu' => $user->nomor_induk_user,
                'jabatan' => $user->jabatan_user,
                'status' => $user->status_user,
                'login' => true,
            ];
            // $this->session->start();
            $this->session->set($data);
            $this->session->markAsTempdata('login', 3600);
            // var_dump($_SESSION);
            // echo $_SESSION['nama'];
            // return view('auth/login');
            return redirect()->to('home');
        }
    }

    public function logout()
    {
        session_destroy();
        // session()->remove(['id', 'nama', 'niu', 'jabatan', 'status', 'login']); // hapus session login dan id
        return redirect()->to(base_url());
    }
}
