<?php

namespace App\Controllers;

use App\Models\DaftarKaryawanModel;
use App\Models\DaftarPenggunaModel;

class Home extends BaseController
{
    protected $penggunaModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->penggunaModel = new DaftarPenggunaModel();
        $this->karyawanModel = new DaftarKaryawanModel();
    }

    public function index()
    {
        return view('login');
    }

    public function dashboard()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['karyawan'] = $this->karyawanModel->getKaryawan();
        $data['users'] = $this->penggunaModel->getPengguna();
        // dd($data);
        return view('dashboard', $data);
    }
}
