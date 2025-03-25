<?php

declare(strict_types=1);

namespace App\Service\WorkLogs;

use Cake\ORM\Table;

class ViewService
{
    private Table $workLogs;

    public function __construct(Table $workLogs)
    {
        $this->workLogs = $workLogs;
    }

    public function run(int $id)
    {
        return $this->workLogs->get($id, [
            'contain' => ['Collaborators']
        ]);
    }
}
