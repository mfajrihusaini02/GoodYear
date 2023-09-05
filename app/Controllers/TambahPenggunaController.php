<?php

namespace App\Controllers;

use App\Models\TambahPenggunaModel;

class TambahPenggunaController extends BaseController
{
    protected $tambahpenggunaModel;

    public function __construct()
    {
        $this->tambahpenggunaModel = new TambahPenggunaModel();    
    }

    public function index()
    {
        $model = new TambahPenggunaModel();
        $data['pengguna'] = $model->getTambahPengguna();
        return view('tambah_pengguna', $data);
    }
}
