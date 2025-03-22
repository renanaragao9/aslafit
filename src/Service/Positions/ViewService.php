<?php

declare(strict_types=1);

namespace App\Service\Positions;

use Cake\ORM\Table;

class ViewService
{
    private Table $positions;

    public function __construct(Table $positions)
    {
        $this->positions = $positions;
    }

    public function run(int $id)
    {
        return $this->positions->get($id, ['contain' => ['Collaborators']]);
    }
}
