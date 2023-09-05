<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarSertifikatModel extends Model
{
    public function getSertifikat()
    {
        // return $this->db->table('karyawan')
        //     ->join('kelas', 'kelas.IDKelas=siswa.IDKelas')
        //     ->join('jurusan', 'jurusan.IDJurusan=siswa.IDJurusan')
        //     ->get()->getResultArray();

        return $this->db->table('sertifikat')
        ->get()->getResultArray();
    }
}
