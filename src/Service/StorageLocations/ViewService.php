<?php

declare(strict_types=1);

namespace App\Service\StorageLocations;

use Cake\ORM\Table;

class ViewService
{
    private Table $storageLocations;

    public function __construct(Table $storageLocations)
    {
        $this->storageLocations = $storageLocations;
    }

    public function run(int $id)
    {
        return $this->storageLocations->get($id, ['contain' => ['Items']]);
    }
}
