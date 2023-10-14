<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'deskripsi_produk' => [
                'type' => 'TEXT'
            ]
        ]);

        $this->forge->addKey('id_produk', true);

        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}