<?php

namespace App\Controllers;

use App\Models\DaftarPenggunaModel;

class Home extends BaseController
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new DaftarPenggunaModel();    
    }

    public function index()
    {
        return view('login');
    }

    public function dashboard(): string
    {
        return view('dashboard');
    }
}
