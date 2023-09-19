<?php

namespace App\Controllers;

use App\Models\DaftarKaryawanModel;
use App\Models\DaftarJabatanModel;
use App\Models\DaftarDivisiModel;
use App\Models\DaftarPenggunaModel;
use App\Models\DaftarSertifikatModel;
use App\Models\TransaksiModel;
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
    protected $jabatanModel;
    protected $divisiModel;
    protected $sertifikatModel;
    protected $transaksiModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->karyawanModel = new DaftarKaryawanModel();
        $this->jabatanModel = new DaftarJabatanModel();
        $this->divisiModel = new DaftarDivisiModel();
        $this->sertifikatModel = new DaftarSertifikatModel();
        $this->penggunaModel = new DaftarPenggunaModel();
    }

    public function index()
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['karyawan'] = $this->karyawanModel->getKaryawan();
        return view('daftar_karyawan', $data);
    }

    public function index_karyawan()
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['karyawan'] = $this->karyawanModel->getKaryawan();
        return view('karyawan', $data);
    }

    public function tambah_karyawan()
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['jabatan'] = $this->jabatanModel->findAll();
        $data['divisi'] = $this->divisiModel->findAll();
        return view('tambah_karyawan', $data);
    }

    public function simpan_karyawan()
    {
        // validation input
        if (!$this->validate([
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
            ],
            'foto' => [
                'rules' => 'max_size[foto, 1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Foto tidak boleh besar dari 1 MB',
                    'is_image' => 'File harus berupa gambar',
                    'mime_in' => 'File harus berupa gambar',
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $writer     = new PngWriter();
        $id         = time();
        $nama       = $this->request->getVar('nama_karyawan');

        $qrCode = QrCode::create(base_url('lihat_karyawan/' . $id))
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $logo = Logo::create('logo.png')
            ->setResizeToWidth(150);

        $label = Label::create($nama)
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);

        $dataUri = $result->getDataUri();

        // ambil foto
        $fileFoto = $this->request->getFile('foto');
        // pindahkan file ke folder img
        $fileFoto->move('img');
        // ambil nama file foto
        $namaFoto = $fileFoto->getRandomName();

        $data = [
            'nik' => $this->request->getVar('nik'),
            'nama_karyawan' => $nama,
            'id_jabatan' => $this->request->getVar('jabatan'),
            'id_divisi' => $this->request->getVar('divisi'),
            'alamat' => $this->request->getVar('alamat'),
            'qr_code' => $dataUri,
            'foto' => $namaFoto,
        ];

        // dd($data);

        $this->karyawanModel->save($data);
        return redirect()->to(base_url('daftar_karyawan'))->with('status', 'Data Karyawan Berhasil Disimpan');
    }

    public function lihat_karyawan($id_karyawan = null)
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['jabatan'] = $this->jabatanModel->findAll();
        $data['transaksi'] = $this->transaksiModel->getTransaksi();
        $data['transaksi'] = $this->transaksiModel->getJenisTransaksi();
        $data['transaksi'] = $this->transaksiModel->getSertifikatPerID($id_karyawan);
        $data['detail_karyawan'] = $this->karyawanModel->find($id_karyawan);
        return view('lihat_karyawan', $data);
    }

    public function edit_karyawan($id_karyawan = null)
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['transaksi'] = $this->transaksiModel->getTransaksi();
        $data['transaksi'] = $this->transaksiModel->getJenisTransaksi();
        $data['transaksi'] = $this->transaksiModel->getSertifikatPerID($id_karyawan);
        $data['sertifikat'] = $this->sertifikatModel->getJenisSertifikat();
        $data['jenissertifikat'] = $this->sertifikatModel->getJenisSertifikat();
        $data['karyawan'] = $this->karyawanModel->find($id_karyawan);
        $data['jabatan'] = $this->jabatanModel->findAll();
        $data['divisi'] = $this->divisiModel->findAll();
        return view('edit_karyawan', $data);
    }

    public function edit_karyawandisable($id_karyawan = null)
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['transaksi'] = $this->transaksiModel->getTransaksi();
        $data['transaksi'] = $this->transaksiModel->getJenisTransaksi();
        $data['transaksi'] = $this->transaksiModel->getSertifikatPerID($id_karyawan);
        $data['sertifikat'] = $this->sertifikatModel->getJenisSertifikat();
        $data['jenissertifikat'] = $this->sertifikatModel->getJenisSertifikat();
        $data['karyawan'] = $this->karyawanModel->find($id_karyawan);
        $data['jabatan'] = $this->jabatanModel->findAll();
        $data['divisi'] = $this->divisiModel->findAll();
        return view('edit_karyawandisable', $data);
    }

    public function update_karyawan($id_karyawan = null)
    {
        // validation input
        if (!$this->validate([
            // 'nik' => [
            //     'rules' => 'required|numeric|max_length[16]|min_length[16]',
            //     'errors' => [
            //         'required' => 'NIK tidak boleh kosong',
            //         'max_length' => 'NIK harus 16 karakter',
            //         'min_length' => 'NIK harus 16 karakter',
            //         'numeric' => 'Isian harus angka',
            //     ],
            // ],
            // 'nama_karyawan' => [
            //     'rules' => 'required|alpha_space|max_length[100]',
            //     'errors' => [
            //         'required' => 'Nama karyawan tidak boleh kosong',
            //         'max_length' => 'Nama karyawan maximal 100 karakter',
            //         'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
            //     ],
            // ],
            // 'jabatan' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Jabatan belum dipilih',
            //     ],
            // ],
            // 'divisi' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Divisi belum dipilih',
            //     ],
            // ],
            // 'alamat' => [
            //     'rules' => 'required|max_length[100]',
            //     'errors' => [
            //         'required' => 'Alamat tidak boleh kosong',
            //         'max_length' => 'Alamat maximal 100 karakter',
            //     ],
            // ],
            'foto' => [
                'rules' => 'max_size[foto, 1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Foto tidak boleh besar dari 1 MB',
                    'is_image' => 'File harus berupa gambar',
                    'mime_in' => 'File harus berupa gambar',
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $writer     = new PngWriter();
        $id         = time();

        //nik
        $nik = $this->request->getVar('nik');
        if ($nik == null) {
            $namaNik = $this->request->getVar('nikLama');
        } else {
            $namaNik = $this->request->getVar('nik');
        }

        //nama karyawan
        $nama = $this->request->getVar('nama_karyawan');
        if ($nama == null) {
            $namaKaryawan = $this->request->getVar('nama_karyawanLama');
        } else {
            $namaKaryawan = $this->request->getVar('nama_karyawan');
        }

        // jabatan
        $jabatan = $this->request->getVar('jabatan');
        if ($jabatan == null) {
            $namaJabatan = $this->request->getVar('jabatanLama');
        } else {
            $namaJabatan = $this->request->getVar('jabatan');
        }

        //divisi
        $divisi = $this->request->getVar('divisi');
        if ($divisi == null) {
            $namaDivisi = $this->request->getVar('divisiLama');
        } else {
            $namaDivisi = $this->request->getVar('divisi');
        }

        //alamat
        $alamat = $this->request->getVar('alamat');
        if ($alamat == null) {
            $namaAlamat = $this->request->getVar('alamatLama');
        } else {
            $namaAlamat = $this->request->getVar('alamat');
        }

        // foto
        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } else {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('img', $namaFoto);
            unlink('img/' . $this->request->getVar('fotoLama'));
        }

        $qrCode = QrCode::create(base_url('lihat_karyawan/' . $id))
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $logo = Logo::create('logo.png')
            ->setResizeToWidth(150);

        $label = Label::create($namaKaryawan)
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);

        $dataUri = $result->getDataUri();

        $data = [
            'nik' => $namaNik,
            'nama_karyawan' => $namaKaryawan,
            'id_jabatan' => $namaJabatan,
            'id_divisi' => $namaDivisi,
            'alamat' => $namaAlamat,
            'qr_code' => $dataUri,
            'foto' => $namaFoto,
        ];

        $this->karyawanModel->update($id_karyawan, $data);
        // dd($data);
        return redirect()->to(base_url('daftar_karyawan'))->with('status', 'Data Karyawan Berhasil Diubah');
    }

    public function delete_karyawan($id_karyawan = null)
    {
        $this->karyawanModel->delete($id_karyawan);
        return redirect()->back()->with('status', 'Data Karyawan Berhasil Dihapus');
    }
}
