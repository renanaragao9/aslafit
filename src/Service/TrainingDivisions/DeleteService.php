<?php

declare(strict_types=1);

namespace App\Service\TrainingDivisions;

use Cake\ORM\Table;

class DeleteService
{
    private Table $trainingDivisions;

    public function __construct(Table $trainingDivisions)
    {
        $this->trainingDivisions = $trainingDivisions;
    }

    public function run(int $id): array
    {
        $trainingDivision = $this->trainingDivisions->get($id);

        if ($this->trainingDivisions->delete($trainingDivision)) {
            return ['success' => true, 'message' => 'Divisão de treino deletada com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar a divisão de treino.'];
    }
}
