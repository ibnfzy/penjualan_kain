<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Produk extends Seeder
{
    public function run()
    {
        $this->db->table("produk")->insert([
            'nama_produk' => 'KAIN',
            'deskripsi_produk' => '<p>KAIN INDAH</p>'
        ]);

        $this->db->table('produk_detail')->insertBatch([
            [
                'id_produk' => '1',
                'warna_produk' => '#ff0000',
                'label_warna_produk' => 'Merah Merona',
                'harga_produk' => '12000',
                'stok_produk' => '32',
                'gambar_produk' => '1697468635_0f7c34f7f40be4e47e6b.png'
            ],
            [
                'id_produk' => '1',
                'warna_produk' => '#00bfff',
                'label_warna_produk' => 'Biru Laut',
                'harga_produk' => '12000',
                'stok_produk' => '11',
                'gambar_produk' => 'JULYBOY CHANNEL.png'
            ],
            [
                'id_produk' => '1',
                'warna_produk' => '#297e11',
                'label_warna_produk' => 'Hijau Army',
                'harga_produk' => '13000',
                'stok_produk' => '12',
                'gambar_produk' => '1.jpg'
            ],
            [
                'id_produk' => '1',
                'warna_produk' => '#8c00ff',
                'label_warna_produk' => 'Ungu',
                'harga_produk' => '12000',
                'stok_produk' => '33',
                'gambar_produk' => '1.jpg'
            ],
            [
                'id_produk' => '1',
                'warna_produk' => '#ffffff',
                'label_warna_produk' => 'Putih',
                'harga_produk' => '12000',
                'stok_produk' => '40',
                'gambar_produk' => 'JULYBOY CHANNEL.png'
            ],
        ]);
    }
}