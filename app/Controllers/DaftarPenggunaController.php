<?php

namespace App\Controllers;

use App\Models\DaftarPenggunaModel;

class DaftarPenggunaController extends BaseController
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new DaftarPenggunaModel();    
    }

    public function index()
    {
        $model = new DaftarPenggunaModel();
        $data['pengguna'] = $model->getPengguna();
        return view('daftar_pengguna', $data);
    }

    public function tambah_pengguna()
    {
        $data = [
            'title' => 'Form Tambah Pengguna'
        ];
        return view('tambah_pengguna', $data);
    }
}
