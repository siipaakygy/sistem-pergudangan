<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbDetailSuratJalan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detail_sj' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat_jalan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_barang' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jumlah_sj' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id_detail_sj', true);
        $this->forge->addForeignKey('id_surat_jalan', 'tb_surat_jalan', 'id_surat_jalan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_detail_surat_jalan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_detail_surat_jalan');
    }
}