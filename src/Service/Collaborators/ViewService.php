<?php

declare(strict_types=1);

namespace App\Service\Collaborators;

use Cake\ORM\Table;

class ViewService
{
    private Table $collaborators;

    public function __construct(Table $collaborators)
    {
        $this->collaborators = $collaborators;
    }

    public function run(int $id)
    {
        return $this->collaborators->get($id, [
            'contain' => ['Positions', 'Users', 'Calleds', 'Events', 'Medias', 'MonthlyPlans', 'WorkLogs']
        ]);
    }
}
