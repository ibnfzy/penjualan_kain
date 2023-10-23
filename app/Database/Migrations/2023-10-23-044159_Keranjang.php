<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keranjang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_keranjang' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_customer' => [
                'type' => 'INT'
            ],
            'rowid' => [
                'type' => 'TEXT'
            ],
            'id' => [
                'type' => 'INT'
            ],
            'id_produk' => [
                'type' => 'INT'
            ],
            'qty' => [
                'type' => 'INT'
            ],
            'price' => [
                'type' => 'INT'
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'label_varian' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'gambar' => [
                'type' => 'TEXT'
            ],
            'stok' => [
                'type' => 'INT'
            ],
            'subtotal' => [
                'type' => 'INT'
            ]
        ]);

        $this->forge->addKey('id_keranjang', true);

        $this->forge->createTable('keranjang');
    }

    public function down()
    {
        $this->forge->dropTable('keranjang');
    }
}