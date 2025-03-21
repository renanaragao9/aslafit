<?php

declare(strict_types=1);

namespace App\Service\ItemTypes;

use Cake\ORM\Table;

class DeleteService
{
    private Table $itemTypes;

    public function __construct(Table $itemTypes)
    {
        $this->itemTypes = $itemTypes;
    }

    public function run(int $id): array
    {
        $itemType = $this->itemTypes->get($id);

        if ($this->itemTypes->delete($itemType)) {
            return ['success' => true, 'message' => 'Tipo de item deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o tipo de item.'];
    }
}
