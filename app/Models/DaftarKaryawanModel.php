<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarKaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_karyawan',
        'nik',
        'nama_karyawan',
        'jabatan',
        'divisi',
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
}
