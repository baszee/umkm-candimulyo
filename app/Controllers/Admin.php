<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UmkmModel;
use App\Models\WilayahModel; // Kita butuh ini buat dropdown dusun

class Admin extends BaseController
{
    // Halaman Utama Admin (Tabel)
    public function index()
    {
        $umkmModel = new UmkmModel();
        // Ambil data UMKM digabung dengan nama Wilayahnya
        $data['umkm'] = $umkmModel->getUmkmLengkap(); 
        
        return view('admin/index', $data);
    }

    // Halaman Form Tambah Data
    public function create()
    {
        $wilayahModel = new WilayahModel();
        
        // Kita kirim daftar wilayah ke form biar bisa dipilih
        $data['wilayah'] = $wilayahModel->findAll();
        
        return view('admin/create', $data);
    }

    // Proses Simpan Data ke Database
    public function save()
    {
        $umkmModel = new UmkmModel();

        // 1. Ambil file foto dari form
        $fileFoto = $this->request->getFile('foto_umkm');
        
        // Cek apakah user upload foto?
        if ($fileFoto && $fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            // Generate nama file unik (biar gak bentrok)
            $namaFoto = $fileFoto->getRandomName();
            // Pindahkan file ke folder public/uploads/umkm
            $fileFoto->move('uploads/umkm', $namaFoto);
        } else {
            // Kalau gak upload, pakai default
            $namaFoto = 'default.jpg';
        }

        // 2. Simpan semua data ke database
        $umkmModel->save([
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'pemilik'    => $this->request->getPost('pemilik'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'rt'         => $this->request->getPost('rt'),
            'produk'     => $this->request->getPost('produk'),
            'kontak_hp'  => $this->request->getPost('kontak_hp'),
            'foto_umkm'  => $namaFoto
        ]);

        // 3. Kembali ke halaman admin
        return redirect()->to('admin');
    }
}