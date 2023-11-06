<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserLogin extends BaseController
{
    protected $db;
    public $rules;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->rules = [
            'is_unique' => ''
        ];
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
                    'kec_desa' => $data['kec_desa'],
                    'id_ongkir' => $data['id_ongkir'],
                    'alamat' => $data['alamat']
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

        return redirect()->to(base_url('Login'));
    }

    public function signup()
    {
        return view('login/user_signup', [
            'ongkir' => $this->db->table('ongkir')->get()->getResultArray()
        ]);
    }

    public function save_data()
    {
        $rules = [
            'username' => 'required|max_length[16]|is_unique[customer.username]',
            'fullname' => 'required|max_length[150]',
            'password' => 'required',
            'confirm_password' => 'matches[password]',
            'alamat' => 'required',
            'nomor_hp' => 'required|max_length[13]',
            'kota_kab' => 'required',
            'kec_desa' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Daftar'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $getKota = $this->db->table('ongkir')->where('id_ongkir', $this->request->getPost('kota_kab'))->get()->getRowArray();

        $data = [
            'username' => $this->request->getPost('username'),
            'fullname' => $this->request->getPost('fullname'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'alamat' => $this->request->getPost('alamat'),
            'nomor_hp' => $this->request->getPost('nomor_hp'),
            'kota_kab' => $getKota['nama_kota'],
            'kec_desa' => $this->request->getPost('kec_desa'),
            'id_ongkir' => $this->request->getPost('kota_kab')
        ];

        $this->db->table('customer')->insert($data);

        return redirect()->to(base_url('Login'))->with('type-status', 'success')->with('message', 'Registrasi Berhasil');
    }
}