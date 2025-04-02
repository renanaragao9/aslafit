<?php

declare(strict_types=1);

namespace App\Service\FoodTypes;

use Cake\ORM\Table;

class ViewService
{
    private Table $foodTypes;

    public function __construct(Table $foodTypes)
    {
        $this->foodTypes = $foodTypes;
    }

    public function run(int $id)
    {
        return $this->foodTypes->get($id, [
            'contain' => ['Foods']
        ]);
    }
}
