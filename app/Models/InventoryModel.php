<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $DBGroup      = 'default';
    protected $table      = 'inventory';
    protected $primaryKey = 'id_inventory';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields    = true;
    protected $allowedFields = ['no_surat', 'kode_surat', 'perihal_surat', 'tanggal_surat', 'tanggal_terima_surat', 'asal_surat', 'tindak_lanjut'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}