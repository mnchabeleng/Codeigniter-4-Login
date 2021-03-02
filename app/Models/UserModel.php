<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password'];
    
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected function beforeInsert(array $data)
    {
        $data = $this->formatUserData($data);
        return $data;
    }

    protected function beforeUpate(array $data)
    {
        $data = $this->formatUserData($data);
        return $data;
    }

    protected function formatUserData(array $data)
    {
        if( isset($data['data']['first_name']) )
        {
            $data['data']['first_name'] = ucfirst($data['data']['first_name']);
        }

        if( isset($data['data']['last_name']) )
        {
            $data['data']['last_name'] = ucfirst($data['data']['last_name']);
        }

        if( isset($data['data']['password']) )
        {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);   
        }

        return $data;
    }

}
