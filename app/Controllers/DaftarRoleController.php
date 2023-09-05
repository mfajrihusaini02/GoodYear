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

    public function tambah_role()
    {
        $data = [
            'title' => 'Form Tambah Role'
        ];
        return view('tambah_role', $data);
    }

    public function save_role()
    {
        $this->roleModel->save_role([
            'namarole' => $this->request->getVar('nama_role'),
            'level_role' => $this->request->getVar('level')
        ]);
        return redirect()->to('daftar_role');
    }
}
