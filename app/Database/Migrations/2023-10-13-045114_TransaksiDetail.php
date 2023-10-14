<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransaksiDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi_detail' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_transaksi' => [
                'type' => 'INT'
            ],
            'id_produk' => [
                'type' => 'INT'
            ],
            'id_customer' => [
                'type' => 'INT'
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'kuantitas_produk' => [
                'type' => 'INT'
            ],
            'harga_produk' => [
                'type' => 'INT'
            ]
        ]);

        $this->forge->addKey('id_transaksi_detail', true);

        $this->forge->createTable('transaksi_detail');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_detail');
    }
}