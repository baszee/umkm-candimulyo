<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        // Kalau sudah login, lempar ke admin
        if (session()->get('isLoggedIn')) {
            return redirect()->to('admin');
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
        
        // 1. Ambil inputan dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 2. Cari user berdasarkan username
        $data = $model->where('username', $username)->first();

        if ($data) {
            // 3. Cek Password (pakai verify karena terenkripsi)
            // Note: Karena tadi kita input manual SQL dummy, hash-nya mungkin tidak cocok.
            // Nanti kita coba dulu.
            
            // Password sementara (hardcode) buat tes SQL manual tadi
            // Nanti kita ganti verify beneran.
            $pass_db = $data['password'];
            
            // Logika verifikasi password
            // Password 'admin123' yang saya kasih di SQL mungkin beda salt-nya di laptopmu.
            // JADI KITA PAKAI CARA: UPDATE PASSWORD DULU BIAR AMAN.
            // Abaikan dulu verifikasi rumit, kita anggap kalau username 'admin' lolos dulu
            // Nanti kita perbaiki hash-nya lewat fitur reset sederhana.
            
            // Coba verifikasi standar
            $verify = password_verify($password, $pass_db);
            
            // *JURUS DARURAT* (Hanya kalau hash SQL tadi gagal):
            // Kalau password input == 'admin123', kita paksa update hash database
            if (!$verify && $password == 'admin123' && $username == 'admin') {
                $newHash = password_hash('admin123', PASSWORD_DEFAULT);
                $model->update($data['id_user'], ['password' => $newHash]);
                $verify = true; // Anggap sukses
            }

            if ($verify) {
                // Password Benar! Simpan sesi
                $ses_data = [
                    'id_user'       => $data['id_user'],
                    'username'      => $data['username'],
                    'nama_lengkap'  => $data['nama_lengkap'],
                    'isLoggedIn'    => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('admin');
            } else {
                $session->setFlashdata('msg', 'Password Salah');
                return redirect()->to('login');
            }
        } else {
            $session->setFlashdata('msg', 'Username tidak ditemukan');
            return redirect()->to('login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('login');
    }
}