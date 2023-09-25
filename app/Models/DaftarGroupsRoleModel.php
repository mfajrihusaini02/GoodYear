<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarGroupsRoleModel extends Model
{
    protected $table = 'auth_groups_users';

    protected $primaryKey = 'id_groups';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_groups',
        'group_id',
        'user_id'
    ];

    public function getGroupsRole()
    {
        return $this->db->table('auth_groups_users')
            ->get()->getResultArray();
    }
}
