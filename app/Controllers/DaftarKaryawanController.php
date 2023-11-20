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
use Myth\Auth\Password;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['karyawan'] = $this->karyawanModel->getKaryawan();
        return view('daftar_karyawan', $data);
    }

    public function laporan()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['karyawan'] = $this->karyawanModel->getLaporan();
        return view('laporan', $data);
    }

    public function index_karyawan()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['karyawan'] = $this->karyawanModel->getKaryawan();
        return view('karyawan', $data);
    }

    public function tambah_karyawan()
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
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
                'rules' => 'required|is_unique[karyawan.nik]|numeric|max_length[16]|min_length[5]',
                'errors' => [
                    'required' => 'NOCC cannot be empty',
                    'is_unique' => 'NOCC already used',
                    'max_length' => 'NOCC must be 16 characters',
                    'min_length' => 'NOCC must be 5 characters',
                    'numeric' => 'Fill only numeric',
                ],
            ],
            'nama_karyawan' => [
                'rules' => 'required|alpha_space|max_length[100]',
                'errors' => [
                    'required' => 'Employee name cannot be empty',
                    'max_length' => 'Employee name maximum 100 characters',
                    'alpha_space' => 'Fill only alphabetic characters and spaces'
                ],
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Department not selected',
                ],
            ],
            'divisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Division not selected',
                ],
            ],
            'foto' => [
                'rules' => 'required|max_size[foto, 1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'required' => 'Photo profile cannot be empty',
                    'max_size' => 'Photo profile cannot be larger than 1 MB',
                    'is_image' => 'File must be image',
                    'mime_in' => 'File must be image',
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $writer     = new PngWriter();
        $id         = time();
        $nik        = $this->request->getVar('nik');
        $nama       = $this->request->getVar('nama_karyawan');
        $id_jabatan = $this->request->getVar('jabatan');
        $id_divisi  = $this->request->getVar('divisi');
        $qrCode = QrCode::create(base_url('view_karyawanQR/' . $id))
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

        $result = $writer->write($qrCode, null, $label);

        // header('Content-Type: ' . $result->getMimeType());

        $result->saveToFile('barcode/' . $id . '.png');

        $dataUri = $result->getDataUri();

        // ambil foto
        $fileFoto = $this->request->getFile('foto');
        // ambil nama file foto
        $namaFoto = $fileFoto->getRandomName();
        // pindahkan file ke folder img
        $fileFoto->move('img', $namaFoto);
        $status_karyawan = "1";

        $data = [
            'id_karyawan' => $id,
            'nik' => $nik,
            'nama_karyawan' => $nama,
            'id_jabatan' => $id_jabatan,
            'id_divisi' => $id_divisi,
            'qr_code' => $dataUri,
            'foto' => $namaFoto,
            'status_karyawan' => $status_karyawan
        ];

        // dd($data);
        $this->karyawanModel->save($data);
        return redirect()->to(base_url('daftar_karyawan'))->with('status', 'EMPLOYEE DATA SAVED SUCCESSFULLY');
    }

    public function lihat_karyawan($id_karyawan = null)
    {
        $data = $this->karyawanModel->where(['id_karyawan' => $id_karyawan])->findAll();
        if ($data == false || count($data) < 1) {
            return "";
        }
        $qrCode = QrCode::create(base_url('view_karyawanQR/' . $id_karyawan))
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $writer     = new PngWriter();

        $logo = Logo::create('logo.png')
            ->setResizeToWidth(150);

        $label = Label::create($data[0]['nama_karyawan'])
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, null, $label);
        // header('Content-Type: ' . $result->getMimeType());
        // die($result->getString());

        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['jabatan'] = $this->jabatanModel->findAll();
        $data['transaksi'] = $this->transaksiModel->getTransaksi();
        $data['transaksi'] = $this->transaksiModel->getJenisTransaksi();
        $data['transaksi'] = $this->transaksiModel->getSertifikatPerIDLihat($id_karyawan);
        $data['detail_karyawan'] = $this->karyawanModel->getKaryawanPerID($id_karyawan);
        $data['detail_karyawan'] = $this->karyawanModel->where(['id_karyawan' => $id_karyawan])->first();
        return view('lihat_karyawan', $data);
    }

    public function view_karyawanQR($id_karyawan = null)
    {
        $data['users'] = $this->penggunaModel->getPengguna();
        $data['jabatan'] = $this->jabatanModel->findAll();
        $data['transaksi'] = $this->transaksiModel->getTransaksi();
        $data['transaksi'] = $this->transaksiModel->getJenisTransaksi();
        $data['transaksi'] = $this->transaksiModel->getSertifikatPerIDLihat($id_karyawan);
        $data['detail_karyawan'] = $this->karyawanModel->getKaryawanPerID($id_karyawan);
        $data['detail_karyawan'] = $this->karyawanModel->where(['id_karyawan' => $id_karyawan])->first();
        return view('view_karyawan', $data);
    }

    public function edit_karyawan($id_karyawan = null)
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
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

    public function my_profile($id_karyawan = null)
    {
        $data['datauser'] = $this->karyawanModel->where(['nik' => user()->nik])->first();
        $data['karyawan'] = $this->karyawanEditModel->where(['nik' => $id_karyawan])->first();
        $data['users'] = $this->penggunaModel->where(['nik' => user()->nik])->first();
        // dd($data);
        return view('edit_karyawandisable', $data);
    }

    public function update_profile($id_karyawan = null)
    {
        // validation input
        if (!$this->validate([
            'nik' => [
                'rules' => 'permit_empty|numeric|max_length[16]|min_length[16]',
                'errors' => [
                    'max_length' => 'NOCC must be 16 characters',
                    'min_length' => 'NOCC must be 16 characters',
                    'numeric' => 'Fill only numeric',
                ],
            ],
            'nama_karyawan' => [
                'rules' => 'permit_empty|alpha_space|max_length[100]',
                'errors' => [
                    'max_length' => 'Employee name maximum 100 characters',
                    'alpha_space' => 'Fill only alphabetic characters and spaces'
                ],
            ],
            'email' => [
                'rules' => 'permit_empty|valid_emails|max_length[50]',
                'errors' => [
                    'valid_emails' => 'There is no @ element',
                    'max_length' => 'Email maximum 50 characters',
                ],
            ],
            'password_hash' => [
                'rules' => 'permit_empty|max_length[50]',
                'errors' => [
                    'max_length' => 'Password maximum 50 characters',
                ],
            ],
            'foto' => [
                'rules' => 'max_size[foto, 1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Photo profile cannot be larger than 1 MB',
                    'is_image' => 'File must be image',
                    'mime_in' => 'File must be image',
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } else {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('img', $namaFoto);
            unlink('img/' . $this->request->getVar('fotoLama'));
        }

        $email          = $this->request->getVar('email');
        if ($email == null) {
            $namaEmail = $this->request->getVar('emailLama');
        } else {
            $namaEmail = $this->request->getVar('email');
        }

        $password           = $this->request->getVar('password_hash');
        if ($password == null) {
            $namaPassword = $this->request->getVar('passwordLama');
        } else {
            $namaPassword = $this->request->getVar('password_hash');
        }

        $password_hash      = $this->request->getVar('password_hash');
        if ($password_hash == null) {
            $namaPasswordHash = $this->request->getVar('password_hashLama');
        } else {
            $namaPasswordHash = Password::hash($this->request->getVar('password_hash'));
        }

        $data = [
            'foto' => $namaFoto,
        ];

        $data1 = [
            'email' => $namaEmail,
            'password' => $namaPassword,
            'password_hash' => $namaPasswordHash,
        ];

        $this->karyawanEditModel->update($id_karyawan, $data);
        $this->penggunaEditModel->update($id_karyawan, $data1);
        return redirect()->to(base_url('dashboard'))->with('status', 'PROFILE SUCCESSFULLY CHANGED');
    }

    public function update_karyawan($id_karyawan = null)
    {
        // validation input
        if (!$this->validate([
            'nik' => [
                'rules' => 'permit_empty|numeric|max_length[16]|min_length[16]',
                'errors' => [
                    'max_length' => 'NOCC must be 16 characters',
                    'min_length' => 'NOCC must be 16 characters',
                    'numeric' => 'Fill only numeric',
                ],
            ],
            'nama_karyawan' => [
                'rules' => 'permit_empty|alpha_space|max_length[100]',
                'errors' => [
                    'max_length' => 'Employee name maximum 100 characters',
                    'alpha_space' => 'Fill only alphabetic characters and spaces'
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
            'status_karyawan' => [
                'rules' => 'permit_empty',
                'errors' => [],
            ],
            'foto' => [
                'rules' => 'max_size[foto, 1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Photo profile cannot be larger than 1 MB',
                    'is_image' => 'File must be image',
                    'mime_in' => 'File must be image',
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $writer     = new PngWriter();
        $id         = time();

        $idLama = $this->request->getVar('idLama');
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

        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } else {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('img', $namaFoto);
            unlink('img/' . $this->request->getVar('fotoLama'));
        }

        $status_karyawan = $this->request->getVar('status_karyawan');
        if ($status_karyawan == null) {
            $namaStatus = $this->request->getVar('status_karyawanLama');
        } else {
            $namaStatus = $this->request->getVar('status_karyawan');
        }

        $qrCode = QrCode::create(base_url('view_karyawanQR/' . $idLama))
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

        $result = $writer->write($qrCode, null, $label);

        header('Content-Type: ' . $result->getMimeType());

        $result->saveToFile('barcode/' . $idLama . '.png');

        $dataUri = $result->getDataUri();

        $data = [
            'nik' => $namaNik,
            'nama_karyawan' => $namaKaryawan,
            'id_jabatan' => $namaJabatan,
            'id_divisi' => $namaDivisi,
            'status_karyawan' => $namaStatus,
            'foto' => $namaFoto,
            'qr_code' => $dataUri,
        ];

        $data1 = ['nik' => $namaNik];

        $this->karyawanEditModel->update($id_karyawan, $data);
        $this->penggunaEditModel->update($id_karyawan, $data1);
        return redirect()->to(base_url('daftar_karyawan'))->with('status', 'EMPLOYEE DATA SUCCESSFULLY CHANGED');
    }

    public function delete_karyawan($id_karyawan = null)
    {
        $this->karyawanModel->delete($id_karyawan);
        $this->penggunaModel->delete($id_karyawan);
        unlink('barcode/' . $id_karyawan . '.png');
        return redirect()->back()->with('status', 'EMPLOYEE DATA SUCCESSFULLY DELETED');
    }

    public function cetak_laporan()
    {
        $filename = "report_goodyear_" . date('d_M_Y') . ".xlsx";
        $data = $this->karyawanModel->getLaporan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'PERSNUMBER');
        $sheet->setCellValue('C1', 'FULL NAME');
        $sheet->setCellValue('D1', 'POSITION TITLE');
        $sheet->setCellValue('E1', 'DEPARTMENT');
        $sheet->setCellValue('F1', 'CERTIFICATE NAME');
        $sheet->setCellValue('G1', 'CERTIFICATE DATE');
        $sheet->setCellValue('H1', 'DATE OF EXPIRED');
        $sheet->setCellValue('I1', 'CERTIFICATE (SAFETY) SCORE');
        $sheet->setCellValue('J1', 'CERTIFICATE (QUALITY) SCORE');
        $sheet->setCellValue('K1', 'CERTIFICATE (OPERATION) SCORE');
        $sheet->setCellValue('L1', 'CERTIFICATE AVERAGE SCORE');

        $column = 2;
        foreach ($data as $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value['nik']);
            $sheet->setCellValue('C' . $column, $value['nama_karyawan']);
            $sheet->setCellValue('D' . $column, $value['nama_jabatan']);
            $sheet->setCellValue('E' . $column, $value['nama_divisi']);
            $sheet->setCellValue('F' . $column, $value['nama_sertifikat']);
            $sheet->setCellValue('G' . $column, date('d M Y', strtotime($value['tanggal_ambil'])));
            $sheet->setCellValue('H' . $column, date('d M Y', strtotime($value['tanggal_ekspire'])));
            $sheet->setCellValue('I' . $column, $value['n_safety']);
            $sheet->setCellValue('J' . $column, $value['n_quality']);
            $sheet->setCellValue('K' . $column, $value['n_operation']);
            $sheet->setCellValue('L' . $column, $value['n_average']);
            $column++;
        }

        $sheet->getStyle('A1:L1')->getFont()->setBold(true);
        $sheet->getStyle('A1:L1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFFFF');

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000']
                ],
            ],
        ];

        $sheet->getStyle('A1:L' . ($column - 1))->applyFromArray($styleArray);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}
