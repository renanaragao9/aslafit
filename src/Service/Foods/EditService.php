<?php

declare(strict_types=1);

namespace App\Service\Foods;

use Cake\ORM\Table;

class EditService
{
    private Table $foods;

    public function __construct(Table $foods)
    {
        $this->foods = $foods;
    }

    public function run(int $id, array $data): array
    {
        $food = $this->foods->get($id);
        $this->foods->patchEntity($food, $data);

        if ($this->foods->save($food)) {
            return ['success' => true, 'message' => 'Alimento editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o alimento.'];
    }

    public function getEditData(int $id)
    {
        return ['food' => $this->foods->get($id)];
    }
}
