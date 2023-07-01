<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BaseSeeder extends Seeder
{
    public function run()
    {
        $role = [
            [
                'id_role' => '0',
                'nama_role' => 'Admin',
            ],
            [
                'id_role' => '1',
                'nama_role' => 'Tendik',
            ],
            [
                'id_role' => '2',
                'nama_role' => 'Dosen',
            ],
            [
                'id_role' => '3',
                'nama_role' => 'Mahasiswa',
            ],
        ];

        $user = [
            [
                'nama_user' => 'Admin',
                'nomor_induk_user' => '0',
                'email_user' => 'admin@pnj.com',
                'password_user' => password_hash('0', PASSWORD_BCRYPT),
                'id_role' => '0',
                'status_user' => '1',
            ],
            [
                'nama_user' => 'Tendik',
                'nomor_induk_user' => '1',
                'email_user' => 'tendik@pnj.com',
                'password_user' => password_hash('1', PASSWORD_BCRYPT),
                'id_role' => '1',
                'status_user' => '1',
            ],
            [
                'nama_user' => 'Dosen',
                'nomor_induk_user' => '2',
                'email_user' => 'dosen@pnj.com',
                'password_user' => password_hash('2', PASSWORD_BCRYPT),
                'id_role' => '2',
                'status_user' => '1',
            ],
            [
                'nama_user' => 'Mahasiswa',
                'nomor_induk_user' => '3',
                'email_user' => 'mhsw@pnj.com',
                'password_user' => password_hash('3', PASSWORD_BCRYPT),
                'id_role' => '3',
                'status_user' => '1',
            ],
        ];

        $tipe = [
            [
                'id_tipe' => '0',
                'nama_tipe' => 'SK',
            ],
            [
                'id_tipe' => '1',
                'nama_tipe' => 'Surat Tugas',
            ],
            [
                'id_tipe' => '2',
                'nama_tipe' => 'Surat Undangan',
            ],
            [
                'id_tipe' => '3',
                'nama_tipe' => 'Surat Pengantar',
            ],
            [
                'id_tipe' => '4',
                'nama_tipe' => 'Lembar Pengesahan',
            ],
            [
                'id_tipe' => '5',
                'nama_tipe' => 'Lainnya',
            ],
        ];

        $this->db->table('roles')->insertBatch($role);
        $this->db->table('users')->insertBatch($user);
        $this->db->table('tipe')->insertBatch($tipe);

        //php spark db:seed BaseSeeder
    }
}
