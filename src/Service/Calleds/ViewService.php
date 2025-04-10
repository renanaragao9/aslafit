<?php

declare(strict_types=1);

namespace App\Service\Calleds;

use Cake\ORM\Table;

class ViewService
{
    private Table $calleds;

    public function __construct(Table $calleds)
    {
        $this->calleds = $calleds;
    }

    public function run(int $id)
    {
        return $this->calleds->get($id, [
            'contain' => ['Collaborators', 'Students'],
        ]);
    }
}
