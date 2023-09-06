<?php

namespace App\Controllers;

use App\Models\DaftarKaryawanModel;

class DaftarKaryawanController extends BaseController
{
    protected $karyawanModel;

    public function __construct()
    {
        $this->karyawanModel = new DaftarKaryawanModel();    
    }

    public function index()
    {
        $model = new DaftarKaryawanModel();
        $data['karyawan'] = $model->getKaryawan();
        return view('daftar_karyawan', $data);
    }

    public function tambah_karyawan()
    {
        $data = [
            'title' => 'Form Tambah Karyawan'
        ];
        return view('tambah_karyawan', $data);
    }

    public function simpan_karyawan()
    {
        $simpanModel = new DaftarKaryawanModel();
        $data = [
            'nik' => $this->request->getPost('nik'),
            'nama_karyawan' => $this->request->getPost('nama_karyawan'),
            'jabatan' => $this->request->getPost('jabatan'),
            'divisi' => $this->request->getPost('divisi'),
            'alamat' => $this->request->getPost('alamat'),
            'qr_code' => $this->request->getPost('qr_code'),
            'foto' => $this->request->getPost('foto')
        ];
        $simpanModel->save($data);
        return redirect()->to(base_url('daftar_karyawan'))->with('status', 'Data Karyawan Berhasil Disimpan');
    }

    public function edit_karyawan($id_karyawan = null)
    {
        $editModel = new DaftarKaryawanModel();
        $data['karyawan'] = $editModel->find($id_karyawan);
        return view('edit_karyawan', $data);
    }

    public function update_karyawan($id_karyawan = null)
    {
        $updateModel = new DaftarKaryawanModel();
        $data = [
            'nik' => $this->request->getPost('nik'),
            'nama_karyawan' => $this->request->getPost('nama_karyawan'),
            'jabatan' => $this->request->getPost('jabatan'),
            'divisi' => $this->request->getPost('divisi'),
            'alamat' => $this->request->getPost('alamat'),
            'qr_code' => $this->request->getPost('qr_code'),
            'foto' => $this->request->getPost('foto')
        ];
        $updateModel->update($id_karyawan, $data);
        return redirect()->to(base_url('daftar_karyawan'))->with('status', 'Data Karyawan Berhasil Diupdate');
    }

    public function delete_karyawan($id_karyawan = null)
    {
        $deleteModel = new DaftarKaryawanModel();
        $deleteModel->delete($id_karyawan);
        return redirect()->back()->with('status', 'Data Karyawan Berhasil Didelete');
    }
}
