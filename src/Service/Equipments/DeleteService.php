<?php

declare(strict_types=1);

namespace App\Service\Equipments;

use Cake\ORM\Table;

class DeleteService
{
    private Table $equipments;

    public function __construct(Table $equipments)
    {
        $this->equipments = $equipments;
    }

    public function run(int $id): array
    {
        $equipment = $this->equipments->get($id);

        if ($this->equipments->delete($equipment)) {
            return ['success' => true, 'message' => 'Equipamento excluído com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao excluir o equipamento.'];
    }
}
