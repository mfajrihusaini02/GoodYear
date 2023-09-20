<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarKaryawanEditModel extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'nik';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_karyawan',
        'nik',
        'nama_karyawan',
        'id_jabatan',
        'id_divisi',
        'alamat',
        'qr_code',
        'foto'
    ];

    public function getKaryawan()
    {
        return $this->db->table('karyawan')
            ->join('jabatan', 'jabatan.id_jabatan=karyawan.id_jabatan')
            ->join('divisi', 'divisi.id_divisi=karyawan.id_divisi')
            ->get()->getResultArray();
    }

    public function getKaryawanPerID($id_karyawan)
    {
        return $this->db->table('karyawan')
            ->where('nik', $id_karyawan)
            ->get()->getResultArray();
    }

    public function getKaryawanJabatanPerID($id_karyawan)
    {
        return $this->db->table('karyawan')
            ->join('jabatan', 'jabatan.id_jabatan=karyawan.id_jabatan')
            ->join('divisi', 'divisi.id_divisi=karyawan.id_divisi')
            ->where('nik', $id_karyawan)
            ->get()->getResultArray();
    }

    public function getKaryawanDivisiPerID($id_divisi)
    {
        return $this->db->table('karyawan')
            ->join('divisi', 'divisi.id_divisi=karyawan.id_divisi')
            ->where('id_divisi', $id_divisi)
            ->get()->getResultArray();
    }
}
