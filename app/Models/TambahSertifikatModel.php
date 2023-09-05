<?php

namespace App\Models;

use CodeIgniter\Model;

class TambahSertifikatModel extends Model
{
    public function getTambahSertifikat()
    {
        // return $this->db->table('karyawan')
        //     ->join('kelas', 'kelas.IDKelas=siswa.IDKelas')
        //     ->join('jurusan', 'jurusan.IDJurusan=siswa.IDJurusan')
        //     ->get()->getResultArray();

        return $this->db->table('sertifikat')
        ->get()->getResultArray();
    }
}
