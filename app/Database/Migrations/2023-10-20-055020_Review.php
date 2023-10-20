<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Review extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_review' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_produk' => [
                'type' => 'INT'
            ],
            'id_customer' => [
                'type' => 'INT'
            ],
            'bintang' => [
                'type' => 'INT'
            ],
            'deskripsi' => [
                'type' => 'TEXT'
            ],
            'insert_datetime' => [
                'type' => 'DATETIME',
                'default' => new RawSql('(NOW())')
            ]
        ]);

        $this->forge->addKey('id_review', true);

        $this->forge->createTable('review');
    }

    public function down()
    {
        $this->forge->dropTable('review');
    }
}