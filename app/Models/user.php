<?php

namespace app\models;

class user extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->fillable = [
            'account',
            'username',
            'password',
            'email',
            'role'
        ];
    }

    
}