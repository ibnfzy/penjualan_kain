<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Customer extends Seeder
{
    public function run()
    {
        $this->db->table('customer')->insert([
            'fullname' => 'Pelanggan',
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'alamat' => 'Jl Toddopuli',
            'kota_kab' => 'Makassar',
            'kec_desa' => 'Manggala',
            'nomor_hp' => '6285158668102'
        ]);
    }
}