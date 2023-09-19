<?php

namespace App\Controllers;

use App\Models\DaftarKaryawanModel;
use App\Models\DaftarKaryawanEditModel;
use App\Models\DaftarJabatanModel;
use App\Models\DaftarDivisiModel;
use App\Models\DaftarPenggunaModel;
use App\Models\DaftarPenggunaEditModel;
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
use Endroid\QrCode\Writer\ValidationException;

class DaftarKaryawanController extends BaseController
{
    protected $karyawanModel;
    protected $karyawanEditModel;
    protected $jabatanModel;
    protected $divisiModel;
    protected $sertifikatModel;
    protected $transaksiModel;
    protected $penggunaModel;
    protected $penggunaEditModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->karyawanModel = new DaftarKaryawanModel();
        $this->karyawanEditModel = new DaftarKaryawanEditModel();
        $this->jabatanModel = new DaftarJabatanModel();
        $this->divisiModel = new DaftarDivisiModel();
        $this->sertifikatModel = new DaftarSertifikatModel();
        $this->penggunaModel = new DaftarPenggunaModel();
        $this->penggunaEditModel = new DaftarPenggunaEditModel();
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
                'rules' => 'required|is_unique[karyawan.nik]|numeric|max_length[16]|min_length[16]',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong',
                    'is_unique' => 'NIK sudah dipakai',
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
                    'max_length' => 'Alamat maksimal 100 karakter',
                ],
            ],
            'foto' => [
                'rules' => 'max_size[foto, 1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // 'required' => 'Foto tidak boleh kosong',
                    'max_size' => 'Foto tidak boleh besar dari 1 MB',
                    'is_image' => 'File harus berupa gambar',
                    'mime_in' => 'File harus berupa gambar',
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $writer     = new PngWriter();
        // $id         = $this->request->getVar('nik');
        $id         = time();

        $nik        = $this->request->getVar('nik');
        $nama       = $this->request->getVar('nama_karyawan');
        $id_jabatan = $this->request->getVar('jabatan');
        $id_divisi  = $this->request->getVar('divisi');
        $alamat     = $this->request->getVar('alamat');

        // ambil foto
        $fileFoto = $this->request->getFile('foto');
        // ambil nama file foto
        $namaFoto = $fileFoto->getRandomName();
        // pindahkan file ke folder img
        $fileFoto->move('img', $namaFoto);

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

        $data = [
            'id_karyawan' => $id,
            'nik' => $nik,
            'nama_karyawan' => $nama,
            'id_jabatan' => $id_jabatan,
            'id_divisi' => $id_divisi,
            'alamat' => $alamat,
            'qr_code' => $dataUri,
            'foto' => $namaFoto
        ];
        dd($data);

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
        $data['detail_karyawan'] = $this->karyawanModel->getKaryawanPerID($id_karyawan);
        $data['detail_karyawan'] = $this->karyawanModel->where(['id_karyawan' => $id_karyawan])->first();
        // dd($data);
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
        $data['karyawan'] = $this->karyawanEditModel->getKaryawanPerID($id_karyawan);
        $data['karyawan'] = $this->karyawanEditModel->where(['nik' => $id_karyawan])->first();
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
            'nik' => [
                'rules' => 'permit_empty|numeric|max_length[16]|min_length[16]',
                'errors' => [
                    'max_length' => 'NIK harus 16 karakter',
                    'min_length' => 'NIK harus 16 karakter',
                    'numeric' => 'Isian harus angka',
                ],
            ],
            'nama_karyawan' => [
                'rules' => 'permit_empty|alpha_space|max_length[100]',
                'errors' => [
                    'max_length' => 'Nama karyawan maximal 100 karakter',
                    'alpha_space' => 'Isian hanya karakter alfabet dan spasi'
                ],
            ],
            'jabatan' => [
                'rules' => 'permit_empty',
                'errors' => [],
            ],
            'divisi' => [
                'rules' => 'permit_empty',
                'errors' => [],
            ],
            'alamat' => [
                'rules' => 'permit_empty|max_length[100]',
                'errors' => [
                    'max_length' => 'Alamat maksimal 100 karakter',
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
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $writer     = new PngWriter();
        $id         = time();

        $nik = $this->request->getVar('nik');
        if ($nik == null) {
            $namaNik = $this->request->getVar('nikLama');
        } else {
            $namaNik = $this->request->getVar('nik');
        }

        $nama = $this->request->getVar('nama_karyawan');
        if ($nama == null) {
            $namaKaryawan = $this->request->getVar('nama_karyawanLama');
        } else {
            $namaKaryawan = $this->request->getVar('nama_karyawan');
        }

        $jabatan = $this->request->getVar('jabatan');
        if ($jabatan == null) {
            $namaJabatan = $this->request->getVar('jabatanLama');
        } else {
            $namaJabatan = $this->request->getVar('jabatan');
        }

        $divisi = $this->request->getVar('divisi');
        if ($divisi == null) {
            $namaDivisi = $this->request->getVar('divisiLama');
        } else {
            $namaDivisi = $this->request->getVar('divisi');
        }

        $alamat = $this->request->getVar('alamat');
        if ($alamat == null) {
            $namaAlamat = $this->request->getVar('alamatLama');
        } else {
            $namaAlamat = $this->request->getVar('alamat');
        }

        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } else {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('img', $namaFoto);
            unlink('img/' . $this->request->getVar('fotoLama'));
        }

        $qrCode = QrCode::create(base_url('lihat_karyawanQR/' . $id))
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
            'foto' => $namaFoto,
            'qr_code' => $dataUri,
        ];

        $this->karyawanEditModel->update($id_karyawan, $data);
        $this->penggunaEditModel->update($id_karyawan, $data);
        return redirect()->to(base_url('daftar_karyawan'))->with('status', 'Data Karyawan Berhasil Diubah');
    }

    public function delete_karyawan($id_karyawan = null)
    {
        $this->karyawanEditModel->delete($id_karyawan);
        $this->penggunaEditModel->delete($id_karyawan);
        return redirect()->back()->with('status', 'Data Karyawan Berhasil Dihapus');
    }
}
