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

        // 1. Ambil Parameter Filter
        $keyword = $this->request->getGet('cari');
        $filterWilayah = $this->request->getGet('wilayah');
        $viewMode = $this->request->getGet('view') ? $this->request->getGet('view') : 'grid';

        // 2. Query Data
        $builder = $umkmModel->select('tb_umkm.*, tb_wilayah.nama_wilayah, tb_wilayah.rw')
                             ->join('tb_wilayah', 'tb_wilayah.id_wilayah = tb_umkm.id_wilayah');

        if ($keyword) {
            $builder->groupStart()
                    ->like('nama_usaha', $keyword)
                    ->orLike('produk', $keyword)
                    ->groupEnd();
        }

        if ($filterWilayah) {
            $builder->where('tb_umkm.id_wilayah', $filterWilayah);
        }

        $umkm = $builder->orderBy('tb_umkm.created_at', 'DESC')->findAll();

        $data = [
            'title'         => 'Portal UMKM Desa Candimulyo',
            'umkm'          => $umkm,
            'list_wilayah'  => $wilayahModel->findAll(),
            'keyword'       => $keyword,
            'selectedWilayah' => $filterWilayah,
            'viewMode'      => $viewMode
        ];

        return view('landing_page', $data);
    }

    public function getData($id)
    {
        $umkmModel = new UmkmModel();
        
        // PERBAIKAN: Hapus 'tb_wilayah.rt' karena RT ada di tb_umkm
        $data = $umkmModel->select('tb_umkm.*, tb_wilayah.nama_wilayah, tb_wilayah.rw')
                          ->join('tb_wilayah', 'tb_wilayah.id_wilayah = tb_umkm.id_wilayah')
                          ->find($id);

        // Kalau data tidak ditemukan (misal id ngawur)
        if (!$data) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Data tidak ditemukan']);
        }

        // Kirim sebagai JSON
        return $this->response->setJSON($data);
    }
}