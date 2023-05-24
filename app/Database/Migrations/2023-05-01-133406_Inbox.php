<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Inbox extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_inbox' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email_inbox' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama_inbox' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'tipe_inbox' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ],
            'deskripsi_inbox' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'status_inbox' => [
                'type' => 'INT',
                'constraint' => '1',
                'default' => '0',
                'comment' => '0 = Pengajuan, 1 = Diproses, 2 = Diteruskan, 3 = Selesai',
            ],
            'file_inbox' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'tanggal_inbox datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id_inbox', true);
        $this->forge->createTable('inbox');
    }

    public function down()
    {
        $this->forge->dropTable('inbox');
    }
}
