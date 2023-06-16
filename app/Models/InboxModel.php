<?php

namespace App\Models;

use CodeIgniter\Model;

class InboxModel extends Model
{
    protected $DBGroup      = 'default';
    protected $table      = 'inbox';
    protected $primaryKey = 'id_inbox';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields    = true;
    protected $allowedFields = ['id_inbox', 'email_inbox', 'tipe_inbox', 'deskripsi_inbox', 'status_inbox', 'tanggal_inbox', 'file_inbox', 'id_user'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}