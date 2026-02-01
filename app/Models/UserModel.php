<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'tb_users'; // Pastikan nama tabel ada 's'-nya sesuai SQL kamu
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = true;
    
    // PERBAIKAN: Ganti 'password' jadi 'password_hash' dan tambah 'role'
    protected $allowedFields    = ['username', 'password', 'nama_lengkap', 'role'];
}