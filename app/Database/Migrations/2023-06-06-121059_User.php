<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_user' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'nomor_induk_user' => [
                'type' => 'INT',
                'constraint' => '20',
                'unique' => 'true',
            ],
            'password_user' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
            ],
            'jabatan_user' => [
                'type' => 'INT',
                'constraint' => '1',
                'comment' => '0 = Admin, 1 = Tendik, 2 = Dosen, 3 = Mahasiswa',
                'unsigned'       => true,
            ],
            'status_user' => [
                'type' => 'BOOLEAN',
                'comment' => '0 = Nonaktif, 1 = Aktif',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('users');
        $this->forge->addForeignKey('jabatan_user', 'roles', 'id_role', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
