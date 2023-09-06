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
        // return $this->db->table('karyawan')
        //     ->join('kelas', 'kelas.IDKelas=siswa.IDKelas')
        //     ->join('jurusan', 'jurusan.IDJurusan=siswa.IDJurusan')
        //     ->get()->getResultArray();

        return $this->db->table('karyawan')
        ->get()->getResultArray();
    }
}
