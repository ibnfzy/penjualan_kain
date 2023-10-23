<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InformasiToko extends Seeder
{
    public function run()
    {
        $this->db->table('informasi_toko')->insert([
            'tentang' => 'Pusat Sarung Tenun Mamasa adalah tempat yang sempurna untuk menemukan sarung yang sesuai dengan kebutuhan Anda, karena mereka menawarkan beragam motif dan warna sarung yang sesuai dengan fungsinya masing-masing.',
            'alamat' => 'Mamasa',
            'kontak' => '6282194447942'
        ]);
    }
}