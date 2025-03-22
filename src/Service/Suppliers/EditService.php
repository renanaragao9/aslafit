<?php

declare(strict_types=1);

namespace App\Service\Suppliers;

use Cake\ORM\Table;

class EditService
{
    private Table $suppliers;

    public function __construct(Table $suppliers)
    {
        $this->suppliers = $suppliers;
    }

    public function run(int $id, array $data): array
    {
        $supplier = $this->suppliers->get($id);
        $this->suppliers->patchEntity($supplier, $data);

        if ($this->suppliers->save($supplier)) {
            return ['success' => true, 'message' => 'Fornecedor editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o fornecedor.'];
    }

    public function getEditData(int $id)
    {
        return ['supplier' => $this->suppliers->get($id)];
    }
}
