<?php

declare(strict_types=1);

namespace App\Service\Foods;

use Cake\ORM\Table;

class AddService
{
    private Table $foods;

    public function __construct(Table $foods)
    {
        $this->foods = $foods;
    }

    public function run(array $data): array
    {
        $food = $this->foods->newEntity($data);

        if ($this->foods->save($food)) {
            return ['success' => true, 'message' => 'Alimento salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o alimento.'];
    }

    public function getNewEntity()
    {
        return $this->foods->newEmptyEntity();
    }
}
