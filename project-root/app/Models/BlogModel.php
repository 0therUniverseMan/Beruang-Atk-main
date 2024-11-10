<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table = 'biodata';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'first_name', 'last_name', 'email', 'gender', 'ip_address', 'name_car', 'car_model_year', 'created_at', 'updated_at'];

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false; // Enable soft deletes
    protected $protectFields = true;

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true; // Enable timestamps
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'first_name' => 'required|min_length[3]|max_length[255]',
        'last_name' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|valid_email',
        'gender' => 'required|in_list[Male,Female]',
        'ip_address' => 'required|valid_ip',
        'name_car' => 'permit_empty|string',
        'car_model_year' => 'permit_empty|integer',
    ];
    protected $validationMessages = [
        'email' => [
            'valid_email' => 'Please provide a valid email address.',
        ],
    ];
    protected $skipValidation = false;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['sanitizeData'];
    protected $afterInsert = [];
    protected $beforeUpdate = ['sanitizeData'];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    protected function sanitizeData(array $data): array
    {
        // Example callback to sanitize data
        if (isset($data['data']['email'])) {
            $data['data']['email'] = filter_var($data['data']['email'], FILTER_SANITIZE_EMAIL);
        }
        return $data;
    }
}
