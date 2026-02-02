<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UmkmModel;
use App\Models\WilayahModel;

class Admin extends BaseController
{
    /**
     * Validasi file upload (Fungsi Helper)
     * @return bool|string true jika valid, string error jika tidak
     */
    private function validateUpload($file)
    {
        // Cek apakah file ada
        if (!$file || !$file->isValid()) {
            return true; // Boleh kosong (nanti pakai default)
        }
        
        // Whitelist MIME type (KEAMANAN!)
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return 'File harus berupa gambar (JPG, PNG, atau GIF)';
        }
        
        // Maksimal 2MB
        if ($file->getSize() > 2048000) {
            return 'Ukuran file maksimal 2MB';
        }
        
        // Cek ekstensi file (double check)
        $ext = $file->getExtension();
        if (!in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
            return 'Ekstensi file tidak diizinkan';
        }
        
        return true;
    }

    // Halaman Utama Admin (Tabel)
    public function index()
    {
        $umkmModel = new UmkmModel();
        $wilayahModel = new WilayahModel();
        
        // 1. Ambil Data Tabel (Join Wilayah)
        $data['umkm'] = $umkmModel->getUmkmLengkap(); 
        
        // 2. Hitung Statistik buat Dashboard
        $data['total_umkm'] = $umkmModel->countAll();
        $data['total_wilayah'] = $wilayahModel->countAll();

        return view('admin/index', $data);
    }

    // Halaman Form Tambah Data
    public function create()
    {
        $wilayahModel = new WilayahModel();
        
        // Kirim daftar wilayah ke form biar bisa dipilih
        $data['wilayah'] = $wilayahModel->findAll();
        
        return view('admin/create', $data);
    }

    // Proses Simpan Data ke Database
    public function save()
    {
        $umkmModel = new UmkmModel();

        // 1. STANDARDISASI NOMOR HP (Auto 62)
        $hp = $this->request->getPost('kontak_hp');

        // Jika HP kosong, boleh (opsional)
        if (empty($hp)) {
            $hp = '';
        } else {
            // Hapus karakter aneh (spasi, strip, plus), sisakan angka
            $hp = preg_replace('/[^0-9]/', '', $hp);
            
            // Kalau diawali 0, ganti jadi 62. Kalau 8, tambah 62 di depan.
            if (substr($hp, 0, 1) === '0') {
                $hp = '62' . substr($hp, 1);
            } elseif (substr($hp, 0, 1) === '8') {
                $hp = '62' . $hp;
            } elseif (substr($hp, 0, 2) !== '62') {
                // Jika tidak dimulai 0, 8, atau 62 -> error
                return redirect()->back()->withInput()->with('errors', ['Nomor HP harus dimulai dengan 0, 8, atau 62']);
            }
            
            // Validasi panjang (nomor Indonesia: 10-15 digit)
            if (strlen($hp) < 10 || strlen($hp) > 15) {
                return redirect()->back()->withInput()->with('errors', ['Nomor HP tidak valid (terlalu pendek/panjang)']);
            }
        }

        // 2. STANDARDISASI NAMA FILE (Tanggal + Unik)
        $fileFoto = $this->request->getFile('foto_umkm');
        
        // VALIDASI FILE UPLOAD (KEAMANAN!)
        $validation = $this->validateUpload($fileFoto);
        if ($validation !== true) {
            return redirect()->back()->withInput()->with('errors', [$validation]);
        }
        
        if ($fileFoto && $fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            // Format: YYYYMMDD_jam_acak.ext
            $namaFoto = date('Ymd_His') . '_' . $fileFoto->getRandomName();
            
            // Pindahkan file ke public/uploads/umkm
            $fileFoto->move('uploads/umkm', $namaFoto);
        } else {
            $namaFoto = 'default.jpg';
        }

        // 3. Simpan
        $umkmModel->save([
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'kategori' => implode(', ', (array)$this->request->getPost('kategori')),
            'pemilik'    => $this->request->getPost('pemilik'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'rt'         => $this->request->getPost('rt'),
            'produk'     => $this->request->getPost('produk'),
            'kontak_hp'  => $hp,
            'foto_umkm'  => $namaFoto
        ]);

        return redirect()->to('admin')->with('success', 'Data UMKM berhasil ditambahkan');
    }

    // Fungsi Hapus Data
    public function delete($id)
    {
        $umkmModel = new UmkmModel();
        
        // Ambil data UMKM untuk hapus fotonya juga
        $umkm = $umkmModel->find($id);
        
        // Hapus file foto jika bukan default
        if ($umkm && $umkm['foto_umkm'] !== 'default.jpg') {
            $filePath = 'uploads/umkm/' . $umkm['foto_umkm'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        // Hapus data dari database
        $umkmModel->delete($id);
        
        return redirect()->to('admin')->with('success', 'Data UMKM berhasil dihapus');
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
            return redirect()->to('admin'); 
        }

        return view('admin/edit', $data);
    }

    // Proses Simpan Perubahan (UPDATE)
    public function update($id)
    {
        $umkmModel = new UmkmModel();

        // 1. STANDARDISASI NOMOR HP
        $hp = $this->request->getPost('kontak_hp');
        
        if (empty($hp)) {
            $hp = '';
        } else {
            $hp = preg_replace('/[^0-9]/', '', $hp);
            if (substr($hp, 0, 1) === '0') {
                $hp = '62' . substr($hp, 1);
            } elseif (substr($hp, 0, 1) === '8') {
                $hp = '62' . $hp;
            } elseif (substr($hp, 0, 2) !== '62') {
                return redirect()->back()->withInput()->with('errors', ['Nomor HP harus dimulai dengan 0, 8, atau 62']);
            }
            if (strlen($hp) < 10 || strlen($hp) > 15) {
                return redirect()->back()->withInput()->with('errors', ['Nomor HP tidak valid']);
            }
        }

        // 2. LOGIK FOTO
        $fileFoto = $this->request->getFile('foto_umkm');
        
        // VALIDASI FILE
        $validation = $this->validateUpload($fileFoto);
        if ($validation !== true) {
            return redirect()->back()->withInput()->with('errors', [$validation]);
        }
        
        if ($fileFoto && $fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            // Kalau upload baru -> Generate nama baru & Pindahkan
            $namaFoto = date('Ymd_His') . '_' . $fileFoto->getRandomName();
            $fileFoto->move('uploads/umkm', $namaFoto);
            
            // Hapus foto lama jika bukan default
            $umkmLama = $umkmModel->find($id);
            if ($umkmLama && $umkmLama['foto_umkm'] !== 'default.jpg') {
                $filePathLama = 'uploads/umkm/' . $umkmLama['foto_umkm'];
                if (file_exists($filePathLama)) {
                    unlink($filePathLama);
                }
            }
        } else {
            // Kalau tidak upload -> Pakai nama foto lama
            $namaFoto = $this->request->getPost('foto_lama');
            if (empty($namaFoto)) {
                $namaFoto = 'default.jpg';
            }
        }

        // 3. SIMPAN UPDATE DENGAN ID
        $umkmModel->update($id, [
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'kategori' => implode(', ', (array)$this->request->getPost('kategori')),
            'pemilik'    => $this->request->getPost('pemilik'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'rt'         => $this->request->getPost('rt'),
            'produk'     => $this->request->getPost('produk'),
            'kontak_hp'  => $hp,
            'foto_umkm'  => $namaFoto
        ]);

        return redirect()->to('admin')->with('success', 'Data UMKM berhasil diperbarui');
    }

    // Fungsi Export ke Excel (CSV)
    public function export()
    {
        $umkmModel = new UmkmModel();
        $umkm = $umkmModel->getUmkmLengkap();

        // Nama file saat didownload
        $filename = 'Data_UMKM_Desa_Candimulyo_' . date('Y-m-d_H-i') . '.csv';

        // Setting Header Browser
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: text/csv; charset=utf-8");

        // Buka pintu output file
        $file = fopen('php://output', 'w');
        
        // Tambah UTF-8 BOM untuk Excel Indonesia biar simbol aman
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

        // 1. Tulis Baris Judul (Tambah Kolom Kategori)
        $header = ['No', 'Kategori', 'Nama Usaha', 'Pemilik', 'Wilayah', 'RW', 'RT', 'Produk', 'Kontak HP', 'Tanggal Input'];
        fputcsv($file, $header);

        // 2. Tulis Isi Data
        foreach ($umkm as $key => $row) {
            $data = [
                $key + 1,
                $row['kategori'], // <--- TAMBAHAN EXPORT KATEGORI
                $row['nama_usaha'],
                $row['pemilik'],
                $row['nama_wilayah'],
                $row['rw'],
                'RT ' . $row['rt'], 
                $row['produk'],
                "'" . $row['kontak_hp'], // Trik biar 0 tidak hilang di Excel
                $row['created_at']
            ];
            fputcsv($file, $data);
        }

        fclose($file);
        exit;
    }
}