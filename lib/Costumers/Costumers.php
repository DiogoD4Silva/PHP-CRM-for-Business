<?php
class Costumers
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
            'company' => 'Empresa',
            'emp' => 'Responsável',
            'phone' => 'Telemóvel',
            'created_at' => 'Data de criação',
            'updated_at' => 'Data de atualização'
        ];

        return $ordering;
    }
}
