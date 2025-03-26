<?php

declare(strict_types=1);

namespace App\Service\Assessments;

use Cake\ORM\Table;

class ViewService
{
    private Table $assessments;

    public function __construct(Table $assessments)
    {
        $this->assessments = $assessments;
    }

    public function run(int $id)
    {
        return $this->assessments->get($id, [
            'contain' => ['Fichas.Students']
        ]);
    }
}
