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
        $data['sertifikat'] = $this->sertifikatModel->getSertifikat();
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
        // validation input
        if(!$this->validate([
            'kodesertifikat' => [
                'rules' => 'required|numeric|max_length[50]',
                'errors' => [
                    'required' => 'Kode sertifikat tidak boleh kosong',
                    'max_length' => 'Kode sertifikat maksimal 50 karakter',
                    'numeric' => 'Isian harus angka',
                ],
            ],
            'namasertifikat' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama sertifikat tidak boleh kosong',
                    'max_length' => 'Nama sertifikat maksimal 100 karakter',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $data = [
            'kode_sertifikat' => $this->request->getPost('kodesertifikat'),
            'nama_sertifikat' => $this->request->getPost('namasertifikat')
        ];
        $this->sertifikatModel->save($data);
        return redirect()->to(base_url('daftar_sertifikat'))->with('status', 'Data Sertifikat Berhasil Disimpan');
    }

    public function edit_sertifikat($id_sertifikat = null)
    {
        $data['sertifikat'] = $this->sertifikatModel->find($id_sertifikat);
        return view('edit_sertifikat', $data);
    }

    public function update_sertifikat($id_sertifikat = null)
    {
        // validation input
        if(!$this->validate([
            'kodesertifikat' => [
                'rules' => 'required|numeric|max_length[50]',
                'errors' => [
                    'required' => 'Kode sertifikat tidak boleh kosong',
                    'max_length' => 'Kode sertifikat maksimal 50 karakter',
                    'numeric' => 'Isian harus angka',
                ],
            ],
            'namasertifikat' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama sertifikat tidak boleh kosong',
                    'max_length' => 'Nama sertifikat maksimal 100 karakter',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $data = [
            'kode_sertifikat' => $this->request->getPost('kodesertifikat'),
            'nama_sertifikat' => $this->request->getPost('namasertifikat')
        ];

        $this->sertifikatModel->update($id_sertifikat, $data);
        return redirect()->to(base_url('daftar_sertifikat'))->with('status', 'Data Sertifikat Berhasil Diubah');        
    }

    public function delete_sertifikat($id_sertifikat = null)
    {
        $this->sertifikatModel->delete($id_sertifikat);
        return redirect()->back()->with('status', 'Data Sertifikat Berhasil Dihapus');
    }

    public function delete_sertifikatkaryawan($id_sertifikat = null) {
        $this->sertifikatModel->delete($id_sertifikat);
        return redirect()->back()->with('status', 'Data Sertifikat Karyawan Berhasil Dihapus');
    }
}
