<?php

namespace App\Models;

use CodeIgniter\Model;

class TipeModel extends Model
{
    protected $DBGroup      = 'default';
    protected $table      = 'tipe';
    protected $primaryKey = 'id_tipe';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields    = true;
    protected $allowedFields = [];
}