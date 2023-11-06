<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\RawSql;

class Produk extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/produk', [
            'data' => $this->db->table('produk')->get()->getResultArray()
        ]);
    }

    public function new()
    {
        if (!session()->get('jumlah_varian')) {
            session()->set('jumlah_varian', 1);
        }

        return view('admin/produk_add');
    }

    public function tambah_varian()
    {
        $jumlah = $this->request->getPost('jumlah_varian');
        $jumlah = ($jumlah < 1) ? 1 : $jumlah;

        session()->set('jumlah_varian', $jumlah);

        return redirect()->to(base_url('AdmPanel/Produk/Tambah'));
    }

    public function create()
    {
        $rules = [
            'nama_produk' => 'required',
            'deskripsi_produk' => 'required',
            'warna_produk' => 'required',
            'harga_produk' => 'required',
            'stok_produk' => 'required',
            'gambar_produk' => 'is_image[gambar_produk]'
        ];


        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Produk/Tambah'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('produk')->insert([
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi_produk' => $this->request->getPost('deskripsi_produk')
        ]);

        $data = [];
        $getLastID = $this->db->table('produk')->selectMax('id_produk')->get()->getRowArray();
        $warna = $this->request->getPost('warna_produk');
        $harga = $this->request->getPost('harga_produk');
        $stok = $this->request->getPost('stok_produk');
        $gambar = $this->request->getFileMultiple('gambar_produk');
        $label = $this->request->getPost('label');

        for ($i = 0; $i < session()->get('jumlah_varian'); $i++) {
            $filename = $gambar[$i]->getRandomName();
            $data[] = [
                'id_produk' => $getLastID['id_produk'],
                'warna_produk' => $warna[$i],
                'harga_produk' => $harga[$i],
                'stok_produk' => $stok[$i],
                'gambar_produk' => $filename,
                'label_warna_produk' => $label[$i]
            ];

            if (!$gambar[$i]->hasMoved()) {
                $gambar[$i]->move('uploads', $filename);
            }
        }

        $this->db->table('produk_detail')->insertBatch($data);

        return redirect()->to(base_url('AdmPanel/Produk'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function delete($id)
    {
        $this->db->table('produk')->where('id_produk', $id)->delete();
        $this->db->table('produk_detail')->where('id_produk', $id)->delete();

        return redirect()->to(base_url('AdmPanel/Produk'))->with('type-status', 'success')
            ->with('message', 'Data berhasil dihapus');
    }

    public function getDetail($id)
    {
        return $this->response->setJSON($this->db->table('produk_detail')->where('id_produk', $id)->get()->getResultArray());
    }

    public function edit($id)
    {
        return view('admin/produk_edit', [
            'data' => $this->db->table('produk')->where('id_produk', $id)->get()->getRowArray(),
            'detail' => $this->db->table('produk_detail')->where('id_produk', $id)->get()->getResultArray(),
            'id' => $id
        ]);
    }

    public function update($id)
    {
        $rules = [
            'nama_produk' => 'required',
            'deskripsi_produk' => 'required',
            'warna_produk' => 'required',
            'harga_produk' => 'required',
            'stok_produk' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Produk/' . $id))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $this->db->table('produk')->where('id_produk', $id)->update([
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi_produk' => $this->request->getPost('deskripsi_produk')
        ]);

        $get = $this->db->table('produk_detail')->where('id_produk', $id)->get()->getResultArray();

        $id_detail = $this->request->getPost('id_detail');
        $warna = $this->request->getPost('warna_produk');
        $harga = $this->request->getPost('harga_produk');
        $stok = $this->request->getPost('stok_produk');
        $gambar = $this->request->getFileMultiple('gambar_produk');
        $label = $this->request->getPost('label');

        for ($i = 0; $i < count($get); $i++) {

            if ($gambar[$i]->isValid() && !$gambar[$i]->hasMoved()) {
                $filename = $gambar[$i]->getRandomName();
                $data = [
                    'warna_produk' => $warna[$i],
                    'harga_produk' => $harga[$i],
                    'stok_produk' => $stok[$i],
                    'gambar_produk' => $filename,
                    'label_warna_produk' => $label[$i]
                ];

                $gambar[$i]->move('uploads', $filename);
            } else {
                $data = [
                    'warna_produk' => $warna[$i],
                    'harga_produk' => $harga[$i],
                    'stok_produk' => $stok[$i],
                    'label_warna_produk' => $label[$i]
                ];
            }

            $this->db->table('produk_detail')->where('id_produk_detail', $id_detail[$i])->update($data);
        }

        return redirect()->to(base_url('AdmPanel/Produk'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function singleInsert()
    {
        $rules = [
            'id_produk' => 'required',
            'warna_produk' => 'required',
            'label' => 'required',
            'harga_produk' => 'required',
            'stok_produk' => 'required',
            'gambar_produk' => 'is_image[gambar_produk]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Produk'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $filename = $this->request->getFile('gambar_produk')->getRandomName();

        $this->db->table('produk_detail')->insert([
            'id_produk' => $this->request->getPost('id_produk'),
            'warna_produk' => $this->request->getPost('warna_produk'),
            'harga_produk' => $this->request->getPost('harga_produk'),
            'stok_produk' => $this->request->getPost('stok_produk'),
            'gambar_produk' => $filename,
            'label_warna_produk' => $this->request->getPost('label')
        ]);

        $img = $this->request->getFile('gambar_produk');

        if (!$img->hasMoved()) {
            $img->move('uploads', $filename);
        }

        return redirect()->to(base_url('AdmPanel/Produk'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }
}