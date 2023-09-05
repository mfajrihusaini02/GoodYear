<?php

namespace App\Models;

use CodeIgniter\Model;

class TambahRoleModel extends Model
{
    public function getTambahRole()
    {
        // return $this->db->table('karyawan')
        //     ->join('kelas', 'kelas.IDKelas=siswa.IDKelas')
        //     ->join('jurusan', 'jurusan.IDJurusan=siswa.IDJurusan')
        //     ->get()->getResultArray();

        return $this->db->table('role')
        ->get()->getResultArray();
    }
}
