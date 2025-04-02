<?php

declare(strict_types=1);

namespace App\Service\Foods;

use Cake\ORM\Table;

class ViewService
{
    private Table $foods;

    public function __construct(Table $foods)
    {
        $this->foods = $foods;
    }

    public function run(int $id)
    {
        return $this->foods->get($id, ['contain' => ['DietPlans', 'FoodTypes']]);
    }
}
