<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserLogin extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('login/user_login');
    }

    public function auth()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $this->db->table('customer')->where('username', $username)->get()->getRowArray();

        if ($data) {
            $password_data = $data['password'];

            $verify = password_verify($password ?? '', $password_data);

            if ($verify) {

                $sessionData = [
                    'id_customer' => $data['id_customer'],
                    'fullname_customer' => $data['fullname'],
                    'username_customer' => $data['username'],
                    'logged_in_customer' => TRUE,
                    'alamat_customer' => $data['alamat'],
                    'nomor_hp' => $data['nomor_hp'],
                    'kota_kab' => $data['kota_kab'],
                    'kec_desa' => $data['kec_desa']
                ];

                $session->set($sessionData);

                return redirect()->to(base_url('Panel'))->with('type-status', 'info')
                    ->with('message', 'Selamat Datang Kembali ' . $sessionData['fullname_customer']);
            } else {
                log_message('debug', 'Password Salah');
                return redirect()->to(base_url('Login'))->with('type-status', 'error')
                    ->with('message', 'Password tidak benar');
            }
        } else {
            log_message('debug', 'Username Salah');
            return redirect()->to(base_url('Login'))->with('type-status', 'error')
                ->with('message', 'Username tidak benar');
        }
    }

    public function logoff()
    {
        $session = session();

        $session->destroy();

        return redirect()->to(base_url('Login/User'));
    }

    public function signup()
    {
        return view('login/user_signup');
    }

    public function save_data()
    {
        $rules = [
            'username' => 'required|max_length[16]',
            'fullname' => 'required|max_length[150]',
            'password' => 'required',
            'confirm_password' => 'matches[password]',
            'alamat' => 'required',
            'nomor_hp' => 'required|max_length[13]',
            'kota_kab' => 'required',
            'kec_desa' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Daftar'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'fullname' => $this->request->getPost('fullname'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'alamat' => $this->request->getPost('alamat'),
            'nomor_hp' => $this->request->getPost('nomor_hp'),
            'kota_kab' => $this->request->getPost('kota_kab'),
            'kec_desa' => $this->request->getPost('kec_desa')
        ];

        $this->db->table('customer')->insert($data);

        return redirect()->to(base_url('Login'))->with('type-status', 'success')->with('message', 'Registrasi Berhasil');
    }
}