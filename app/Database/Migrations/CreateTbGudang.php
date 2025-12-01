<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbGudang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_gudang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_gudang' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'unique'     => true,
            ],
            'name_gudang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'lokasi_gudang' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_gudang', true);
        $this->forge->createTable('tb_gudang');
    }

    public function down()
    {
        $this->forge->dropTable('tb_gudang');
    }
}