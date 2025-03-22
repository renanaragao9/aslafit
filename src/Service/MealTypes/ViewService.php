<?php

declare(strict_types=1);

namespace App\Service\MealTypes;

use Cake\ORM\Table;

class ViewService
{
    private Table $mealTypes;

    public function __construct(Table $mealTypes)
    {
        $this->mealTypes = $mealTypes;
    }

    public function run(int $id)
    {
        return $this->mealTypes->get($id);
    }
}
