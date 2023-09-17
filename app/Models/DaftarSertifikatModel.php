<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarSertifikatModel extends Model
{
    protected $table = 'sertifikat';
    protected $primaryKey = 'id_sertifikat';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_sertifikat',
        'kode_sertifikat',
        'nama_sertifikat',
    ];
    
    public function getJenisSertifikat()
    {
        return $this->db->table('sertifikat')
            ->get()->getResultArray();
    }
}
