<?php

declare(strict_types=1);

namespace App\Service\Exercises;

use Cake\ORM\Table;

class ViewService
{
    private Table $exercises;

    public function __construct(Table $exercises)
    {
        $this->exercises = $exercises;
    }

    public function run(int $id)
    {
        return $this->exercises->get($id, ['contain' => ['Equipments', 'MuscleGroups', 'ExerciseTrainingDivision']]);
    }
}
