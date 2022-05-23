<?php
class Users
{

    public function __construct()
    {
    }

    public function __destruct()
    {
    }
    
    public function setOrderingValues()
    {
        $ordering = [
            'id' => 'ID',
            'user_name' => 'Nome',
            'admin_type' => 'Nível'
        ];

        return $ordering;
    }
}
