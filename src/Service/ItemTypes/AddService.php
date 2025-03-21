<?php

declare(strict_types=1);

namespace App\Service\ItemTypes;

use Cake\ORM\Table;

class AddService
{
    private Table $itemTypes;

    public function __construct(Table $itemTypes)
    {
        $this->itemTypes = $itemTypes;
    }

    public function run(array $data): array
    {
        $itemType = $this->itemTypes->newEntity($data);

        if ($this->itemTypes->save($itemType)) {
            return ['success' => true, 'message' => 'Tipo de item salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o tipo de item.'];
    }

    public function getNewEntity()
    {
        return $this->itemTypes->newEmptyEntity();
    }
}
