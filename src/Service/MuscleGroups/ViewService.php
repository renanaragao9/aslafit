<?php

declare(strict_types=1);

namespace App\Service\MuscleGroups;

use Cake\ORM\Table;

class ViewService
{
    private Table $muscleGroups;

    public function __construct(Table $muscleGroups)
    {
        $this->muscleGroups = $muscleGroups;
    }

    public function run(int $id)
    {
        return $this->muscleGroups->get($id, ['contain' => ['Exercises.Equipments']]);
    }
}
