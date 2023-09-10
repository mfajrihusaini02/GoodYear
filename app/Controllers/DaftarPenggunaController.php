<?php

namespace App\Controllers;

use App\Models\DaftarPenggunaModel;

class DaftarPenggunaController extends BaseController
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new DaftarPenggunaModel();    
    }

    public function index()
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        return view('daftar_pengguna', $data);
    }

    public function tambah_pengguna()
    {
        $data['level'] = $this->penggunaModel->getLevel();
        $data['karyawan'] = $this->penggunaModel->getKaryawan();
        
        return view('tambah_pengguna', $data);
    }

    public function simpan_pengguna()
    {
        // validation input
        if(!$this->validate([
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Karyawan belum dipilih',
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
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $data = [
            'nik' => $this->request->getPost('nik'),
            'id_role' => $this->request->getPost('id_role'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password_hash'),
            'password_hash' => password_hash($this->request->getVar('password_hash'), PASSWORD_BCRYPT),
            'active' => $this->request->getPost('active'),
            'force_pass_reset' => $this->request->getPost('force_pass_reset'),
            'created_at' => $this->request->getPost('created_at'),
            'updated_at' => $this->request->getPost('updated_at'),
            'deleted_at' => $this->request->getPost('deleted_at')
        ];
        $this->penggunaModel->save($data);
        return redirect()->to(base_url('daftar_pengguna'))->with('status', 'Daftar Pengguna Berhasil Disimpan');
    }

    public function edit_pengguna($id = null)
    {
        $data['users'] = $this->penggunaModel->find($id);
        $data['level'] = $this->penggunaModel->getLevel();
        $data['karyawan'] = $this->penggunaModel->getKaryawan();
        return view('edit_pengguna', $data);
    }

    public function update_pengguna($id_pengguna = null)
    {
        // validation input
        if(!$this->validate([
            'nik' => [
                'rules' => 'required|is_unique',
                'errors' => [
                    'required' => 'Karyawan belum dipilih',
                    'is_unique' => 'Karyawan sudah menjadi pengguna',
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
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }
        
        $data = [
            'nik' => $this->request->getPost('nik'),
            'id_role' => $this->request->getPost('id_role'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password_hash'),
            'password_hash' => password_hash($this->request->getVar('password_hash'), PASSWORD_BCRYPT),
            'active' => $this->request->getPost('active'),
            'force_pass_reset' => $this->request->getPost('force_pass_reset'),
            'created_at' => $this->request->getPost('created_at'),
            'updated_at' => $this->request->getPost('updated_at'),
            'deleted_at' => $this->request->getPost('deleted_at')
        ];
        $this->penggunaModel->update($id_pengguna, $data);
        return redirect()->to(base_url('daftar_pengguna'))->with('status', 'Pengguna Berhasil Diubah');
    }

    public function delete_pengguna($id_pengguna = null)
    {
        $this->penggunaModel->delete($id_pengguna);
        return redirect()->back()->with('status', 'Pengguna Berhasil Dihapus');
    }
}
