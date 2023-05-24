<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
    }

    public function login()
    {
        return view('auth/login');
    }
}
