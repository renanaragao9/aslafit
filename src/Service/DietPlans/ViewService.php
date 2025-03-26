<?php

declare(strict_types=1);

namespace App\Service\DietPlans;

use Cake\ORM\Table;

class ViewService
{
    private Table $dietPlans;

    public function __construct(Table $dietPlans)
    {
        $this->dietPlans = $dietPlans;
    }

    public function run(int $id)
    {
        return $this->dietPlans->get($id, [
            'contain' => ['MealTypes', 'Foods', 'Fichas.Students']
        ]);
    }
}
