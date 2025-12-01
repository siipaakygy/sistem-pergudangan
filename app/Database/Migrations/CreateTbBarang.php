<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'unique'     => true,
            ],
            'name_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'id_kategori' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_gudang' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'stok_barang' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'satuan_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_barang', true);
        $this->forge->addForeignKey('id_kategori', 'tb_kategori', 'id_kategori', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_gudang', 'tb_gudang', 'id_gudang', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_barang');
    }

    public function down()
    {
        $this->forge->dropTable('tb_barang');
    }
}