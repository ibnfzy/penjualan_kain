<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Pemilik extends Seeder
{
    public function run()
    {
        $this->db->table('pemilik')->insert([
            'username' => 'pemilik',
            'fullname' => 'Pemilik',
            'password' => password_hash('pemilik', PASSWORD_DEFAULT),
        ]);
    }
}