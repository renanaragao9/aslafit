<?php

declare(strict_types=1);

namespace App\Service\ExerciseTrainingDivision;

use Cake\ORM\Table;

class EditService
{
    private Table $exerciseTrainingDivision;

    public function __construct(Table $exerciseTrainingDivision)
    {
        $this->exerciseTrainingDivision = $exerciseTrainingDivision;
    }

    public function run(int $id, array $data): array
    {
        $entity = $this->exerciseTrainingDivision->get($id);
        $this->exerciseTrainingDivision->patchEntity($entity, $data);

        if ($this->exerciseTrainingDivision->save($entity)) {
            return ['success' => true, 'message' => 'Exercício editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o exercício.'];
    }

    public function getEditData(int $id)
    {
        return ['exerciseTrainingDivision' => $this->exerciseTrainingDivision->get($id)];
    }
}
