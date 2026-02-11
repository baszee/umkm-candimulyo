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
        
        // 1. Ambil inputan
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 2. Cari user
        $data = $model->where('username', $username)->first();

        if ($data) {
            // PERBAIKAN: Ambil dari kolom 'password_hash'
            $pass_db = $data['password_hash']; 
            
            $verify = password_verify($password, $pass_db);

            if ($verify) {
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

    // --- FITUR DARURAT (HAPUS NANTI SETELAH BISA LOGIN) ---
    public function reset_paksa()
    {
        $userModel = new UserModel();
        
        // 1. Cek apakah user admin ada
        $admin = $userModel->where('username', 'admin')->first();
        
        if ($admin) {
            // 2. Update password jadi 'admin' (Hash valid)
            $userModel->update($admin['id_user'], [
                'password_hash' => password_hash('admin', PASSWORD_DEFAULT),
                'nama_lengkap'  => 'Administrator' // Sekalian isi biar gak error
            ]);
            echo "✅ SUKSES! Password user 'admin' sudah direset menjadi: <b>admin</b><br>";
            echo "<br><a href='".base_url('login')."'>Klik disini untuk Login</a>";
        } else {
            // 3. Kalau user admin hilang, buat baru
            $userModel->save([
                'username'      => 'admin',
                'password_hash' => password_hash('admin', PASSWORD_DEFAULT),
                'nama_lengkap'  => 'Administrator',
                'role'          => 'admin'
            ]);
            echo "✅ SUKSES! User 'admin' baru telah dibuat dengan password: <b>admin</b><br>";
            echo "<br><a href='".base_url('login')."'>Klik disini untuk Login</a>";
        }
    }
}