<?php

namespace App\Models;

use CodeIgniter\Model;

class TambahPenggunaModel extends Model
{
    public function getTambahPengguna()
    {
        // return $this->db->table('karyawan')
        //     ->join('kelas', 'kelas.IDKelas=siswa.IDKelas')
        //     ->join('jurusan', 'jurusan.IDJurusan=siswa.IDJurusan')
        //     ->get()->getResultArray();

        return $this->db->table('pengguna')
        ->get()->getResultArray();
    }
}
