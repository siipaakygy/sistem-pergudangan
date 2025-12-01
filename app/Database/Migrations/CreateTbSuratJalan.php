<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbSuratJalan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_jalan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_surat_jalan' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'unique'     => true,
            ],
            'tanggal_surat_jalan' => [
                'type' => 'DATE',
            ],
            'id_customer' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'status_surat_jalan' => [
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
        $this->forge->addKey('id_surat_jalan', true);
        $this->forge->addForeignKey('id_user', 'tb_user', 'id_user');
        $this->forge->createTable('tb_surat_jalan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_surat_jalan');
    }
}