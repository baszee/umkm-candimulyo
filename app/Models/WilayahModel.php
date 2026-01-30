<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    protected $table            = 'tb_wilayah';
    protected $primaryKey       = 'id_wilayah';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Kolom yang boleh diisi
    protected $allowedFields    = ['nama_wilayah', 'rw'];
}