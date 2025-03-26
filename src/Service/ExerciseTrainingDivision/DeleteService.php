<?php

declare(strict_types=1);

namespace App\Service\ExerciseTrainingDivision;

use Cake\ORM\Table;

class DeleteService
{
    private Table $exerciseTrainingDivision;

    public function __construct(Table $exerciseTrainingDivision)
    {
        $this->exerciseTrainingDivision = $exerciseTrainingDivision;
    }

    public function run(int $id): array
    {
        $entity = $this->exerciseTrainingDivision->get($id);

        if ($this->exerciseTrainingDivision->delete($entity)) {
            return ['success' => true, 'message' => 'Exercício deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o exercício.'];
    }
}
