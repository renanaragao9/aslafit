<?php

declare(strict_types=1);

namespace App\Service\Fichas;

use Cake\ORM\Table;

class ViewService
{
    private Table $fichas;

    public function __construct(Table $fichas)
    {
        $this->fichas = $fichas;
    }

    public function run(int $id)
    {
        return $this->fichas->get($id, [
            'contain' => [
                'Students',
                'Assessments',
                'DietPlans' => [
                    'MealTypes',
                    'Foods'
                ],
                'ExerciseTrainingDivision'
            ]
        ]);
    }
}
