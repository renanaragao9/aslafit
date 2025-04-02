<?php

declare(strict_types=1);

namespace App\Service\FoodTypes;

use Cake\ORM\Table;

class AddService
{
    private Table $foodTypes;

    public function __construct(Table $foodTypes)
    {
        $this->foodTypes = $foodTypes;
    }

    public function run(array $data): array
    {
        $foodType = $this->foodTypes->newEntity($data);

        if ($this->foodTypes->save($foodType)) {
            return ['success' => true, 'message' => 'Tipo de alimento salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o tipo de alimento.'];
    }

    public function getNewEntity()
    {
        return $this->foodTypes->newEmptyEntity();
    }
}
