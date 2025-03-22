<?php

declare(strict_types=1);

namespace App\Service\Suppliers;

use Cake\ORM\Table;

class ViewService
{
    private Table $suppliers;

    public function __construct(Table $suppliers)
    {
        $this->suppliers = $suppliers;
    }

    public function run(int $id)
    {
        return $this->suppliers->get($id, ['contain' => ['Items']]);
    }
}
