<?php

declare(strict_types=1);

namespace App\Service\ExerciseTrainingDivision;

use Cake\ORM\Table;

class AddService
{
    private Table $exerciseTrainingDivision;

    public function __construct(Table $exerciseTrainingDivision)
    {
        $this->exerciseTrainingDivision = $exerciseTrainingDivision;
    }

    public function run(array $data): array
    {
        $entity = $this->exerciseTrainingDivision->newEntity($data);

        if ($this->exerciseTrainingDivision->save($entity)) { 
            return ['success' => true, 'message' => 'Exercício salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o exercício.'];
    }

    public function getNewEntity()
    {
        return $this->exerciseTrainingDivision->newEmptyEntity();
    }
}
