<?php

declare(strict_types=1);

namespace App\Service\Equipments;

use Cake\ORM\Table;

class EditService
{
    private Table $equipments;

    public function __construct(Table $equipments)
    {
        $this->equipments = $equipments;
    }

    public function run(int $id, array $data): array
    {
        $equipment = $this->equipments->get($id);
        $this->equipments->patchEntity($equipment, $data);

        if ($this->equipments->save($equipment)) {
            return ['success' => true, 'message' => 'Equipamento atualizado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao atualizar o equipamento.'];
    }

    public function getEditData(int $id)
    {
        return ['equipment' => $this->equipments->get($id)];
    }
}
