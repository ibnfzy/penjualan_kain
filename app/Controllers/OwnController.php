<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\RawSql;

class OwnController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('owner/laporan_transaksi', [
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
            'data' => $this->db->table('transaksi')->where('status_transaksi', 'Pesanan berhasil diterima oleh pemesan')->like('tgl_checkout', $where, 'right')->orderBy('id_transaksi', 'DESC')->get()->getResultArray(),
            'type' => $type,
            'date' => $date
        ]);
    }

    public function customer()
    {
        return view('owner/customer', [
            'data' => $this->db->table('customer')->get()->getResultArray()
        ]);
    }

    public function testimoni()
    {
        return view('owner/testimoni', [
            'data' => $this->db->table('review')->get()->getResultArray()
        ]);
    }
}