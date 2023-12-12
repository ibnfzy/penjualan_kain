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
        return view('web/home', [
            'rekom' => $this->db->table('produk')->orderBy('id_produk', 'RAND()')->get()->getResultArray(),
            'corousel' => $this->db->table('corousel')->orderBy('id_corousel', 'DESC')->get()->getResultArray(),
            'toko' => $this->db->table('informasi_toko')->where('id_toko', 1)->get()->getRowArray()
        ]);
    }

    public function search()
    {
        $data = $this->db->table('produk')->like('nama_produk', $this->request->getPost('search'))->get()->getResultArray();

        if ($data == null) {
            return redirect()->to(previous_url())->with('type-status', 'error')
                ->with('message', 'Data Tidak Ditemukan');
        }

        return view('web/katalog', [
            'data' => $data
        ]);
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
            'data' => $this->db->table('produk')->where('id_produk', $id)->get()->getRowArray(),
            'rekom' => $this->db->table('produk')->orderBy('id_produk', 'RAND()')->get()->getResultArray()
        ]);
    }

    public function cart()
    {
        $notice = false;
        if (!session()->get('logged_in_customer')) {
            return redirect()->to(previous_url())->with('type-status', 'error')->with('message', 'Silahkan Login terdahulu sebelum mengakses halaman keranjang');
            ;
        }

        foreach ($this->cart->contents() as $item) {
            $get = $this->db->table('produk_detail')->where('id_produk_detail', $item['id'])->get()->getRowArray();

            if ($get['stok_produk'] < $item['qty']) {
                $this->remove_barang($item['rowid']);
                $notice = true;
            } else {
                $this->cart->update([
                    'rowid' => $item['rowid'],
                    'stok' => $get['stok_produk']
                ]);
            }
        }

        return view('web/cart', [
            'notice_delete' => $notice
        ]);
    }

    public function add_barang()
    {
        sleep(5);
        
        $get = $this->db->table('produk_detail')->where('id_produk_detail', $this->request->getPost('id_produk_detail'))->get()->getRowArray();

        $getd = $this->db->table('produk')->where('id_produk', $get['id_produk'])->get()->getRowArray();

        if ($this->request->getPost('qty') > $get['stok_produk']) {
            return redirect()->to(previous_url())->with('type-status', 'error')
                ->with('message', 'Stok Tidak Mencukupi, silahkan hubungi toko');
        }

        $this->cart->insert([
            'id' => $get['id_produk_detail'],
            'id_produk' => $get['id_produk'],
            'qty' => $this->request->getPost('qty'),
            'price' => $get['harga_produk'],
            'name' => $getd['nama_produk'],
            'label_varian' => $get['label_warna_produk'],
            'gambar' => $get['gambar_produk'],
            'stok' => $get['stok_produk'],
            'id_customer' => session()->get('id_customer')
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

        for ($i = 0; $i < count($this->cart->contents()); $i++) {
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

    public function review_star($id)
    {
        $get = $this->db->table('review')->where('id_produk', $id)->get()->getResultArray();

        $rt = [];
        $i = 1;

        foreach ($get as $barang) {
            $rt[] = $barang['bintang'];
        }

        $nilai = array_sum($rt);

        $pbagi = count($rt);

        try {
            $rating = $nilai / $pbagi;
        } catch (\Throwable $th) {
            $rating = 0;
        }

        $nbulat = round($rating);
        $nbulat = ($nbulat > 5) ? 5 : $nbulat;
        $star = '';

        if ($nbulat == 1) {
            $star = '<i class="fa fa-star"></i>';

        } else if ($nbulat == 2) {
            $star = '<i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>';

        } else if ($nbulat == 3) {
            $star = '<i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>';

        } else if ($nbulat == 4) {
            $star = '<i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>';

        } else if ($nbulat == 5) {
            $star = '<i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>';

        }

        return $star;
    }

    public function total_review($id)
    {
        $get = $this->db->table('review')->where('id_produk', $id)->get()->getResultArray();

        return count($get);
    }

    public function review($id)
    {
        return $this->db->table('review')->where('id_produk', $id)->get()->getResultArray();
    }
}