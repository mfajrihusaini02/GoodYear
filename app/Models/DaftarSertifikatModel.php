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
        'id_karyawan',
        'kode_sertifikat',
        'nama_sertifikat',
        'tanggal_ambil',
        'tanggal_ekspire'
    ];

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
