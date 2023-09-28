<?php

namespace App\Controllers;

use App\Models\DaftarJabatanModel;
use App\Models\DaftarPenggunaModel;
use App\Models\DaftarKaryawanModel;

class DaftarJabatanController extends BaseController
{
    protected $jabatanModel;
    protected $penggunaModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->jabatanModel = new DaftarJabatanModel();
        $this->penggunaModel = new DaftarPenggunaModel();
        $this->karyawanModel = new DaftarKaryawanModel();
    }

    public function index()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['jabatan'] = $this->jabatanModel->getjabatan();
        return view('daftar_jabatan', $data);
    }

    public function tambah_jabatan()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        return view('tambah_jabatan', $data);
    }

    public function simpan_jabatan()
    {
        // validation input
        if (!$this->validate([
            'nama_jabatan' => [
                'rules' => 'required|alpha_space|max_length[50]',
                'errors' => [
                    'required' => 'Department name cannot be empty',
                    'max_length' => 'Department name maximum 50 characters',
                    'alpha_space' => 'Fill only alphabetic characters and spaces'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $nama_jabatan = $this->request->getVar('nama_jabatan');

        $data = [
            'nama_jabatan' => $nama_jabatan
        ];
        $this->jabatanModel->save($data);
        return redirect()->to(base_url('daftar_jabatan'))->with('status', 'DEPARTMENT SAVED SUCCESSFULLY');
    }

    public function edit_jabatan($id_jabatan = null)
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['jabatan'] = $this->jabatanModel->find($id_jabatan);
        return view('edit_jabatan', $data);
    }

    public function update_jabatan($id_jabatan = null)
    {
        // validation input
        if (!$this->validate([
            'nama_jabatan' => [
                'rules' => 'permit_empty|alpha_space|max_length[50]',
                'errors' => [
                    'max_length' => 'Department name maximum 50 characters',
                    'alpha_space' => 'Fill only alphabetic characters and spaces'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $nama_jabatan = $this->request->getVar('nama_jabatan');
        if ($nama_jabatan == null) {
            $namaJabatan = $this->request->getVar('nama_jabatanLama');
        } else {
            $namaJabatan = $this->request->getVar('nama_jabatan');
        }

        $data = [
            'nama_jabatan' => $namaJabatan
        ];
        $this->jabatanModel->update($id_jabatan, $data);
        return redirect()->to(base_url('daftar_jabatan'))->with('status', 'DEPARTMENT SUCCESSFULLY CHANGED');
    }

    public function delete_jabatan($id_jabatan = null)
    {
        $this->jabatanModel->delete($id_jabatan);
        return redirect()->back()->with('status', 'DEPARTMENT SUCCESSFULLY DELETED');
    }
}
