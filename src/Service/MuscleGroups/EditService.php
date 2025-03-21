<?php

declare(strict_types=1);

namespace App\Service\MuscleGroups;

use Cake\ORM\Table;

class EditService
{
    private Table $muscleGroups;

    public function __construct(Table $muscleGroups)
    {
        $this->muscleGroups = $muscleGroups;
    }

    public function run(int $id, array $data): array
    {
        $muscleGroup = $this->muscleGroups->get($id);
        $this->muscleGroups->patchEntity($muscleGroup, $data);

        if ($this->muscleGroups->save($muscleGroup)) {
            return ['success' => true, 'message' => 'Grupo muscular editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o grupo muscular.'];
    }

    public function getEditData(int $id)
    {
        return ['muscleGroup' => $this->muscleGroups->get($id)];
    }
}
