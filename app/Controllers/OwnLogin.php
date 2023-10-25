<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OwnLogin extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('login/owner');
    }

    public function auth()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $this->db->table('pemilik')->where('username', $username)->get()->getRowArray();

        if ($data) {
            $password_data = $data['password'];

            $verify = password_verify($password ?? '', $password_data);

            if ($verify) {
                $sessionData = [
                    'id_pemilik' => $data['id_pemilik'],
                    'fullname_pemilik' => $data['fullname'],
                    'username_pemilik' => $data['username'],
                    'logged_in_pemilik' => TRUE
                ];

                $session->set($sessionData);
                // $session->markAsTempdata('logged_in_admin', 1800); //timeout 30 menit

                return redirect()->to(base_url('OwnPanel'))->with('type-status', 'info')
                    ->with('message', 'Selamat Datang Kembali ' . $sessionData['fullname_pemilik']);
            } else {
                return redirect()->to(base_url('Own/Login'))->with('type-status', 'error')
                    ->with('message', 'Password tidak benar');
            }
        } else {
            return redirect()->to(base_url('Own/Login'))->with('type-status', 'error')
                ->with('message', 'Username tidak benar');
        }
    }

    public function logoff()
    {
        $session = session();

        $session->destroy();

        return redirect()->to(base_url('Own/Login'));
    }
}