<?php

namespace App\Controllers;

use App\Models\DaftarPenggunaModel;
use App\Models\DaftarRoleModel;
use CodeIgniter\Validation\Validation;

class DaftarRoleController extends BaseController
{
    protected $roleModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->roleModel = new DaftarRoleModel();    
        $this->penggunaModel = new DaftarPenggunaModel();    
    }

    public function index()
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['role'] = $this->roleModel->getRole();
        return view('daftar_role', $data);
    }

    public function tambah_role()
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        return view('tambah_role', $data);
    }

    public function simpan_role()
    {
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
        $this->roleModel->save($data);
        return redirect()->to(base_url('daftar_role'))->with('status', 'Role Berhasil Disimpan');
    }

    public function edit_role($id_role = null)
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['role'] = $this->roleModel->find($id_role);
        return view('edit_role', $data);
    }

    public function update_role($id_role = null)
    {
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
        $this->roleModel->update($id_role, $data);
        return redirect()->to(base_url('daftar_role'))->with('status', 'Role Berhasil Diubah');
    }

    public function delete_role($id_role = null)
    {
        $this->roleModel->delete($id_role);
        return redirect()->back()->with('status', 'Role Berhasil Dihapus');
    }
}
