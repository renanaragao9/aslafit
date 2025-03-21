<?php

declare(strict_types=1);

namespace App\Service\Equipments;

use Cake\ORM\Table;

class ViewService
{
    private Table $equipments;

    public function __construct(Table $equipments)
    {
        $this->equipments = $equipments;
    }

    public function run(int $id)
    {
        return $this->equipments->get($id, ['contain' => ['Exercises.MuscleGroups']]);
    }
}
