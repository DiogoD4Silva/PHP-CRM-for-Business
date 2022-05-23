<?php
class Sales
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
            'saled_at' => 'Data do projeto',
            'p_name' => 'Nome do projeto',
            'created_at' => 'Data de criação',
            'type' => 'Serviço fornecido',
            'updated_at' => 'Data de atualização',
            'status' => 'Estado',
            'description' => 'Descrição',
            'value' => 'Preço',
            'buyer' => 'Comprador'
        ];

        return $ordering;
    }
}
