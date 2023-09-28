<?php

namespace App\Controllers;

use App\Models\DaftarPenggunaModel;
use App\Models\DaftarRoleModel;
use CodeIgniter\Validation\Validation;
use App\Models\DaftarKaryawanModel;

class DaftarRoleController extends BaseController
{
    protected $roleModel;
    protected $penggunaModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->roleModel = new DaftarRoleModel();
        $this->penggunaModel = new DaftarPenggunaModel();
        $this->karyawanModel = new DaftarKaryawanModel();
    }

    public function index()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['role'] = $this->roleModel->getRole();
        return view('daftar_role', $data);
    }

    public function tambah_role()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        return view('tambah_role', $data);
    }

    public function simpan_role()
    {
        // validation input
        if (!$this->validate([
            'name' => [
                'rules' => 'required|max_length[50]|alpha_space',
                'errors' => [
                    'required' => 'Role name cannot be empty',
                    'max_length' => 'Role name maximum 50 characters',
                    'alpha_space' => 'Fill only alphabetic characters and spaces'
                ],
            ],
            'description' => [
                'rules' => 'required|max_length[50]|alpha_space',
                'errors' => [
                    'required' => 'Description cannot be empty',
                    'max_length' => 'Description maximum 50 characters',
                    'alpha_space' => 'Fill only alphabetic characters and spaces'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');

        $data = [
            'name' => $name,
            'description' => $description
        ];
        $this->roleModel->save($data);
        return redirect()->to(base_url('daftar_role'))->with('status', 'ROLE SAVED SUCCESSFULLY');
    }

    public function edit_role($id_role = null)
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['role'] = $this->roleModel->find($id_role);
        return view('edit_role', $data);
    }

    public function update_role($id_role = null)
    {
        // validation input
        if (!$this->validate([
            'name' => [
                'rules' => 'permit_empty|alpha_space|max_length[50]',
                'errors' => [
                    'max_length' => 'Role name maximum 50 characters',
                    'alpha_space' => 'Fill only alphabetic characters and spaces'
                ],
            ],
            'description' => [
                'rules' => 'permit_empty|alpha_space|max_length[50]',
                'errors' => [
                    'max_length' => 'Description maximum 50 characters',
                    'alpha_space' => 'Fill only alphabetic characters and spaces'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $name = $this->request->getVar('name');
        if ($name == null) {
            $namaRole = $this->request->getVar('nameLama');
        } else {
            $namaRole = $this->request->getVar('name');
        }

        $description = $this->request->getVar('description');
        if ($description == null) {
            $namadescription = $this->request->getVar('descriptionLama');
        } else {
            $namadescription = $this->request->getVar('description');
        }

        $data = [
            'name' => $namaRole,
            'description' => $namadescription
        ];
        $this->roleModel->update($id_role, $data);
        return redirect()->to(base_url('daftar_role'))->with('status', 'ROLE SUCCESSFULLY CHANGED');
    }

    public function delete_role($id_role = null)
    {
        $this->roleModel->delete($id_role);
        return redirect()->back()->with('status', 'ROLE SUCCESSFULLY DELETED');
    }
}
