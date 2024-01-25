<?php

namespace App\Controllers;

use App\Models\DaftarGroupsRoleModel;
use App\Models\DaftarPenggunaModel;
use App\Models\DaftarPenggunaEditModel;
use Myth\Auth\Password;
use App\Models\DaftarKaryawanModel;

class DaftarPenggunaController extends BaseController
{
    protected $penggunaModel;
    protected $penggunaEditModel;
    protected $groupsroleModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->penggunaModel = new DaftarPenggunaModel();
        $this->penggunaEditModel = new DaftarPenggunaEditModel();
        $this->groupsroleModel = new DaftarGroupsRoleModel();
        $this->karyawanModel = new DaftarKaryawanModel();
    }

    public function index()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        return view('daftar_pengguna', $data);
    }

    public function tambah_pengguna()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['id_user'] = $this->penggunaModel->getUsers();
        $data['level'] = $this->penggunaModel->getLevel();
        $data['karyawan'] = $this->penggunaModel->getKaryawan();

        return view('tambah_pengguna', $data);
    }

    public function simpan_pengguna()
    {
        // validation input
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|is_unique[users.nik]',
                'errors' => [
                    'required' => 'Employee not selected',
                    'is_unique' => 'Employee is a previous user',
                ],
            ],
            'id_role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role not seleted',
                ],
            ],
            'email' => [
                'rules' => 'required|valid_emails|max_length[50]',
                'errors' => [
                    'required' => 'Email cannot be empty',
                    'valid_emails' => 'There is no @ element',
                    'max_length' => 'Email maximum 50 characters',
                ],
            ],
            'username' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Username cannot be empty',
                    'max_length' => 'Username maximum 50 characters',
                ],
            ],
            'password_hash' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Username cannot be empty',
                    'max_length' => 'Username maximum 50 characters',
                ],
            ],
            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status not selected',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $id_user            = $this->request->getVar('id_user') + 1;
        $nik                = $this->request->getVar('nik');
        $id_role            = $this->request->getVar('id_role');
        $email              = $this->request->getVar('email');
        $username           = $this->request->getVar('username');
        $password           = $this->request->getVar('password_hash');
        $password_hash      = Password::hash($this->request->getVar('password_hash'));
        $active             = $this->request->getVar('active');
        $force_pass_reset   = $this->request->getVar('force_pass_reset');

        $data = [
            'nik' => $nik,
            'id_role' => $id_role,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'password_hash' => $password_hash,
            'active' => $active,
            'force_pass_reset' => $force_pass_reset
        ];

        $data1 = [
            'group_id' => $id_role,
            'user_id' => $id_user
        ];

        $this->penggunaModel->save($data);
        $this->groupsroleModel->save($data1);
        return redirect()->to(base_url('daftar_pengguna'))->with('status', 'USER DATA SAVED SUCCESSFULLY');
    }

    public function edit_pengguna($id = null)
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['user'] = $this->penggunaModel->getPenggunaPerID($id);
        $data['user'] = $this->penggunaEditModel->where(['nik' => $id])->first();
        $data['level'] = $this->penggunaModel->getLevel();
        $data['karyawan'] = $this->penggunaModel->getKaryawan();
        return view('edit_pengguna', $data);
    }

    public function update_pengguna($id_pengguna = null)
    {
        // validation input
        if (!$this->validate([
            'id_role' => [
                'rules' => 'permit_empty',
                'errors' => [],
            ],
            'email' => [
                'rules' => 'permit_empty|valid_emails|max_length[50]',
                'errors' => [
                    'valid_emails' => 'There is no @ element',
                    'max_length' => 'Email maximum 50 characters',
                ],
            ],
            'username' => [
                'rules' => 'permit_empty|max_length[50]',
                'errors' => [
                    'max_length' => 'Username maximum 50 characters',
                ],
            ],
            'password_hash' => [
                'rules' => 'permit_empty|max_length[50]',
                'errors' => [
                    'max_length' => 'Password maximum 50 characters',
                ],
            ],
            'active' => [
                'rules' => 'permit_empty',
                'errors' => [],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $id_user = $this->request->getVar('id_user');
        $email = $this->request->getVar('email');
        if ($email == null) {
            $namaEmail = $this->request->getVar('emailLama');
        } else {
            $namaEmail = $this->request->getVar('email');
        }

        $username           = $this->request->getVar('username');
        if ($username == null) {
            $namaUsername = $this->request->getVar('usernameLama');
        } else {
            $namaUsername = $this->request->getVar('username');
        }

        $id_role            = $this->request->getVar('id_role');
        if ($id_role == null) {
            $namaIDRole = $this->request->getVar('id_roleLama');
        } else {
            $namaIDRole = $this->request->getVar('id_role');
        }

        $password           = $this->request->getVar('password_hash');
        if ($password == null) {
            $namaPassword = $this->request->getVar('passwordLama');
        } else {
            $namaPassword = $this->request->getVar('password_hash');
        }

        $password_hash      = $this->request->getVar('password_hash');
        if ($password_hash == null) {
            $namaPasswordHash = $this->request->getVar('password_hashLama');
        } else {
            $namaPasswordHash = Password::hash($this->request->getVar('password_hash'));
        }

        $active             = $this->request->getVar('active');
        if ($active == null) {
            $namaActive = $this->request->getVar('activeLama');
        } else {
            $namaActive = $this->request->getVar('active');
        }

        $force_pass_reset   = $this->request->getVar('force_pass_reset');

        $data = [
            'email' => $namaEmail,
            'username' => $namaUsername,
            'id_role' => $namaIDRole,
            'password' => $namaPassword,
            'password_hash' => $namaPasswordHash,
            'active' => $namaActive,
            'force_pass_reset' => $force_pass_reset,
        ];

        $data1 = [
            'group_id' => $namaIDRole,
            'user_id' => $id_user
        ];

        $this->penggunaEditModel->update($id_pengguna, $data);
        return redirect()->to(base_url('daftar_pengguna'))->with('status', 'USER DATA RSUCCESSFULLY CHANGED');
    }

    public function delete_pengguna($id_pengguna = null)
    {
        $this->penggunaEditModel->delete($id_pengguna);
        return redirect()->back()->with('status', 'USER DATA SUCCESSFULLY DELETED');
    }
}
