<?php

declare(strict_types=1);

namespace App\Service\MuscleGroups;

use Cake\ORM\Table;

class AddService
{
    private Table $muscleGroups;

    public function __construct(Table $muscleGroups)
    {
        $this->muscleGroups = $muscleGroups;
    }

    public function run(array $data): array
    {
        $muscleGroup = $this->muscleGroups->newEntity($data);

        if ($this->muscleGroups->save($muscleGroup)) {
            return ['success' => true, 'message' => 'Grupo muscular salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o grupo muscular.'];
    }

    public function getNewEntity()
    {
        return $this->muscleGroups->newEmptyEntity();
    }
}
