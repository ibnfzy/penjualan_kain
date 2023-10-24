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
            'data' => $this->db->table('transaksi')->orderBy('id_transaksi', 'DESC')->get()->getResultArray()
        ]);
    }

    public function customer()
    {
        return view('admin/customer', [
            'data' => $this->db->table('customer')->get()->getResultArray()
        ]);
    }

    public function invoice(int $id, int $id_customer)
    {
        return view('admin/invoice', [
            'dataTransaksi' => $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray(),
            'dataDetail' => $this->db->table('transaksi_detail')->where('id_transaksi', $id)->get()->getResultArray(),
            'dataToko' => $this->db->table('informasi_toko')->where('id_toko', '1')->get()->getRowArray(),
            'dataUser' => $this->db->table('customer')->where('id_customer', $id_customer)->get()->getRowArray()
        ]);
    }

    public function validasi($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Pesanan sedang diproses'
        ]);

        return redirect()->to(previous_url())->with('type-status', 'success')
            ->with('message', 'Bukti pembayaran berhasil divalidasi');
    }

    public function kirim($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Pesanan sedang menuju lokasi pemesan'
        ]);

        return redirect()->to(previous_url())->with('type-status', 'success')
            ->with('message', 'Pesanan sedang menuju lokasi pemesan');
    }
}