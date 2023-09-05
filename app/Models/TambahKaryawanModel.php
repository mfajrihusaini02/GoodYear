<?php

namespace App\Models;

use CodeIgniter\Model;

class TambahKaryawanModel extends Model
{
    public function getTambahKaryawan()
    {
        // return $this->db->table('karyawan')
        //     ->join('kelas', 'kelas.IDKelas=siswa.IDKelas')
        //     ->join('jurusan', 'jurusan.IDJurusan=siswa.IDJurusan')
        //     ->get()->getResultArray();

        return $this->db->table('karyawan')
        ->get()->getResultArray();
    }
}
