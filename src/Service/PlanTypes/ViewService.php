<?php

declare(strict_types=1);

namespace App\Service\PlanTypes;

use Cake\ORM\Table;

class ViewService
{
    private Table $planTypes;

    public function __construct(Table $planTypes)
    {
        $this->planTypes = $planTypes;
    }

    public function run(int $id)
    {
        return $this->planTypes->get($id, ['contain' => ['MonthlyPlans']]);
    }
}
