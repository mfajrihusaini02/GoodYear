<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarRoleModel extends Model
{
    public function getRole()
    {
        // return $this->db->table('karyawan')
        //     ->join('kelas', 'kelas.IDKelas=siswa.IDKelas')
        //     ->join('jurusan', 'jurusan.IDJurusan=siswa.IDJurusan')
        //     ->get()->getResultArray();

        return $this->db->table('role')
        ->get()->getResultArray();
    }
}
