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
        $wilayahModel = new WilayahModel(); // Kita panggil model wilayah
        
        // 1. Ambil Data Tabel (seperti biasa)
        $data['umkm'] = $umkmModel->getUmkmLengkap(); 
        
        // 2. [BARU] Hitung Statistik buat Dashboard
        $data['total_umkm'] = $umkmModel->countAll();
        $data['total_wilayah'] = $wilayahModel->countAll();

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

        // 1. STANDARDISASI NOMOR HP (Auto 62)
        $hp = $this->request->getPost('kontak_hp');
        // Hapus karakter aneh (spasi, strip, plus), sisakan angka
        $hp = preg_replace('/[^0-9]/', '', $hp);
        // Kalau diawali 0, ganti jadi 62. Kalau 8, tambah 62 di depan.
        if (substr($hp, 0, 1) === '0') {
            $hp = '62' . substr($hp, 1);
        } elseif (substr($hp, 0, 1) === '8') {
            $hp = '62' . $hp;
        }

        // 2. STANDARDISASI NAMA FILE (Tanggal + Unik)
        $fileFoto = $this->request->getFile('foto_umkm');
        
        if ($fileFoto && $fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            // Format: YYYYMMDD_jam_acak.ext (Contoh: 20260201_143000_123.jpg)
            $namaFoto = date('Ymd_His') . '_' . $fileFoto->getRandomName();
            $fileFoto->move('uploads/umkm', $namaFoto);
        } else {
            $namaFoto = 'default.jpg';
        }

        // 3. Simpan
        $umkmModel->save([
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'pemilik'    => $this->request->getPost('pemilik'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'rt'         => $this->request->getPost('rt'),
            'produk'     => $this->request->getPost('produk'),
            'kontak_hp'  => $hp, // Pakai variabel $hp yang sudah bersih
            'foto_umkm'  => $namaFoto
        ]);

        return redirect()->to('admin');
    }

    // Fungsi Hapus Data
    public function delete($id)
    {
        $umkmModel = new UmkmModel();
        $umkmModel->delete($id);
        return redirect()->to('admin');
    }
    // Tampilkan Form Edit
    public function edit($id)
    {
        $umkmModel = new UmkmModel();
        $wilayahModel = new WilayahModel();

        // Ambil data UMKM yang mau diedit
        $data['umkm'] = $umkmModel->find($id);
        // Ambil data wilayah buat dropdown
        $data['wilayah'] = $wilayahModel->findAll();

        if (empty($data['umkm'])) {
            return redirect()->to('admin'); // Kalau data gak ada, balik ke admin
        }

        return view('admin/edit', $data);
    }

    // Proses Simpan Perubahan
    public function update()
    {
        $umkmModel = new UmkmModel();

        // 1. STANDARDISASI NOMOR HP (Auto 62)
        $hp = $this->request->getPost('kontak_hp');
        // Hapus karakter aneh (spasi, strip, plus), sisakan angka
        $hp = preg_replace('/[^0-9]/', '', $hp);
        // Kalau diawali 0, ganti jadi 62. Kalau 8, tambah 62 di depan.
        if (substr($hp, 0, 1) === '0') {
            $hp = '62' . substr($hp, 1);
        } elseif (substr($hp, 0, 1) === '8') {
            $hp = '62' . $hp;
        }

        // 2. STANDARDISASI NAMA FILE (Tanggal + Unik)
        $fileFoto = $this->request->getFile('foto_umkm');
        
        if ($fileFoto && $fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            // Format: YYYYMMDD_jam_acak.ext (Contoh: 20260201_143000_123.jpg)
            $namaFoto = date('Ymd_His') . '_' . $fileFoto->getRandomName();
            $fileFoto->move('uploads/umkm', $namaFoto);
        } else {
            $namaFoto = 'default.jpg';
        }

        // 3. Simpan
        $umkmModel->update([
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'pemilik'    => $this->request->getPost('pemilik'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'rt'         => $this->request->getPost('rt'),
            'produk'     => $this->request->getPost('produk'),
            'kontak_hp'  => $hp, // Pakai variabel $hp yang sudah bersih
            'foto_umkm'  => $namaFoto
        ]);

        return redirect()->to('admin');
    }

    // Fungsi Export ke Excel (CSV)
    public function export()
    {
        $umkmModel = new UmkmModel();
        $umkm = $umkmModel->getUmkmLengkap();

        // Nama file saat didownload
        $filename = 'Data_UMKM_Desa_Candimulyo_' . date('Y-m-d_H-i') . '.csv';

        // Setting Header Browser (Supaya otomatis download)
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv;");

        // Buka pintu output file
        $file = fopen('php://output', 'w');

        // 1. Tulis Baris Judul (Header Kolom)
        $header = ['No', 'Nama Usaha', 'Pemilik', 'Wilayah', 'RW', 'RT', 'Produk', 'Kontak HP', 'Tanggal Input'];
        fputcsv($file, $header);

        // 2. Tulis Isi Data (Looping)
        foreach ($umkm as $key => $row) {
            $data = [
                $key + 1,
                $row['nama_usaha'],
                $row['pemilik'],
                $row['nama_wilayah'],
                $row['rw'],
                'RT ' . $row['rt'], // Tambah teks RT biar rapi
                $row['produk'],
                "'" . $row['kontak_hp'], // Trik: Kasih tanda kutip biar Excel baca sebagai Teks (0 di depan aman)
                $row['created_at']
            ];
            fputcsv($file, $data);
        }

        // Tutup pintu file & Matikan script
        fclose($file);
        exit;
    }
}