<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $db;
    public $cart;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->cart = \Config\Services::cart();
    }

    public function index(): string
    {
        return view('web/home');
    }

    public function katalog()
    {
        return view('web/katalog', [
            'data' => $this->db->table('produk')->get()->getResultArray()
        ]);
    }

    public function detail($id)
    {
        return view('web/detail', [
            'data' => $this->db->table('produk')->where('id_produk', $id)->get()->getRowArray()
        ]);
    }

    public function cart()
    {
        return view('web/cart');
    }

    public function add_barang()
    {
        $get = $this->db->table('produk_detail')->where('id_produk_detail', $this->request->getPost('id_produk_detail'))->get()->getRowArray();

        $getd = $this->db->table('produk')->where('id_produk', $get['id_produk'])->get()->getRowArray();

        $this->cart->insert([
            'id' => $get['id_produk'],
            'qty' => 1,
            'price' => $get['harga'],
            'name' => $getd['nama_barang'],
            'gambar' => $get['gambar'],
            'stok' => $get['stok']
        ]);

        return redirect()->to(base_url('Cart'));
    }

    public function remove_barang($rowId)
    {
        $this->cart->remove($rowId);

        return redirect()->to(base_url('Cart'));
    }

    public function clear_cart()
    {
        $destroy = new \CodeIgniterCart\Config\Services;

        $destroy->cart()->destroy();

        return redirect()->to(base_url('Cart'));
    }

    public function update_cart()
    {
        $rowid = $this->request->getPost('rowid');
        $qty = $this->request->getPost('qtybutton');
        $stok = $this->request->getPost('stok');
        $status = true;

        for ($i = 1; $i <= count($this->cart->contents()); $i++) {
            if ($qty[$i] > $stok[$i]) {
                $status = false;
                break;
            }

            $this->cart->update([
                'rowid' => $rowid[$i],
                'qty' => $qty[$i]
            ]);
        }

        if ($status == false) {
            return redirect()->to(base_url('Cart'))->with('type-status', 'error')
                ->with('message', 'Kuantitas barang melebihi stok');
        }

        return redirect()->to(base_url('Cart'))->with('type-status', 'success')
            ->with('message', 'Berhasil diperbaruhi');
    }
}