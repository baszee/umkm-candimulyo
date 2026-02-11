<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UmkmModel;
use App\Models\WilayahModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    /**
     * Helper: Validasi file upload
     */
    private function validateUpload($file)
    {
        if (!$file || !$file->isValid()) {
            return true; 
        }
        
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return 'File harus berupa gambar (JPG, PNG, atau GIF)';
        }
        
        if ($file->getSize() > 2048000) {
            return 'Ukuran file maksimal 2MB';
        }
        
        $ext = $file->getExtension();
        if (!in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
            return 'Ekstensi file tidak diizinkan';
        }
        
        return true;
    }

    /**
     * Helper: Bersihkan Nomor HP
     */
    private function cleanPhoneNumber($hp)
    {
        if (empty($hp)) return '';
        $hp = preg_replace('/[^0-9+]/', '', $hp);
        $hp = str_replace('+', '', $hp);
        
        if (substr($hp, 0, 1) === '0') {
            $hp = '62' . substr($hp, 1);
        } elseif (substr($hp, 0, 1) === '8') {
            $hp = '62' . $hp;
        } elseif (substr($hp, 0, 2) !== '62') {
            return false;
        }
        
        if (strlen($hp) < 10 || strlen($hp) > 15) {
            return false;
        }
        return $hp;
    }

    /**
     * Helper: Optimasi Gambar
     */
    private function optimizeImage($file, $fileName, $maxWidth = 800, $quality = 80)
    {
        $image = \Config\Services::image();
        $uploadPath = 'uploads/umkm/' . $fileName;
        
        try {
            $image->withFile($file)
                  ->resize($maxWidth, $maxWidth, true, 'height')
                  ->save($uploadPath, $quality);
            return true;
        } catch (\Exception $e) {
            $file->move('uploads/umkm', $fileName);
            return false;
        }
    }

    // DASHBOARD
    public function index()
    {
        $umkmModel = new UmkmModel();
        $wilayahModel = new WilayahModel();
        
        $data['umkm'] = $umkmModel->getUmkmLengkap(); 
        $data['total_umkm'] = $umkmModel->countAll();
        $data['total_wilayah'] = $wilayahModel->countAll();

        return view('admin/index', $data);
    }

    // CREATE
    public function create()
    {
        $wilayahModel = new WilayahModel();
        $data['wilayah'] = $wilayahModel->findAll();
        return view('admin/create', $data);
    }

    // SAVE
    public function save()
    {
        $umkmModel = new UmkmModel();

        $hp = $this->request->getPost('kontak_hp');
        $cleanedHP = $this->cleanPhoneNumber($hp);
        
        if ($cleanedHP === false && !empty($hp)) {
            return redirect()->back()->withInput()->with('errors', ['Nomor HP tidak valid. Gunakan format: 08xxx']);
        }

        $fileFoto = $this->request->getFile('foto_umkm');
        $validation = $this->validateUpload($fileFoto);
        if ($validation !== true) {
            return redirect()->back()->withInput()->with('errors', [$validation]);
        }
        
        if ($fileFoto && $fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            $namaFoto = date('Ymd_His') . '_' . $fileFoto->getRandomName();
            $this->optimizeImage($fileFoto, $namaFoto, 800, 80);
        } else {
            $namaFoto = 'default.jpg';
        }

        $umkmModel->save([
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'kategori' => implode(', ', (array)$this->request->getPost('kategori')),
            'pemilik'    => $this->request->getPost('pemilik'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'rt'         => $this->request->getPost('rt'),
            'produk'     => $this->request->getPost('produk'),
            'kontak_hp'  => $cleanedHP,
            'foto_umkm'  => $namaFoto
        ]);

        return redirect()->to('admin')->with('success', 'Data UMKM berhasil ditambahkan');
    }

    // DELETE
    public function delete($id)
    {
        $umkmModel = new UmkmModel();
        $umkm = $umkmModel->find($id);
        
        if ($umkm && $umkm['foto_umkm'] !== 'default.jpg') {
            $filePath = 'uploads/umkm/' . $umkm['foto_umkm'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        $umkmModel->delete($id);
        return redirect()->to('admin')->with('success', 'Data UMKM berhasil dihapus');
    }

    // EDIT
    public function edit($id)
    {
        $umkmModel = new UmkmModel();
        $wilayahModel = new WilayahModel();

        $data['umkm'] = $umkmModel->find($id);
        $data['wilayah'] = $wilayahModel->findAll();

        if (empty($data['umkm'])) {
            return redirect()->to('admin'); 
        }

        return view('admin/edit', $data);
    }

    // UPDATE
    public function update($id)
    {
        $umkmModel = new UmkmModel();

        $hp = $this->request->getPost('kontak_hp');
        $cleanedHP = $this->cleanPhoneNumber($hp);
        
        if ($cleanedHP === false && !empty($hp)) {
            return redirect()->back()->withInput()->with('errors', ['Nomor HP tidak valid.']);
        }

        $fileFoto = $this->request->getFile('foto_umkm');
        $validation = $this->validateUpload($fileFoto);
        if ($validation !== true) {
            return redirect()->back()->withInput()->with('errors', [$validation]);
        }
        
        if ($fileFoto && $fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            $namaFoto = date('Ymd_His') . '_' . $fileFoto->getRandomName();
            $this->optimizeImage($fileFoto, $namaFoto, 800, 80);
            
            $umkmLama = $umkmModel->find($id);
            if ($umkmLama && $umkmLama['foto_umkm'] !== 'default.jpg') {
                $filePathLama = 'uploads/umkm/' . $umkmLama['foto_umkm'];
                if (file_exists($filePathLama)) unlink($filePathLama);
            }
        } else {
            $namaFoto = $this->request->getPost('foto_lama');
            if (empty($namaFoto)) $namaFoto = 'default.jpg';
        }

        $umkmModel->update($id, [
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'kategori' => implode(', ', (array)$this->request->getPost('kategori')),
            'pemilik'    => $this->request->getPost('pemilik'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'rt'         => $this->request->getPost('rt'),
            'produk'     => $this->request->getPost('produk'),
            'kontak_hp'  => $cleanedHP,
            'foto_umkm'  => $namaFoto
        ]);

        return redirect()->to('admin')->with('success', 'Data UMKM berhasil diperbarui');
    }

    // EXPORT
    public function export()
    {
        $umkmModel = new UmkmModel();
        $umkm = $umkmModel->getUmkmLengkap();
        $filename = 'Data_UMKM_Desa_Candimulyo_' . date('Y-m-d_H-i') . '.csv';

        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: text/csv; charset=utf-8");

        $file = fopen('php://output', 'w');
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

        $header = ['No', 'Kategori', 'Nama Usaha', 'Pemilik', 'Wilayah', 'RW', 'RT', 'Produk', 'Kontak HP', 'Tanggal Input'];
        fputcsv($file, $header);

        foreach ($umkm as $key => $row) {
            $data = [
                $key + 1,
                $row['kategori'],
                $row['nama_usaha'],
                $row['pemilik'],
                $row['nama_wilayah'],
                $row['rw'],
                'RT ' . $row['rt'], 
                $row['produk'],
                "'" . $row['kontak_hp'],
                $row['created_at']
            ];
            fputcsv($file, $data);
        }
        fclose($file);
        exit;
    }

    // HALAMAN GANTI PASSWORD
    public function ganti_password()
    {
        return view('admin/ganti_password');
    }

    // PROSES GANTI PASSWORD (YANG TADINYA ERROR 500)
    public function update_password()
    {
        $userModel = new UserModel();
        
        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasiPassword = $this->request->getPost('konfirmasi_password');
        
        // 1. Validasi Input Kosong
        if (empty($passwordLama) || empty($passwordBaru) || empty($konfirmasiPassword)) {
            return redirect()->back()->with('error', 'Semua field harus diisi!');
        }
        
        // 2. Validasi Match
        if ($passwordBaru !== $konfirmasiPassword) {
            return redirect()->back()->with('error', 'Password baru dan konfirmasi tidak cocok!');
        }
        
        // 3. Validasi Panjang
        if (strlen($passwordBaru) < 6) {
            return redirect()->back()->with('error', 'Password minimal 6 karakter!');
        }
        
        // 4. Ambil User dari Session
        $userId = session()->get('id_user');
        $user = $userModel->find($userId);
        
        // === FIX UNTUK ERROR 500 ===
        // Jika user di database tidak ditemukan (misal habis reset DB), paksa logout
        if (!$user) {
            session()->destroy();
            return redirect()->to('login')->with('msg', 'Sesi tidak valid atau database telah direset. Silakan login ulang.');
        }
        
        // 5. Verifikasi Password Lama
        if (!password_verify($passwordLama, $user['password_hash'])) {
            return redirect()->back()->with('error', 'Password lama salah!');
        }
        
        // 6. Update Password Baru
        $userModel->update($userId, [
            'password_hash' => password_hash($passwordBaru, PASSWORD_DEFAULT)
        ]);
        
        // Redirect kembali ke halaman ganti password dengan pesan SUKSES
        return redirect()->back()->with('success', 'Password berhasil diperbarui!');
    }
}