<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\RawSql;

class UserController extends BaseController
{
    protected $db;
    public $cart;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->cart = \Config\Services::cart();
    }

    public function index()
    {
        return view('user/home');
    }

    public function simpan_keranjang()
    {
        $home = new Home;
        // dd($this->cart->contents());
        $this->db->table('keranjang')->insertBatch($this->cart->contents());

        $home->clear_cart();

        return redirect()->to(base_url('Panel/Cart'))->with('type-status', 'success')
            ->with('message', 'Berhasil menyimpan keranjang');
    }

    public function keranjang()
    {
        return view('user/cart', [
            'data' => $this->db->table('keranjang')->select(new RawSql('DISTINCT rowid'))->where('id_customer', session()->get('id_customer'))->orderBy('rowid', 'DESC')->get()->getResultArray()
        ]);
    }

    public function transaksi()
    {
        return view('user/transaksi', [
            'data' => $this->db->table('transaksi')->orderBy('id_transaksi', 'DESC')->get()->getResultArray()
        ]);
    }

    public function invoice($id)
    {
        return view('user/invoice', [
            'dataTransaksi' => $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray(),
            'dataDetail' => $this->db->table('transaksi_detail')->where('id_transaksi', $id)->get()->getResultArray(),
            'dataToko' => $this->db->table('toko_informasi')->where('id_toko', '1')->get()->getRowArray(),
            'dataUser' => $this->db->table('customer')->where('id_customer', session()->get('id_customer'))->get()->getRowArray()
        ]);
    }

    public function checkout()
    {
        helper('text');

        $home = new Home;

        if (isset($_SESSION['logged_in_cust']) and $_SESSION['logged_in_cust'] == TRUE) {
            $q = 0;
            $get = [];
            $data = [];
            $hargaarr = [];

            foreach ($this->cart->contents() as $item) {
                $produk = $this->db->table('produk')->where('id_produk', $item['id'])->get()->getRowArray();

                $get[] = $produk;
                $get[$q]['qty'] = $item['qty'];
                $get[$q]['total_harga'] = $item['qty'] * $item['price'];
                $stok = $produk['stok'] - $item['qty'];
                $hargaarr[] = $item['qty'] * $item['price'];

                $this->db->table('produk')->where('id_produk', $item['id'])->update([
                    'stok' => $stok
                ]);

                $q++;
            }

            $dataTransaksi = [
                'id_customer' => session()->get('id_customer'),
                'total_items' => count($get),
                'total_bayar' => array_sum($hargaarr),
                'batas_pembayaran' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 Days')),
                'status_transaksi' => 'Menunggu Bukti Pembayaran'
            ];

            $this->db->table('transaksi')->insert($dataTransaksi);
            $getLastID = $this->db->query('SELECT (LAST_INSERT_ID()) as id')->getRowArray();

            foreach ($get as $item) {
                $data[] = [
                    'id_transaksi' => $getLastID['id'],
                    'id_produk' => $item['id_produk'],
                    'id_customer' => session()->get('id_customer'),
                    'nama_produk' => $item['nama_produk'],
                    'kuantitas_produk' => $item['qty'],
                    'harga_produk' => $item['total_harga'],
                ];
            }

            $this->db->table('transaksi_detail')->insertBatch($data);

            $home->clear_cart();

            return redirect()->to(base_url('Panel/Transaksi'));
        } else {
            return redirect()->to(base_url('Login/User'))->with('type-status', 'error')
                ->with('message', 'Silahkan Login Terlebih Dahulu');
        }
    }
}