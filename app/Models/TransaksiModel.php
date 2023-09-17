<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
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

    public function getTransaksi()
    {
        return $this->db->table('transaksi_sertifikat')
            ->get()->getResultArray();
    }

    public function getJenisTransaksi()
    {
        return $this->db->table('sertifikat')
            ->join('transaksi_sertifikat', 'transaksi_sertifikat.id_sertifikat=sertifikat.id_sertifikat')
            ->get()->getResultArray();
    }

    public function getSertifikatPerID($id_karyawan)
    {
        return $this->db->table('sertifikat')
            ->join('transaksi_sertifikat', 'transaksi_sertifikat.id_sertifikat=sertifikat.id_sertifikat')
            ->where('id_karyawan', $id_karyawan)
            ->get()->getResultArray();
    }
}
