<?php

declare(strict_types=1);

namespace App\Service\MealTypes;

use Cake\ORM\Table;

class AddService
{
    private Table $mealTypes;

    public function __construct(Table $mealTypes)
    {
        $this->mealTypes = $mealTypes;
    }

    public function run(array $data): array
    {
        $mealType = $this->mealTypes->newEntity($data);

        if ($this->mealTypes->save($mealType)) {
            return ['success' => true, 'message' => 'Tipo de refeição salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o tipo de refeição.'];
    }

    public function getNewEntity()
    {
        return $this->mealTypes->newEmptyEntity();
    }
}
