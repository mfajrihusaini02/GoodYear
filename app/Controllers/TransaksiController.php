<?php

namespace App\Controllers;

use App\Models\TransaksiEditModel;
use App\Models\TransaksiModel;

class TransaksiController extends BaseController
{
    protected $transaksiModel;
    protected $transaksiEditModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->transaksiEditModel = new TransaksiEditModel();
    }

    public function simpan_sertifikatkaryawan()
    {
        // validation input
        if (!$this->validate([
            'id_sertifikat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Certificate not selected',
                ],
            ],
            'tanggal_ambil' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Date of pickup not selected',
                ],
            ],
            'tanggal_ekspire' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Expired date not selected',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $data = [
            'id_karyawan' => $this->request->getVar('id_karyawan'),
            'id_sertifikat' => $this->request->getVar('id_sertifikat'),
            'tanggal_ambil' => $this->request->getVar('tanggal_ambil'),
            'tanggal_ekspire' => $this->request->getVar('tanggal_ekspire'),
        ];

        // dd($data);

        $this->transaksiEditModel->save($data);
        return redirect()->back()->with('status', 'EMPLOYEE CERTIFICATE DATA SUCCESSFULLY SAVED');
    }

    public function delete_sertifikatkaryawan($id_transaksi = null)
    {
        $this->transaksiEditModel->delete($id_transaksi);
        return redirect()->back()->with('status', 'EMPLOYEE CERTIFICATE DATA SUCCESSFULLY DELETED');
    }
}
