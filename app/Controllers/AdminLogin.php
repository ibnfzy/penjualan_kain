<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminLogin extends BaseController
{

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('login/admin');
    }

    public function auth()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $this->db->table('admin')->where('username', $username)->get()->getRowArray();

        if ($data) {
            $password_data = $data['password'];
            $id = $data['id_admin'];

            $verify = password_verify($password ?? '', $password_data);

            if ($verify) {
                $sessionData = [
                    'id_admin' => $data['id_admin'],
                    'fullname' => $data['fullname'],
                    'username' => $data['username'],
                    'logged_in_admin' => TRUE
                ];

                $session->set($sessionData);
                // $session->markAsTempdata('logged_in_admin', 1800); //timeout 30 menit

                return redirect()->to(base_url('AdmPanel'))->with('type-status', 'info')
                    ->with('message', 'Selamat Datang Kembali ' . $sessionData['fullname']);
            } else {
                return redirect()->to(base_url('Adm/Login'))->with('type-status', 'error')
                    ->with('message', 'Password tidak benar');
            }
        } else {
            return redirect()->to(base_url('Adm/Login'))->with('type-status', 'error')
                ->with('message', 'Username tidak benar');
        }
    }

    public function logoff()
    {
        $session = session();

        $session->destroy();

        return redirect()->to(base_url('Adm/Login'));
    }
}