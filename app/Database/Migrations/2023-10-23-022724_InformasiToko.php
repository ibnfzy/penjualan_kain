<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InformasiToko extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_toko' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'tentang' => [
                'type' => 'TEXT'
            ],
            'alamat' => [
                'type' => 'TEXT'
            ],
            'kontak' => [
                'type' => 'VARCHAR',
                'constraint' => 13
            ]
        ]);

        $this->forge->addKey('id_toko', true);

        $this->forge->createTable('informasi_toko');
    }

    public function down()
    {
        $this->forge->dropTable('informasi_toko');
    }
}