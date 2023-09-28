<?php

namespace App\Controllers;

use App\Models\DaftarDivisiModel;
use App\Models\DaftarPenggunaModel;
use App\Models\DaftarKaryawanModel;

class DaftarDivisiController extends BaseController
{
    protected $divisiModel;
    protected $penggunaModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->divisiModel = new DaftarDivisiModel();
        $this->penggunaModel = new DaftarPenggunaModel();
        $this->karyawanModel = new DaftarKaryawanModel();
    }

    public function index()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['divisi'] = $this->divisiModel->getDivisi();
        return view('daftar_divisi', $data);
    }

    public function tambah_divisi()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        return view('tambah_divisi', $data);
    }

    public function simpan_divisi()
    {
        // validation input
        if (!$this->validate([
            'nama_divisi' => [
                'rules' => 'required|alpha_space|max_length[50]',
                'errors' => [
                    'required' => 'Division name cannot be empty',
                    'max_length' => 'Division name maximum 50 characters',
                    'alpha_space' => 'Fill only alphabetic characters and spaces'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $nama_divisi = $this->request->getVar('nama_divisi');

        $data = [
            'nama_divisi' => $nama_divisi
        ];
        $this->divisiModel->save($data);
        return redirect()->to(base_url('daftar_divisi'))->with('status', 'DIVISION SAVED SUCCESSFULLY');
    }

    public function edit_divisi($id_divisi = null)
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['divisi'] = $this->divisiModel->find($id_divisi);
        return view('edit_divisi', $data);
    }

    public function update_divisi($id_divisi = null)
    {
        // validation input
        if (!$this->validate([
            'nama_divisi' => [
                'rules' => 'permit_empty|alpha_space|max_length[50]',
                'errors' => [
                    'max_length' => 'Division name maximum 50 characters',
                    'alpha_space' => 'Fill only alphabetic characters and spaces'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $nama_divisi = $this->request->getVar('nama_divisi');
        if ($nama_divisi == null) {
            $namaDivisi = $this->request->getVar('nama_divisiLama');
        } else {
            $namaDivisi = $this->request->getVar('nama_divisi');
        }

        $data = [
            'nama_divisi' => $namaDivisi
        ];
        $this->divisiModel->update($id_divisi, $data);
        return redirect()->to(base_url('daftar_divisi'))->with('status', 'DIVISION SUCCESSFULLY CHANGED');
    }

    public function delete_divisi($id_divisi = null)
    {
        $this->divisiModel->delete($id_divisi);
        return redirect()->back()->with('status', 'DIVISION SUCCESSFULLY DELETED');
    }
}
