<?php

namespace App\Controllers;

use App\Models\DaftarSertifikatModel;

class DaftarSertifikatController extends BaseController
{
    protected $sertifikatModel;

    public function __construct()
    {
        $this->sertifikatModel = new DaftarSertifikatModel();    
    }

    public function index()
    {
        $model = new DaftarSertifikatModel();
        $data['sertifikat'] = $model->getSertifikat();
        return view('daftar_sertifikat', $data);
    }

    public function tambah_sertifikat()
    {
        $data = [
            'title' => 'Form Tambah Role'
        ];
        return view('tambah_sertifikat', $data);
    }
    
    public function simpan_sertifikat()
    {
        $simpanModel = new DaftarSertifikatModel();
        $data = [
            'id_karyawan' => $this->request->getPost('id_karyawan'),
            'kode_sertifikat' => $this->request->getPost('kode_sertifikat'),
            'nama_sertifikat' => $this->request->getPost('nama_sertifikat'),
            'tanggal_ambil' => $this->request->getPost('tanggal_ambil'),
            'tanggal_ekspire' => $this->request->getPost('tanggal_ekspire')
        ];
        $simpanModel->save($data);
        return redirect()->to(base_url('daftar_sertifikat'))->with('status', 'Data Sertifikat Berhasil Disimpan');
    }

    public function edit_sertifikat($id_sertifikat = null)
    {
        $editModel = new DaftarSertifikatModel();
        $data['role'] = $editModel->find($id_sertifikat);
        return view('edit_sertifikat', $data);
    }

    public function update_sertifikat($id_sertifikat = null)
    {
        $updateModel = new DaftarSertifikatModel();
        $data = [
            'id_karyawan' => $this->request->getPost('id_karyawan'),
            'kode_sertifikat' => $this->request->getPost('kode_sertifikat'),
            'nama_sertifikat' => $this->request->getPost('nama_sertifikat'),
            'tanggal_ambil' => $this->request->getPost('tanggal_ambil'),
            'tanggal_ekspire' => $this->request->getPost('tanggal_ekspire')
        ];
        $updateModel->update($id_sertifikat, $data);
        return redirect()->to(base_url('daftar_sertifikat'))->with('status', 'Data Sertifikat Berhasil Diupdate');
    }

    public function delete_sertifikat($id_sertifikat = null)
    {
        $deleteModel = new DaftarSertifikatModel();
        $deleteModel->delete($id_sertifikat);
        return redirect()->back()->with('status', 'Data Sertifikat Berhasil Didelete');
    }
}
