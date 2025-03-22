<?php

declare(strict_types=1);

namespace App\Service\MealTypes;

use Cake\ORM\Table;

class EditService
{
    private Table $mealTypes;

    public function __construct(Table $mealTypes)
    {
        $this->mealTypes = $mealTypes;
    }

    public function run(int $id, array $data): array
    {
        $mealType = $this->mealTypes->get($id);
        $this->mealTypes->patchEntity($mealType, $data);

        if ($this->mealTypes->save($mealType)) {
            return ['success' => true, 'message' => 'Tipo de refeição editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o tipo de refeição.'];
    }

    public function getEditData(int $id)
    {
        return ['mealType' => $this->mealTypes->get($id)];
    }
}
