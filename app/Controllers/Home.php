<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

    public function dashboard(): string
    {
        return view('dashboard');
    }

    public function roles(): string
    {
        return view('roles');
    }

    public function pengguna(): string
    {
        return view('pengguna');
    }
}
