<?php

declare(strict_types=1);

namespace App\Service\MonthlyPlans;

use Cake\ORM\Table;

class ViewService
{
    private Table $monthlyPlans;

    public function __construct(Table $monthlyPlans)
    {
        $this->monthlyPlans = $monthlyPlans;
    }

    public function run(int $id)
    {
        return $this->monthlyPlans->get($id, [
            'contain' => ['FormPayments', 'PlanTypes', 'Students', 'Collaborators'],
        ]);
    }
}
