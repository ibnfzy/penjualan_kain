<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProdukDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk_detail' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_produk' => [
                'type' => 'INT'
            ],
            'warna_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'label_warna_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'harga_produk' => [
                'type' => 'INT'
            ],
            'stok_produk' => [
                'type' => 'INT'
            ],
            'gambar_produk' => [
                'type' => 'TEXT'
            ]
        ]);

        $this->forge->addKey('id_produk_detail', true);

        $this->forge->createTable('produk_detail');
    }

    public function down()
    {
        $this->forge->dropTable('produk_detail');
    }
}