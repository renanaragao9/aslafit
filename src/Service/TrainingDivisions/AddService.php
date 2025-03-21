<?php

declare(strict_types=1);

namespace App\Service\TrainingDivisions;

use Cake\ORM\Table;

class AddService
{
    private Table $trainingDivisions;

    public function __construct(Table $trainingDivisions)
    {
        $this->trainingDivisions = $trainingDivisions;
    }

    public function run(array $data): array
    {
        $trainingDivision = $this->trainingDivisions->newEntity($data);

        if ($this->trainingDivisions->save($trainingDivision)) {
            return ['success' => true, 'message' => 'Divisão de treino adicionada com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao adicionar a divisão de treino.'];
    }

    public function getNewEntity()
    {
        return $this->trainingDivisions->newEmptyEntity();
    }
}
