<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Admin extends Seeder
{
    public function run()
    {
        $this->db->table('admin')->insert([
            'username' => 'admin',
            'fullname' => 'Admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
        ]);
    }
}