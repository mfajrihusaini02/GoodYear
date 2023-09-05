<?php

namespace App\Controllers;

use App\Models\TambahKaryawanModel;

class TambahKaryawanController extends BaseController
{
    protected $tambahkaryawanModel;

    public function __construct()
    {
        $this->tambahkaryawanModel = new TambahKaryawanModel();    
    }

    public function index()
    {
        $model = new TambahKaryawanModel();
        $data['karyawan'] = $model->getTambahKaryawan();
        return view('tambah_karyawan', $data);
    }
}
