<?php

namespace App\Controllers;

use App\Models\DaftarRoleModel;
use CodeIgniter\Validation\Validation;

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
            'title' => 'Form Tambah Role',
        ];
        return view('tambah_role', $data);
    }

    public function simpan_role()
    {
        $simpanModel = new DaftarRoleModel();

        // validation input
        if(!$this->validate([
            'nama_role' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama role tidak boleh kosong',
                ],
            ],
            'level' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Level tidak boleh kosong',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $data = [
            'nama_role' => $this->request->getPost('nama_role'),
            'level' => $this->request->getPost('level')
        ];
        $simpanModel->save($data);
        return redirect()->to(base_url('daftar_role'))->with('status', 'Role Berhasil Disimpan');
    }

    public function edit_role($id_role = null)
    {
        $editModel = new DaftarRoleModel();
        $data['role'] = $editModel->find($id_role);
        return view('edit_role', $data);
    }

    public function update_role($id_role = null)
    {
        $updateModel = new DaftarRoleModel();

        // validation input
        if(!$this->validate([
            'nama_role' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama role tidak boleh kosong',
                ],
            ],
            'level' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Level tidak boleh kosong',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }
        
        $data = [
            'nama_role' => $this->request->getPost('nama_role'),
            'level' => $this->request->getPost('level')
        ];
        $updateModel->update($id_role, $data);
        return redirect()->to(base_url('daftar_role'))->with('status', 'Role Berhasil Diupdate');
    }

    public function delete_role($id_role = null)
    {
        $deleteModel = new DaftarRoleModel();
        $deleteModel->delete($id_role);
        return redirect()->back()->with('status', 'Role Berhasil Didelete');
    }
}
