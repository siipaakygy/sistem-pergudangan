<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbPenerimaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_penerimaan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_penerimaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'unique'     => true,
            ],
            'tanggal_penerimaan' => [
                'type' => 'DATE',
            ],
            'id_supplier' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'status_penerimaan' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'approved'],
                'default'    => 'draft',
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_penerimaan', true);
        $this->forge->addForeignKey('id_user', 'tb_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_penerimaan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_penerimaan');
    }
}