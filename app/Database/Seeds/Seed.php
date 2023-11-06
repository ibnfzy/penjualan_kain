<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Seed extends Seeder
{
    public function run()
    {
        $this->call('Admin');
        $this->call('Customer');
        $this->call('Produk');
        $this->call('InformasiToko');
        $this->call('Transaksi');
        $this->call('Pemilik');
        $this->call('Ongkir');
    }
}