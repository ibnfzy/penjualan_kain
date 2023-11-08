<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'uid' => [
                'type' => 'TEXT'
            ],
            'id_customer' => [
                'type' => 'INT'
            ],
            'id_ongkir' => [
                'type' => 'INT'
            ],
            'total_produk' => [
                'type' => 'INT'
            ],
            'total_bayar' => [
                'type' => 'INT'
            ],
            'bukti_bayar' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'tgl_checkout' => [
                'type' => 'DATE',
                'default' => new RawSql('(CURRENT_DATE)')
            ],
            'batas_pembayaran' => [
                'type' => 'DATE'
            ],
            'status_transaksi' => [
                'type' => 'VARCHAR',
                'default' => 'Menunggu Bukti Pembayaran',
                'constraint' => 255
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
            ],
        ]);

        $this->forge->addKey('id_transaksi', true);

        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}