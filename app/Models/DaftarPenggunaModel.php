<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarPenggunaModel extends Model
{
    public function getPengguna()
    {
        return $this->db->table('pengguna')
            ->join('role', 'role.id_role=pengguna.id_role')
            ->get()->getResultArray();

        // return $this->db->table('karyawan')
        // ->get()->getResultArray();
    }
}
