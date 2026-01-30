<?php

namespace App\Models;

use CodeIgniter\Model;

class UmkmModel extends Model
{
    protected $table            = 'tb_umkm';
    protected $primaryKey       = 'id_umkm';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Fitur otomatis catat tanggal input
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    // Kolom yang boleh diisi form (sesuai database kita)
    protected $allowedFields    = [
        'id_wilayah', 
        'nama_usaha', 
        'pemilik', 
        'rt', 
        'produk', 
        'kontak_hp', 
        'foto_umkm'
    ];
    
    // Fungsi khusus untuk menggabungkan data UMKM dengan Nama Wilayahnya
    public function getUmkmLengkap()
    {
        return $this->select('tb_umkm.*, tb_wilayah.nama_wilayah, tb_wilayah.rw')
                    ->join('tb_wilayah', 'tb_wilayah.id_wilayah = tb_umkm.id_wilayah')
                    ->findAll();
    }
}