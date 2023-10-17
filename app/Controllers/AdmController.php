<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdmController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/home');
    }

    public function transaksi()
    {
        return view('admin/transaksi', [
            'data' => $this->db->table('transaksi')->get()->getResultArray()
        ]);
    }

    public function customer()
    {
        return view('admin/customer', [
            'data' => $this->db->table('customer')->get()->getResultArray()
        ]);
    }
}