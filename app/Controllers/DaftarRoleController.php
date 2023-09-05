<?php

namespace App\Controllers;

use App\Models\DaftarRoleModel;

class DaftarRoleController extends BaseController
{
    protected $roleModel;

    public function __construct()
    {
        $this->roleModel = new DaftarRoleModel();    
    }

    public function index()
    {
        $model = new DaftarRoleModel();
        $data['role'] = $model->getRole();
        return view('daftar_role', $data);
    }
}
