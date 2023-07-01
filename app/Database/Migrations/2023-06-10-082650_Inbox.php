<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Inbox extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_inbox' => [
                'type'           => 'VARCHAR',
                'constraint'     => '36',
            ],
            'email_inbox' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'deskripsi_inbox' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'file_inbox' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'status_inbox' => [
                'type' => 'INT',
                'constraint' => '1',
                'default' => '0',
                'comment' => '0 = Pengajuan, 1 = Diproses, 2 = Diteruskan, 3 = Selesai diambil, 4 = Selesai diemail',
                'unsigned'       => true,
            ],
            'tipe_inbox' => [
                'type' => 'INT',
                'constraint' => '1',
                'unsigned'       => true,
            ],
            'id_user' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'tanggal_inbox datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id_inbox', true);
        $this->forge->createTable('inbox');
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tipe_inbox', 'tipe', 'id_tipe', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('inbox');
    }
}
