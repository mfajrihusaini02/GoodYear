<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarRoleModel extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id_role';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_role',
        'nama_role',
        'level'
    ];

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
