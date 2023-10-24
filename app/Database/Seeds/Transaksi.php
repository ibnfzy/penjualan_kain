<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Transaksi extends Seeder
{
    public function run()
    {
        $this->db->table('transaksi')->insert([
            'uid' => '08XRYu4z',
            'id_customer' => 1,
            'total_produk' => 22,
            'total_bayar' => 100000,
            'bukti_bayar' => '1698133469_0df662139365cf8de7a1.jpg',
            'batas_pembayaran' => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 Days')),
            'status_transaksi' => 'Pesanan berhasil diterima oleh pemesan'
        ]);

        $this->db->table('transaksi_detail')->insertBatch([
            [
                'id_transaksi' => 1,
                'id_produk' => 1,
                'id_produk_detail' => 3,
                'id_customer' => 1,
                'nama_produk' => 'KAIN',
                'label_varian' => 'Hijau Army',
                'kuantitas_produk' => 4,
                'harga_produk' => 13000,
                'subtotal' => 52000
            ],
            [
                'id_transaksi' => 1,
                'id_produk' => 1,
                'id_produk_detail' => 2,
                'id_customer' => 1,
                'nama_produk' => 'KAIN',
                'label_varian' => 'Biru Laut',
                'kuantitas_produk' => 4,
                'harga_produk' => 12000,
                'subtotal' => 48000
            ],
        ]);
    }
}