<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarJabatanModel extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_jabatan',
        'nama_jabatan'
    ];

    public function getJabatan()
    {
        // return $this->db->table('karyawan')
        //     ->join('kelas', 'kelas.IDKelas=siswa.IDKelas')
        //     ->join('jurusan', 'jurusan.IDJurusan=siswa.IDJurusan')
        //     ->get()->getResultArray();

        return $this->db->table('jabatan')
        ->get()->getResultArray();
    }
}
