<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Inventory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_inventory' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_surat' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'kode_surat' => [
                'type' => 'INT',
                'constraint' => '20',
            ],
            'perihal_surat' => [
                'type' => 'TEXT',
            ],
            'tanggal_surat' => [
                'type' => 'DATE',
            ],
            'tanggal_terima_surat' => [
                'type' => 'DATE',
            ],
            'asal_surat' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'tindak_lanjut' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id_inventory', true);
        $this->forge->createTable('inventory');
    }

    public function down()
    {
        $this->forge->dropTable('inventory');
    }
}
