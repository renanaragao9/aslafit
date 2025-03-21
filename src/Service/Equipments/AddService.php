<?php

declare(strict_types=1);

namespace App\Service\Equipments;

use Cake\ORM\Table;

class AddService
{
    private Table $equipments;

    public function __construct(Table $equipments)
    {
        $this->equipments = $equipments;
    }

    public function run(array $data): array
    {
        $equipment = $this->equipments->newEntity($data);

        if ($this->equipments->save($equipment)) {
            return ['success' => true, 'message' => 'Equipamento adicionado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao adicionar o equipamento.'];
    }

    public function getNewEntity()
    {
        return $this->equipments->newEmptyEntity();
    }
}
