<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\RawSql;

class AdmController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/home', [
            'plaris' => $this->db->query('SELECT DISTINCT id_produk, count(id_produk) as total_transaksi, nama_produk FROM `transaksi_detail` LIMIT 15')->getResultArray(),
            'toko' => $this->db->table('informasi_toko')->where('id_toko', 1)->get()->getRowArray(),
        ]);
    }

    public function informasiToko()
    {
        $rules = [
            'kontak' => 'required',
            'alamat' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('informasi_toko')->where('id_toko', 1)->update([
            'kontak' => $this->request->getPost('kontak'),
            'alamat' => $this->request->getPost('alamat'),
        ]);

        return redirect()->to(base_url('AdmPanel'))->with('type-status', 'success')
            ->with('message', 'Data berhasil diubah');
    }

    public function tentangToko()
    {
        $rules = [
            'tentang' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('informasi_toko')->where('id_toko', 1)->update([
            'tentang' => $this->request->getPost('tentang'),
        ]);

        return redirect()->to(base_url('AdmPanel'))->with('type-status', 'success')
            ->with('message', 'Data berhasil diubah');
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

    public function laporan_transaksi()
    {
        return view('admin/laporan_transaksi', [
            'data' => $this->db->table('transaksi')->select(new RawSql('DISTINCT YEAR(tgl_checkout) as tahun'))->get()->getResultArray()
        ]);
    }

    public function render_laporan_transaksi()
    {
        $type = $this->request->getPost('views-control');

        switch ($type) {
            case 'bulan':
                $where = date('Y-m', strtotime($this->request->getPost('bulan')));
                $date = date('F Y', strtotime($this->request->getPost('bulan')));
                break;

            case 'tahun':
                $where = $this->request->getPost('tahun');
                $date = $this->request->getPost('tahun');
                break;

            default:
                $date = $this->request->getPost('bulan');
                $date = date('l Y', strtotime($this->request->getPost('bulan')));
                break;
        }

        return view('admin/render_laporan_transaksi', [
            'data' => $this->db->table('transaksi')->like('tgl_checkout', $where, 'right')->orderBy('id_transaksi', 'DESC')->get()->getResultArray(),
            'type' => $type,
            'date' => $date
        ]);
    }
}