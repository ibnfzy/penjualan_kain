<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_customer' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_ongkir' => [
                'type' => 'INT'
            ],
            'fullname' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'password' => [
                'type' => 'TEXT'
            ],
            'alamat' => [
                'type' => 'TEXT'
            ],
            'kota_kab' => [
                'type' => 'TEXT'
            ],
            'kec_desa' => [
                'type' => 'TEXT'
            ],
            'nomor_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 13
            ]
        ]);

        $this->forge->addKey('id_customer', true);

        $this->forge->createTable('customer');
    }

    public function down()
    {
        $this->forge->dropTable('customer');
    }
}