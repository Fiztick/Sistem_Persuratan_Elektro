<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_user' => 'Admin',
                'nomor_induk_user' => '0',
                'password_user' => password_hash('admin', PASSWORD_BCRYPT),
                'jabatan_user' => '0',
            ],
            [
                'nama_user' => 'Tendik',
                'nomor_induk_user' => '1',
                'password_user' => password_hash('admin', PASSWORD_BCRYPT),
                'jabatan_user' => '1',
            ],
            [
                'nama_user' => 'Dosen',
                'nomor_induk_user' => '2',
                'password_user' => password_hash('admin', PASSWORD_BCRYPT),
                'jabatan_user' => '2',
            ],
            [
                'nama_user' => 'Mahasiswa',
                'nomor_induk_user' => '3',
                'password_user' => password_hash('admin', PASSWORD_BCRYPT),
                'jabatan_user' => '3',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
