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

        session()->set("total_transaksi", count($this->db->table('transaksi')->where('status_transaksi', 'Menunggu Bukti Pembayaran')->orWhere('status_transaksi', 'Menunggu Validasi Bukti Bayar')->get()->getResultArray()));
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
            'data' => $this->db->table('transaksi')->orderBy('id_transaksi', 'DESC')->get()->getResultArray(),
            'cust' => $this->db->table('customer')->get()->getResultArray(),
        ]);
    }

    public function proses_transaksi()
    {
        helper('text');
        $uid = random_string();
        $getCust = $this->db->table('customer')->where('id_customer', $this->request->getPost('id_customer'))->get()->getRowArray();

        $proses = $this->db->table('transaksi')->insert([
            'uid' => $uid,
            'id_customer' => $this->request->getPost('id_customer'),
            'total_produk' => 0,
            'total_bayar' => 0,
            'batas_pembayaran' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 Days')),
            'status_transaksi' => 'Transaksi Offline',
            'id_ongkir' => '2',
            'alamat' => 'OFFLINE',
            'kota_kab' => 'Mamasa',
            'kec_desa' => 'OFFLINE',
            'nomor_hp' => $getCust['nomor_hp'],
            'pesan' => ''
        ]);

        $getTransaksi = $this->db->table('transaksi')->where('uid', $uid)->get()->getRowArray();

        return redirect()->to(base_url('AdmPanel/Transaksi/' . $getTransaksi['id_transaksi'] . '/' . $this->request->getPost('id_customer')));
    }

    public function customer()
    {
        return view('admin/customer', [
            'data' => $this->db->table('customer')->get()->getResultArray()
        ]);
    }

    public function transaksi_selesai($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Pesanan berhasil diterima oleh pemesan'
        ]);

        return redirect()->to(previous_url())->with('type-status', 'success')
            ->with('message', 'Transaksi selesai');
    }

    public function tambah_produk_transaksi($id, $id_customer)
    {
        $getProduk = $this->db->table('produk_detail')->where('id_produk_detail', $this->request->getPost('id_produk_detail'))->get()->getRowArray();
        $getProduks = $this->db->table('produk')->where('id_produk', $getProduk['id_produk'])->get()->getRowArray();

        $getTransaksi = $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray();

        $getTransaksiDetail = $this->db->table('transaksi_detail')->where('id_produk_detail', $getProduk['id_produk_detaiil'])->get()->getRowArray();

        if (!$getTransaksiDetail) {
            $this->db->table('transaksi_detail')->insert([
                'id_transaksi' => $id,
                'id_produk' => $getProduk['id_produk'],
                'id_produk_detail' => $getProduk['id_produk_detail'],
                'id_customer' => $id_customer,
                'nama_produk' => $getProduks['nama_produk'],
                'kuantitas_produk' => $this->request->getPost('qty'),
                'harga_produk' => $getProduk['harga_produk'],
                'label_varian' => $getProduk['label_warna_produk'],
                'subtotal' => $getProduk['harga_produk'] * $this->request->getPost('qty')
            ]);
        } else {
            $this->db->table('transaksi_detail')->where('id_transaksi_detail', $getTransaksiDetail['id_transaksi_detail'])->update([
                'id_transaksi' => $id,
                'id_produk' => $getProduk['id_produk'],
                'id_produk_detail' => $getProduk['id_produk_detail'],
                'id_customer' => $id_customer,
                'nama_produk' => $getProduks['nama_produk'],
                'kuantitas_produk' => $this->request->getPost('qty'),
                'harga_produk' => $getProduk['harga_produk'],
                'label_varian' => $getProduk['label_warna_produk'],
                'subtotal' => $getProduk['harga_produk'] * $this->request->getPost('qty')
            ]);
        }

        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'total_produk' => $getTransaksi['total_produk'] + $this->request->getPost('qty'),
            'total_bayar' => $getTransaksi['total_bayar'] + $getProduk['harga_produk'],
        ]);

        return redirect()->to(previous_url())->with('type-status', 'success')
            ->with('message', 'Berhasil menambahkan produk');
    }

    public function invoice(int $id, int $id_customer)
    {
        return view('admin/invoice', [
            'dataTransaksi' => $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray(),
            'dataDetail' => $this->db->table('transaksi_detail')->where('id_transaksi', $id)->get()->getResultArray(),
            'dataToko' => $this->db->table('informasi_toko')->where('id_toko', '1')->get()->getRowArray(),
            'dataUser' => $this->db->table('customer')->where('id_customer', $id_customer)->get()->getRowArray(),

            'produk' => $this->db->table('produk_detail')->get()->getResultArray()
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
                $where = date('Y-m', strtotime((string) $this->request->getPost('bulan')));
                $date = date('F Y', strtotime((string) $this->request->getPost('bulan')));
                break;

            case 'tahun':
                $where = $this->request->getPost('tahun');
                $date = $this->request->getPost('tahun');
                break;

            default:
                $date = $this->request->getPost('bulan');
                $date = date('l Y', strtotime((string) $this->request->getPost('bulan')));
                break;
        }

        return view('admin/render_laporan_transaksi', [
            'data' => $this->db->table('transaksi')->where('status_transaksi', 'Pesanan berhasil diterima oleh pemesan')->like('tgl_checkout', $where, 'right')->orderBy('id_transaksi', 'DESC')->get()->getResultArray(),
            'type' => $type,
            'date' => $date
        ]);
    }

    public function hapus_transaksi($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->delete();
        $this->db->table('transaksi_detail')->where('id_transaksi', $id)->delete();

        return redirect()->to(base_url('AdmPanel/Transaksi'))->with('type-status', 'success')
            ->with('message', 'Transaksi Berhasil terhapus');
    }
}
