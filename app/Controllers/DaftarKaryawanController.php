<?php

namespace App\Controllers;

use App\Models\DaftarKaryawanModel;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class DaftarKaryawanController extends BaseController
{
    protected $karyawanModel;

    public function __construct()
    {
        $this->karyawanModel = new DaftarKaryawanModel();
    }

    public function index()
    {
        $data['karyawanModel'] = $this->karyawanModel->findAll();
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
        $karyawan   = new DaftarKaryawanModel();
        $writer     = new PngWriter();
        $id         = time();
        $nik        = $this->request->getVar('nik');
        $nama       = $this->request->getVar('nama_karyawan');
        $jabatan    = $this->request->getVar('jabatan');
        $divisi     = $this->request->getVar('divisi');
        $alamat     = $this->request->getVar('alamat');
        $foto       = $this->request->getVar('foto');


        $qrCode = QrCode::create(base_url('lihat_karyawan/' . $id))
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $logo = Logo::create('logo.png')
            ->setResizeToWidth(50);

        $label = Label::create($nama)
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);

        $dataUri = $result->getDataUri();

        $data = [
            'nik' => $nik,
            'nama_karyawan' => $nama,
            'jabatan' => $jabatan,
            'divisi' => $divisi,
            'alamat' => $alamat,
            'qr_code' => $dataUri,
            'foto' => $foto
        ];


        $this->karyawanModel->save($data);
        return redirect()->to(base_url('daftar_karyawan'))->with('status', 'Data Karyawan Berhasil Disimpan');
    }

    public function lihat_karyawan($id = null)
    {
        $lihatModel = new DaftarKaryawanModel();
        $data['detail_karyawan'] = $lihatModel->find($id);
        return view('lihat_karyawan', $data);
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
