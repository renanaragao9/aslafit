<?php

declare(strict_types=1);

namespace App\Service\ItemTypes;

use Cake\ORM\Table;

class EditService
{
    private Table $itemTypes;

    public function __construct(Table $itemTypes)
    {
        $this->itemTypes = $itemTypes;
    }

    public function run(int $id, array $data): array
    {
        $itemType = $this->itemTypes->get($id);
        $this->itemTypes->patchEntity($itemType, $data);

        if ($this->itemTypes->save($itemType)) {
            return ['success' => true, 'message' => 'Tipo de item editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o tipo de item.'];
    }

    public function getEditData(int $id)
    {
        return ['itemType' => $this->itemTypes->get($id)];
    }
}
