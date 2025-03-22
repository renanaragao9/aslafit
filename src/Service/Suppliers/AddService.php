<?php

declare(strict_types=1);

namespace App\Service\Suppliers;

use Cake\ORM\Table;

class AddService
{
    private Table $suppliers;

    public function __construct(Table $suppliers)
    {
        $this->suppliers = $suppliers;
    }

    public function run(array $data): array
    {
        $supplier = $this->suppliers->newEntity($data);

        if ($this->suppliers->save($supplier)) {
            return ['success' => true, 'message' => 'Fornecedor salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o fornecedor.'];
    }

    public function getNewEntity()
    {
        return $this->suppliers->newEmptyEntity();
    }
}
