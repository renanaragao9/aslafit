<?php

declare(strict_types=1);

namespace App\Service\MuscleGroups;

use Cake\ORM\Table;

class DeleteService
{
    private Table $muscleGroups;

    public function __construct(Table $muscleGroups)
    {
        $this->muscleGroups = $muscleGroups;
    }

    public function run(int $id): array
    {
        $muscleGroup = $this->muscleGroups->get($id);

        if ($this->muscleGroups->delete($muscleGroup)) {
            return ['success' => true, 'message' => 'Grupo muscular deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o grupo muscular.'];
    }
}
