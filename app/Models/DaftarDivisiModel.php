<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarDivisiModel extends Model
{
    protected $table = 'divisi';
    protected $primaryKey = 'id_divisi';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_divisi',
        'nama_divisi'
    ];

    public function getDivisi()
    {
        // return $this->db->table('karyawan')
        //     ->join('kelas', 'kelas.IDKelas=siswa.IDKelas')
        //     ->join('jurusan', 'jurusan.IDJurusan=siswa.IDJurusan')
        //     ->get()->getResultArray();

        return $this->db->table('divisi')
        ->get()->getResultArray();
    }
}
