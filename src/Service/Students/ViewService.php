<?php

declare(strict_types=1);

namespace App\Service\Students;

use Cake\ORM\Table;

class ViewService
{
    private Table $students;

    public function __construct(Table $students)
    {
        $this->students = $students;
    }

    public function run(int $id)
    {
        return $this->students->get($id, [
            'contain' => ['Users', 'Assessments', 'Calleds', 'DietPlans', 'EventRegistrations', 'Fichas', 'MonthlyPlans']
        ]);
    }
}
