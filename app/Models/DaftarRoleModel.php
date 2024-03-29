<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarRoleModel extends Model
{
    protected $table = 'auth_groups';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id',
        'name',
        'description'
    ];

    public function getRole()
    {
        return $this->db->table('auth_groups')
            ->get()->getResultArray();
    }
}
