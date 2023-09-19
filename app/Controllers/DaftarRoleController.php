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
        if (!$this->validate([
            'nama_role' => [
                'rules' => 'required|max_length[50]|alpha_space',
                'errors' => [
                    'required' => 'Nama role tidak boleh kosong',
                    'max_length' => 'Nama role maksimal 50 karakter',
                    'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
                ],
            ],
            'level' => [
                'rules' => 'required|max_length[50]|alpha_space',
                'errors' => [
                    'required' => 'Level tidak boleh kosong',
                    'max_length' => 'Level maksimal 50 karakter',
                    'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $nama_role = $this->request->getVar('nama_role');
        $level = $this->request->getVar('level');

        $data = [
            'nama_role' => $nama_role,
            'level' => $level
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
        if (!$this->validate([
            'nama_role' => [
                'rules' => 'permit_empty|alpha_space|max_length[50]',
                'errors' => [
                    'max_length' => 'Nama role maksimal 50 karakter',
                    'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
                ],
            ],
            'level' => [
                'rules' => 'permit_empty|alpha_space|max_length[50]',
                'errors' => [
                    'max_length' => 'Level maksimal 50 karakter',
                    'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $nama_role = $this->request->getVar('nama_role');
        if ($nama_role == null) {
            $namaRole = $this->request->getVar('nama_roleLama');
        } else {
            $namaRole = $this->request->getVar('nama_role');
        }

        $level = $this->request->getVar('level');
        if ($level == null) {
            $namaLevel = $this->request->getVar('levelLama');
        } else {
            $namaLevel = $this->request->getVar('level');
        }

        $data = [
            'nama_role' => $namaRole,
            'level' => $namaLevel
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
