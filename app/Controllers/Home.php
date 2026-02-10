<?php

namespace App\Controllers;

use App\Models\UmkmModel;
use App\Models\WilayahModel;

class Home extends BaseController
{
    public function index()
    {
        $umkmModel = new UmkmModel();
        $wilayahModel = new WilayahModel();

        // Ambil Parameter Filter (TETAP SUPPORT GET PARAMETER UNTUK FLEKSIBILITAS)
        $keyword = $this->request->getGet('cari');
        $filterWilayah = $this->request->getGet('wilayah');
        $filterKategori = $this->request->getGet('kategori');
        $viewMode = $this->request->getGet('view') ? $this->request->getGet('view') : 'grid';

        // Query Data - AMBIL SEMUA (TANPA PAGINATION, SESUAI LANDING PAGE ASLI)
        $builder = $umkmModel->select('tb_umkm.*, tb_wilayah.nama_wilayah, tb_wilayah.rw')
                             ->join('tb_wilayah', 'tb_wilayah.id_wilayah = tb_umkm.id_wilayah');

        // Filter di server-side hanya jika ada parameter GET (opsional)
        if ($keyword) {
            $builder->groupStart()
                    ->like('nama_usaha', $keyword)
                    ->orLike('produk', $keyword)
                    ->groupEnd();
        }

        if ($filterWilayah) {
            $builder->where('tb_umkm.id_wilayah', $filterWilayah);
        }

        if ($filterKategori) {
            $builder->like('tb_umkm.kategori', $filterKategori);
        }

        // AMBIL SEMUA DATA (UNTUK JAVASCRIPT FILTERING SEPERTI DI LANDING PAGE ASLI)
        $umkm = $builder->orderBy('tb_umkm.created_at', 'DESC')
                       ->findAll();

        $data = [
            'title'           => 'Portal UMKM Desa Candimulyo',
            'umkm'            => $umkm, // Kirim semua data ke view
            'list_wilayah'    => $wilayahModel->findAll(),
            'keyword'         => $keyword,
            'selectedWilayah' => $filterWilayah,
            'selectedKategori'=> $filterKategori,
            'viewMode'        => $viewMode
        ];

        return view('landing_page', $data);
    }

    public function getData($id)
    {
        $umkmModel = new UmkmModel();
        
        $data = $umkmModel->select('tb_umkm.*, tb_wilayah.nama_wilayah, tb_wilayah.rw')
                          ->join('tb_wilayah', 'tb_wilayah.id_wilayah = tb_umkm.id_wilayah')
                          ->find($id);

        if (!$data) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Data tidak ditemukan']);
        }

        return $this->response->setJSON($data);
    }
}