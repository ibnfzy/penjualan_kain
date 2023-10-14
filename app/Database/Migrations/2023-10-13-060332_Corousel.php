<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Corousel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_corousel' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'gambar' => [
                'type' => 'TEXT'
            ]
        ]);

        $this->forge->addKey('id_corousel', true);

        $this->forge->createTable('corousel');
    }

    public function down()
    {
        $this->forge->dropTable('corousel');
    }
}