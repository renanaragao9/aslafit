<?php

declare(strict_types=1);

namespace App\Service\FoodTypes;

use Cake\ORM\Table;

class EditService
{
    private Table $foodTypes;

    public function __construct(Table $foodTypes)
    {
        $this->foodTypes = $foodTypes;
    }

    public function run(int $id, array $data): array
    {
        $foodType = $this->foodTypes->get($id);
        $this->foodTypes->patchEntity($foodType, $data);

        if ($this->foodTypes->save($foodType)) {
            return ['success' => true, 'message' => 'Tipo de alimento editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o tipo de alimento.'];
    }

    public function getEditData(int $id)
    {
        return ['foodType' => $this->foodTypes->get($id)];
    }
}
