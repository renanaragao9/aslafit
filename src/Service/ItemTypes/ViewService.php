<?php

declare(strict_types=1);

namespace App\Service\ItemTypes;

use Cake\ORM\Table;

class ViewService
{
    private Table $itemTypes;

    public function __construct(Table $itemTypes)
    {
        $this->itemTypes = $itemTypes;
    }

    public function run(int $id)
    {
        return $this->itemTypes->get($id, ['contain' => ['Items', 'ItemsFields']]);
    }
}
