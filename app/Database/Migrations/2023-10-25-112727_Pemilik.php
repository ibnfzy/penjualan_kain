<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemilik extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pemilik' => [
                'type' => 'INT',
                'auto_increment' => true
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
            ]
        ]);

        $this->forge->addKey('id_pemilik', true);

        $this->forge->createTable('pemilik');
    }

    public function down()
    {
        $this->forge->dropTable('pemilik');
    }
}