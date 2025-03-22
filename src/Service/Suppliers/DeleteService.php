<?php

declare(strict_types=1);

namespace App\Service\Suppliers;

use Cake\ORM\Table;

class DeleteService
{
    private Table $suppliers;

    public function __construct(Table $suppliers)
    {
        $this->suppliers = $suppliers;
    }

    public function run(int $id): array
    {
        $supplier = $this->suppliers->get($id);

        if ($this->suppliers->delete($supplier)) {
            return ['success' => true, 'message' => 'Fornecedor deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o fornecedor.'];
    }
}
