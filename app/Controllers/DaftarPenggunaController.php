<?php

namespace App\Controllers;

use App\Models\DaftarPenggunaModel;
use App\Models\DaftarPenggunaEditModel;
use Myth\Auth\Password;

class DaftarPenggunaController extends BaseController
{
    protected $penggunaModel;
    protected $penggunaEditModel;

    public function __construct()
    {
        $this->penggunaModel = new DaftarPenggunaModel();
        $this->penggunaEditModel = new DaftarPenggunaEditModel();
    }

    public function index()
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        return view('daftar_pengguna', $data);
    }

    public function tambah_pengguna()
    {
        $data['users'] = $this->penggunaModel->getPengguna();
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
                    'required' => 'Karyawan belum dipilih',
                    'is_unique' => 'Karyawan sudah menjadi pengguna sebelumnya',
                ],
            ],
            'id_role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level belum dipilih',
                ],
            ],
            'email' => [
                'rules' => 'required|valid_emails|max_length[50]',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_emails' => 'Tidak ada mengandung unsur @',
                    'max_length' => 'Email maksimal 50 karakter',
                ],
            ],
            'username' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'max_length' => 'Username maksimal 50 karakter',
                ],
            ],
            'password_hash' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'max_length' => 'Password maksimal 50 karakter',
                ],
            ],
            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status belum dipilih',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $nik                = $this->request->getVar('nik');
        $id_role            = $this->request->getVar('id_role');
        $email              = $this->request->getVar('email');
        $username           = $this->request->getVar('username');
        $password           = $this->request->getVar('password_hash');
        $password_hash      = Password::hash($this->request->getVar('password_hash'));
        $active             = $this->request->getVar('active');
        $force_pass_reset   = $this->request->getVar('force_pass_reset');
        $created_at         = $this->request->getVar('created_at');
        $updated_at         = $this->request->getVar('updated_at');
        $deleted_at         = $this->request->getVar('deleted_at');

        $data = [
            'nik' => $nik,
            'id_role' => $id_role,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'password_hash' => $password_hash,
            'active' => $active,
            'force_pass_reset' => $force_pass_reset,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'deleted_at' => $deleted_at
        ];
        $this->penggunaModel->save($data);
        return redirect()->to(base_url('daftar_pengguna'))->with('status', 'Daftar Pengguna Berhasil Disimpan');
    }

    public function edit_pengguna($id = null)
    {
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
                    'valid_emails' => 'Tidak ada mengandung unsur @',
                    'max_length' => 'Email maksimal 50 karakter',
                ],
            ],
            'username' => [
                'rules' => 'permit_empty|max_length[50]',
                'errors' => [
                    'max_length' => 'Username maksimal 50 karakter',
                ],
            ],
            'password_hash' => [
                'rules' => 'permit_empty|max_length[50]',
                'errors' => [
                    'max_length' => 'Password maksimal 50 karakter',
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

        $password_hash      = Password::hash($this->request->getVar('password_hash'));
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
        $created_at         = $this->request->getVar('created_at');
        $updated_at         = $this->request->getVar('updated_at');
        $deleted_at         = $this->request->getVar('deleted_at');

        $data = [
            'email' => $namaEmail,
            'username' => $namaUsername,
            'id_role' => $namaIDRole,
            'password' => $namaPassword,
            'password_hash' => $namaPasswordHash,
            'active' => $namaActive,
            'force_pass_reset' => $force_pass_reset,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'deleted_at' => $deleted_at
        ];
        $this->penggunaEditModel->update($id_pengguna, $data);
        return redirect()->to(base_url('daftar_pengguna'))->with('status', 'Pengguna Berhasil Diubah');
    }

    public function delete_pengguna($id_pengguna = null)
    {
        $this->penggunaEditModel->delete($id_pengguna);
        return redirect()->back()->with('status', 'Pengguna Berhasil Dihapus');
    }
}
