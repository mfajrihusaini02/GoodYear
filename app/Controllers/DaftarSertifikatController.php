<?php

namespace App\Controllers;

use App\Models\DaftarPenggunaModel;
use App\Models\DaftarSertifikatModel;
use App\Models\DaftarKaryawanModel;

class DaftarSertifikatController extends BaseController
{
    protected $sertifikatModel;
    protected $penggunaModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->sertifikatModel = new DaftarSertifikatModel();
        $this->penggunaModel = new DaftarPenggunaModel();
        $this->karyawanModel = new DaftarKaryawanModel();
    }

    public function index()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['sertifikat'] = $this->sertifikatModel->getJenisSertifikat();
        return view('daftar_sertifikat', $data);
    }

    public function tambah_sertifikat()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        return view('tambah_sertifikat', $data);
    }

    public function simpan_sertifikat()
    {
        // validation input
        if (!$this->validate([
            'kodesertifikat' => [
                'rules' => 'required|numeric|max_length[50]',
                'errors' => [
                    'required' => 'Certificate code cannot be empty',
                    'max_length' => 'Certificate code maximum 50 characters',
                    'numeric' => 'Fill only numeric',
                ],
            ],
            'namasertifikat' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Certificate name cannot be empty',
                    'max_length' => 'Certificate name maximum 100 characters',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $kode_sertifikat = $this->request->getVar('kodesertifikat');
        $nama_sertifikat = $this->request->getVar('namasertifikat');

        $data = [
            'kode_sertifikat' => $kode_sertifikat,
            'nama_sertifikat' => $nama_sertifikat
        ];
        $this->sertifikatModel->save($data);
        return redirect()->to(base_url('daftar_sertifikat'))->with('status', 'CERTIFICATE DATA SAVED SUCCESSFULLY');
    }

    public function edit_sertifikat($id_sertifikat = null)
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['sertifikat'] = $this->sertifikatModel->find($id_sertifikat);
        return view('edit_sertifikat', $data);
    }

    public function update_sertifikat($id_sertifikat = null)
    {
        // validation input
        if (!$this->validate([
            'kodesertifikat' => [
                'rules' => 'permit_empty|numeric|max_length[50]',
                'errors' => [
                    'max_length' => 'Certificate code maximum 50 characters',
                    'numeric' => 'Fill only numeric',
                ],
            ],
            'namasertifikat' => [
                'rules' => 'permit_empty|max_length[100]',
                'errors' => [
                    'max_length' => 'Certificate name maximum 100 characters',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $kode_sertifikat = $this->request->getVar('kodesertifikat');
        if ($kode_sertifikat == null) {
            $namaKodeSertifikat = $this->request->getVar('kodesertifikatLama');
        } else {
            $namaKodeSertifikat = $this->request->getVar('kodesertifikat');
        }

        $nama_sertifikat = $this->request->getVar('namasertifikat');
        if ($nama_sertifikat == null) {
            $namaNamaSertifikat = $this->request->getVar('namasertifikatLama');
        } else {
            $namaNamaSertifikat = $this->request->getVar('namasertifikat');
        }

        $data = [
            'kode_sertifikat' => $namaKodeSertifikat,
            'nama_sertifikat' => $namaNamaSertifikat
        ];

        $this->sertifikatModel->update($id_sertifikat, $data);
        return redirect()->to(base_url('daftar_sertifikat'))->with('status', 'CERTIFICATE DATA SUCCESSFULLY CHANGED');
    }

    public function delete_sertifikat($id_sertifikat = null)
    {
        $this->sertifikatModel->delete($id_sertifikat);
        return redirect()->back()->with('status', 'CERTIFICATE DATA SUCCESSFULLY DELETED');
    }
}
