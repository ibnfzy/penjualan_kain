<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Ongkir extends Seeder
{
    public function run()
    {
        $this->db->table("ongkir")->insertBatch([
            [
                'nama_kota' => 'Makassar',
                'biaya_ongkir' => 40000
            ],
            [
                'nama_kota' => 'Mamasa',
                'biaya_ongkir' => 0
            ],
            [
                'nama_kota' => 'Barru',
                'biaya_ongkir' => 20000
            ],
            [
                'nama_kota' => 'Maros',
                'biaya_ongkir' => 30000
            ],
        ]);
    }
}