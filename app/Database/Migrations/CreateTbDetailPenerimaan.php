<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbDetailPenerimaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detail_penerimaan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_penerimaan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_barang' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jumlah_penerimaan' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'harga_penerimaan' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_detail_penerimaan', true);

        
        $this->forge->createTable('tb_detail_penerimaan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_detail_penerimaan');
    }
}