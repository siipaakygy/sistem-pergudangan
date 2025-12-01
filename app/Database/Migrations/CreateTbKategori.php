<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbKategori extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'unique'     => true,
            ],
            'name_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('tb_kategori');
    }

    public function down()
    {
        $this->forge->dropTable('tb_kategori');
    }
}