<?php

namespace App\Models;

use App\Enums\PurchaseStatus;
use CodeIgniter\Model;

class Purchase extends Model
{
    public function __construct()
    {
        parent::__construct();

        $this->validationRules      = [
            'client_id'  => 'required|is_not_unique[clients.id]',
            'product_id' => 'required|is_not_unique[products.id]',
            'quantity'   => 'required|integer',
            'total'      => 'required|decimal',
            'status'     => 'permit_empty|in_list[' . PurchaseStatus::values() . ']',
        ];
    }

    protected $table            = 'purchases';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'client_id',
        'product_id',
        'quantity',
        'total',
        'status'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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
