<?php

namespace App\Controllers;

use App\Models\DaftarKaryawanModel;

class DaftarKaryawanController extends BaseController
{
    protected $karyawanModel;

    public function __construct()
    {
        $this->karyawanModel = new DaftarKaryawanModel();    
    }

    public function index()
    {
        $model = new DaftarKaryawanModel();
        $data['karyawan'] = $model->getKaryawan();
        return view('daftar_karyawan', $data);
    }

    public function tambah_karyawan()
    {
        $data = [
            'title' => 'Form Tambah Karyawan'
        ];
        return view('tambah_karyawan', $data);
    }
}
