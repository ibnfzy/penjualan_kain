<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ongkir extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ongkir' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nama_kota' => [
                'type' => 'TEXT'
            ],
            'biaya_ongkir' => [
                'type' => 'INT'
            ]
        ]);

        $this->forge->addKey('id_ongkir', true);

        $this->forge->createTable('ongkir');
    }

    public function down()
    {
        $this->forge->dropTable('ongkir');
    }
}