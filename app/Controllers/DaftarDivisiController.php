<?php

namespace App\Controllers;

use App\Models\DaftarDivisiModel;

class DaftarDivisiController extends BaseController
{
    protected $divisiModel;

    public function __construct()
    {
        $this->divisiModel = new DaftarDivisiModel();    
    }

    public function index()
    {
        $model = new DaftarDivisiModel();
        $data['divisi'] = $model->getDivisi();
        return view('daftar_divisi', $data);
    }

    public function tambah_divisi()
    {
        $data = [
            'title' => 'Form Tambah Divisi',
        ];
        return view('tambah_divisi', $data);
    }

    public function simpan_divisi()
    {
        $simpanModel = new DaftarDivisiModel();

        // validation input
        if(!$this->validate([
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
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $data = [
            'nama_divisi' => $this->request->getPost('nama_divisi')
        ];
        $simpanModel->save($data);
        return redirect()->to(base_url('daftar_divisi'))->with('status', 'Divisi Berhasil Disimpan');
    }

    public function edit_divisi($id_divisi = null)
    {
        $editModel = new DaftarDivisiModel();
        $data['role'] = $editModel->find($id_divisi);
        return view('edit_divisi', $data);
    }

    public function update_divisi($id_divisi = null)
    {
        $updateModel = new DaftarDivisiModel();

        // validation input
        if(!$this->validate([
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
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }
        
        $data = [
            'nama_divisi' => $this->request->getPost('nama_divisi')
        ];
        $updateModel->update($id_divisi, $data);
        return redirect()->to(base_url('daftar_divisi'))->with('status', 'Divisi Berhasil Diupdate');
    }

    public function delete_divisi($id_divisi = null)
    {
        $deleteModel = new DaftarDivisiModel();
        $deleteModel->delete($id_divisi);
        return redirect()->back()->with('status', 'Divisi Berhasil Didelete');
    }
}
