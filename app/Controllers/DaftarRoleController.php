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
            'nama_role' => $this->request->getVar('nama_role'),
            'level' => $this->request->getVar('level')
        ]);
        return redirect()->to('daftar_role');
    }

    public function edit_role($id_role)
    {
        // ambil artikel yang akan diedit
        $news = new DaftarRoleModel();
        $data['news'] = $news->where('id_role', $id_role)->first();
        
        // lakukan validasi data artikel
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_role' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // jika data vlid, maka simpan ke database
        if($isDataValid){
            $news->update($id_role, [
                "nama_role" => $this->request->getPost('nama_role'),
                "level" => $this->request->getPost('level')
            ]);
            return redirect('daftar_role');
        }

        // tampilkan form edit
        echo view('edit_role', $data);
    }
}
