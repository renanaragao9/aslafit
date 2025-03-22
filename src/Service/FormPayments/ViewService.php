<?php

declare(strict_types=1);

namespace App\Service\FormPayments;

use Cake\ORM\Table;

class ViewService
{
    private Table $formPayments;

    public function __construct(Table $formPayments)
    {
        $this->formPayments = $formPayments;
    }

    public function run(int $id)
    {
        return $this->formPayments->get($id, ['contain' => []]);
    }
}
