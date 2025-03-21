<?php

declare(strict_types=1);

namespace App\Service\TrainingDivisions;

use Cake\ORM\Table;

class ViewService
{
    private Table $trainingDivisions;

    public function __construct(Table $trainingDivisions)
    {
        $this->trainingDivisions = $trainingDivisions;
    }

    public function run(int $id)
    {
        return $this->trainingDivisions->get($id, ['contain' => ['ExerciseTrainingDivision']]);
    }
}
