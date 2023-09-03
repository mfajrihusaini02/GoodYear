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
}
