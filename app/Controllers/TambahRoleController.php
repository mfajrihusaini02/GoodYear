<?php

namespace App\Controllers;

use App\Models\TambahRoleModel;

class TambahRoleController extends BaseController
{
    protected $tambahroleModel;

    public function __construct()
    {
        $this->tambahroleModel = new TambahRoleModel();    
    }

    public function index()
    {
        $model = new TambahRoleModel();
        $data['role'] = $model->getTambahRole();
        return view('tambah_role', $data);
    }
}
