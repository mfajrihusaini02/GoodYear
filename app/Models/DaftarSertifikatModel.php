<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarSertifikatModel extends Model
{
    protected $table = 'transaksi_sertifikat';
    protected $primaryKey = 'id_transaksi';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_transaksi',
        'id_sertifikat',
        'id_karyawan',
        'tanggal_ambil',
        'tanggal_ekspire'
    ];

    public function getSertifikat()
    {
        return $this->db->table('sertifikat')
            ->join('transaksi_sertifikat', 'transaksi_sertifikat.id_sertifikat=sertifikat.id_sertifikat')
            ->get()->getResultArray();
    }

    public function getJenisSertifikat()
    {
        return $this->db->table('sertifikat')
            ->get()->getResultArray();
    }
}
