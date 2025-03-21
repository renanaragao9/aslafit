<?php

declare(strict_types=1);

namespace App\Service\TrainingDivisions;

use Cake\ORM\Table;

class EditService
{
    private Table $trainingDivisions;

    public function __construct(Table $trainingDivisions)
    {
        $this->trainingDivisions = $trainingDivisions;
    }

    public function run(int $id, array $data): array
    {
        $trainingDivision = $this->trainingDivisions->get($id);
        $this->trainingDivisions->patchEntity($trainingDivision, $data);

        if ($this->trainingDivisions->save($trainingDivision)) {
            return ['success' => true, 'message' => 'Divisão de treino editada com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar a divisão de treino.'];
    }

    public function getEditData(int $id)
    {
        return ['trainingDivision' => $this->trainingDivisions->get($id)];
    }
}
