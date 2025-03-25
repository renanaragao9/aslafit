<?php

declare(strict_types=1);

namespace App\Service\MealTypes;

use Cake\ORM\Table;

class DeleteService
{
    private Table $mealTypes;

    public function __construct(Table $mealTypes)
    {
        $this->mealTypes = $mealTypes;
    }

    public function run(int $id): array
    {
        $mealType = $this->mealTypes->get($id);

        if ($this->mealTypes->delete($mealType)) {
            return ['success' => true, 'message' => 'Tipo de refeição deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o tipo de refeição.'];
    }
}
