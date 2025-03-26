<?php

declare(strict_types=1);

namespace App\Service\ExerciseTrainingDivision;

use Cake\ORM\Table;

class ViewService
{
    private Table $exerciseTrainingDivision;

    public function __construct(Table $exerciseTrainingDivision)
    {
        $this->exerciseTrainingDivision = $exerciseTrainingDivision;
    }

    public function run(int $id)
    {
        return $this->exerciseTrainingDivision->get($id, [
            'contain' => ['Fichas.Students', 'Exercises', 'TrainingDivisions']
        ]);
    }
}
