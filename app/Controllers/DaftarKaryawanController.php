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
        $model = new DaftarKaryawanModel();
        $data['karyawan'] = $model->getKaryawan();
        return view('daftar_karyawan', $data);
    }

    public function tambah_karyawan()
    {
        $modelPengguna = new DaftarKaryawanModel();
        $data['jabatan'] = $modelPengguna->getJabatan();
        $data['divisi'] = $modelPengguna->getDivisi();
        return view('tambah_karyawan', $data);
    }

    public function simpan_karyawan()
    {
        $karyawan   = new DaftarKaryawanModel();

        // validation input
        if(!$this->validate([
            'nik' => [
                'rules' => 'required|numeric|max_length[16]|min_length[16]',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong',
                    'max_length' => 'NIK harus 16 karakter',
                    'min_length' => 'NIK harus 16 karakter',
                    'numeric' => 'Isian harus angka',
                ],
            ],
            'nama_karyawan' => [
                'rules' => 'required|alpha_space|max_length[100]',
                'errors' => [
                    'required' => 'Nama karyawan tidak boleh kosong',
                    'max_length' => 'Nama karyawan maximal 100 karakter',
                    'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
                ],
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan belum dipilih',
                ],
            ],
            'divisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Divisi belum dipilih',
                ],
            ],
            'alamat' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                    'max_length' => 'Alamat maximal 100 karakter',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $writer     = new PngWriter();
        $id         = time();
        $nik        = $this->request->getVar('nik');
        $nama       = $this->request->getVar('nama_karyawan');
        $jabatan    = $this->request->getVar('jabatan');
        $divisi     = $this->request->getVar('divisi');
        $alamat     = $this->request->getVar('alamat');
        $foto       = $this->request->getFile('foto');
        

        $qrCode = QrCode::create(base_url('lihat_karyawan/' . $id))
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $logo = Logo::create('logo.png')
            ->setResizeToWidth(250);

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
        $data['jabatan'] = $editModel->getJabatan();
        $data['divisi'] = $editModel->getDivisi();
        return view('edit_karyawan', $data);
    }

    public function update_karyawan($id_karyawan = null)
    {
        $updateModel = new DaftarKaryawanModel();

        // validation input
        if(!$this->validate([
            'nik' => [
                'rules' => 'required|numeric|max_length[16]|min_length[16]',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong',
                    'max_length' => 'NIK harus 16 karakter',
                    'min_length' => 'NIK harus 16 karakter',
                    'numeric' => 'Isian harus angka',
                ],
            ],
            'nama_karyawan' => [
                'rules' => 'required|alpha_space|max_length[100]',
                'errors' => [
                    'required' => 'Nama karyawan tidak boleh kosong',
                    'max_length' => 'Nama karyawan maximal 100 karakter',
                    'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
                ],
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan belum dipilih',
                ],
            ],
            'divisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Divisi belum dipilih',
                ],
            ],
            'alamat' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                    'max_length' => 'Alamat maximal 100 karakter',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $writer     = new PngWriter();
        $id         = time();
        $nik        = $this->request->getVar('nik');
        $nama       = $this->request->getVar('nama_karyawan');
        $jabatan    = $this->request->getPost('jabatan');
        $divisi     = $this->request->getPost('divisi');
        $alamat     = $this->request->getVar('alamat');
        $foto       = $this->request->getFile('foto');
        

        $qrCode = QrCode::create(base_url('lihat_karyawan/' . $id))
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $logo = Logo::create('logo.png')
            ->setResizeToWidth(250);

        $label = Label::create($nama)
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);

        $dataUri = $result->getDataUri();

        $data = [
            'nik' => $nik,
            'nama_karyawan' => $nama,
            'id_jabatan' => $jabatan,
            'id_divisi' => $divisi,
            'alamat' => $alamat,
            'qr_code' => $dataUri,
            'foto' => $foto
        ];

        $updateModel->update($id_karyawan, $data);
        // dd($data);
        return redirect()->to(base_url('daftar_karyawan'))->with('status', 'Data Karyawan Berhasil Diupdate');
    }

    public function delete_karyawan($id_karyawan = null)
    {
        $deleteModel = new DaftarKaryawanModel();
        $deleteModel->delete($id_karyawan);
        return redirect()->back()->with('status', 'Data Karyawan Berhasil Didelete');
    }
}
