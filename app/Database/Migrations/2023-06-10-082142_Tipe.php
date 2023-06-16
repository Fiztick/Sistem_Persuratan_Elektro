<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tipe extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tipe' => [
                'type'           => 'INT',
                'constraint'     => '1',
                'unsigned'       => true,
            ],
            'nama_tipe' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
        ]);
        $this->forge->addKey('id_tipe', true);
        $this->forge->createTable('tipe');
    }

    public function down()
    {
        $this->forge->dropTable('tipe');
    }
}
