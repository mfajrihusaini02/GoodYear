<?php

namespace App\Controllers;

use App\Models\DaftarDivisiModel;
use App\Models\DaftarPenggunaModel;

class DaftarDivisiController extends BaseController
{
    protected $divisiModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->divisiModel = new DaftarDivisiModel();
        $this->penggunaModel = new DaftarPenggunaModel();
    }

    public function index()
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['divisi'] = $this->divisiModel->getDivisi();
        return view('daftar_divisi', $data);
    }

    public function tambah_divisi()
    {
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
                    'required' => 'Nama divisi tidak boleh kosong',
                    'max_length' => 'Nama divisi maksimal 50 karakter',
                    'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
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
        return redirect()->to(base_url('daftar_divisi'))->with('status', 'Divisi Berhasil Disimpan');
    }

    public function edit_divisi($id_divisi = null)
    {
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
                    'max_length' => 'Nama divisi maksimal 50 karakter',
                    'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
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
        return redirect()->to(base_url('daftar_divisi'))->with('status', 'Divisi Berhasil Diubah');
    }

    public function delete_divisi($id_divisi = null)
    {
        $this->divisiModel->delete($id_divisi);
        return redirect()->back()->with('status', 'Divisi Berhasil Dihapus');
    }
}
