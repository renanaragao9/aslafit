<?php

declare(strict_types=1);

namespace App\Service\FoodTypes;

use Cake\ORM\Table;

class DeleteService
{
    private Table $foodTypes;

    public function __construct(Table $foodTypes)
    {
        $this->foodTypes = $foodTypes;
    }

    public function run(int $id): array
    {
        $foodType = $this->foodTypes->get($id);

        if ($this->foodTypes->delete($foodType)) {
            return ['success' => true, 'message' => 'Tipo de alimento deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o tipo de alimento.'];
    }
}
