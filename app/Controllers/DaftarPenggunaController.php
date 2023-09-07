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
        $model = new DaftarPenggunaModel();
        $data['users'] = $model->getPengguna();
        return view('daftar_pengguna', $data);
    }

    public function tambah_pengguna()
    {
        $modelPengguna = new DaftarPenggunaModel();
        $data['level'] = $modelPengguna->getLevel();
        $data['karyawan'] = $modelPengguna->getKaryawan();
        
        return view('tambah_pengguna', $data);
    }

    public function simpan_pengguna()
    {
        $simpanModel = new DaftarPenggunaModel();
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
        $simpanModel->save($data);
        return redirect()->to(base_url('daftar_pengguna'))->with('status', 'Daftar Pengguna Berhasil Disimpan');
    }

    public function edit_pengguna($id = null)
    {
        $editModel = new DaftarPenggunaModel();
        $data['users'] = $editModel->find($id);
        $data['level'] = $editModel->getLevel();
        $data['karyawan'] = $editModel->getKaryawan();
        return view('edit_pengguna', $data);
    }

    public function update_pengguna($id_pengguna = null)
    {
        $updateModel = new DaftarPenggunaModel();
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
        $updateModel->update($id_pengguna, $data);
        return redirect()->to(base_url('daftar_pengguna'))->with('status', 'Pengguna Berhasil Diupdate');
    }

    public function delete_pengguna($id_pengguna = null)
    {
        $deleteModel = new DaftarPenggunaModel();
        $deleteModel->delete($id_pengguna);
        return redirect()->back()->with('status', 'Pengguna Berhasil Didelete');
    }
}
