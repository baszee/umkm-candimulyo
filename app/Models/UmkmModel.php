<?php

namespace App\Models;

use CodeIgniter\Model;

class UmkmModel extends Model
{
    protected $table            = 'tb_umkm';
    protected $primaryKey       = 'id_umkm';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    // KITA TAMBAHKAN 'kategori' DI SINI
    protected $allowedFields    = [
        'id_wilayah', 
        'kategori', 
        'nama_usaha', 
        'pemilik', 
        'rt', 
        'produk', 
        'kontak_hp', 
        'foto_umkm'
    ];
    
    public function getUmkmLengkap()
    {
        return $this->select('tb_umkm.*, tb_wilayah.nama_wilayah, tb_wilayah.rw')
                    ->join('tb_wilayah', 'tb_wilayah.id_wilayah = tb_umkm.id_wilayah')
                    ->findAll();
    }
}