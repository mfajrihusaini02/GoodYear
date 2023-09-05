<?php

namespace App\Controllers;

use App\Models\DaftarSertifikatModel;

class DaftarSertifikatController extends BaseController
{
    protected $sertifikatModel;

    public function __construct()
    {
        $this->sertifikatModel = new DaftarSertifikatModel();    
    }

    public function index()
    {
        $model = new DaftarSertifikatModel();
        $data['sertifikat'] = $model->getSertifikat();
        return view('daftar_sertifikat', $data);
    }
}
