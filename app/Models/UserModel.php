<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'tb_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['name_user', 'username_user', 'password_user', 'level_user', 'phone_user'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password_user'])) {
            $data['data']['password_user'] = password_hash($data['data']['password_user'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}