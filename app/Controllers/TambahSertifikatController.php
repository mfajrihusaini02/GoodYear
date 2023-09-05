<?php

namespace App\Controllers;

use App\Models\TambahSertifikatModel;

class TambahSertifikatController extends BaseController
{
    protected $tambahsertifikatModel;

    public function __construct()
    {
        $this->tambahsertifikatModel = new TambahSertifikatModel();    
    }

    public function index()
    {
        $model = new TambahSertifikatModel();
        $data['sertifikat'] = $model->getTambahSertifikat();
        return view('tambah_sertifikat', $data);
    }
}
