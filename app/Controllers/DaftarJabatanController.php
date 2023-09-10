<?php

namespace App\Controllers;

use App\Models\DaftarJabatanModel;

class DaftarJabatanController extends BaseController
{
    protected $jabatanModel;

    public function __construct()
    {
        $this->jabatanModel = new DaftarJabatanModel();    
    }

    public function index()
    {
        $data['jabatan'] = $this->jabatanModel->getjabatan();
        return view('daftar_jabatan', $data);
    }

    public function tambah_jabatan()
    {
        $data = [
            'title' => 'Form Tambah Jabatan',
        ];
        return view('tambah_jabatan', $data);
    }

    public function simpan_jabatan()
    {
        // validation input
        if(!$this->validate([
            'nama_jabatan' => [
                'rules' => 'required|alpha_space|max_length[50]',
                'errors' => [
                    'required' => 'Nama jabatan tidak boleh kosong',
                    'max_length' => 'Nama jabatan maksimal 50 karakter',
                    'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $data = [
            'nama_jabatan' => $this->request->getPost('nama_jabatan')
        ];
        $this->jabatanModel->save($data);
        return redirect()->to(base_url('daftar_jabatan'))->with('status', 'Jabatan Berhasil Disimpan');
    }

    public function edit_jabatan($id_jabatan = null)
    {
        $data['role'] = $this->jabatanModel->find($id_jabatan);
        return view('edit_jabatan', $data);
    }

    public function update_jabatan($id_jabatan = null)
    {
        // validation input
        if(!$this->validate([
            'nama_jabatan' => [
                'rules' => 'required|alpha_space|max_length[50]',
                'errors' => [
                    'required' => 'Nama jabatan tidak boleh kosong',
                    'max_length' => 'Nama jabatan maksimal 50 karakter',
                    'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }
        
        $data = [
            'nama_jabatan' => $this->request->getPost('nama_jabatan')
        ];
        $this->jabatanModel->update($id_jabatan, $data);
        return redirect()->to(base_url('daftar_jabatan'))->with('status', 'Jabatan Berhasil Diubah');
    }

    public function delete_jabatan($id_jabatan = null)
    {
        $this->jabatanModel->delete($id_jabatan);
        return redirect()->back()->with('status', 'Jabatan Berhasil Dihapus');
    }
}
