<?php

declare(strict_types=1);

namespace App\Service\MonthlyPlans;

use Cake\ORM\Table;

class DeleteService
{
    private Table $monthlyPlans;

    public function __construct(Table $monthlyPlans)
    {
        $this->monthlyPlans = $monthlyPlans;
    }

    public function run(int $id): array
    {
        $entity = $this->monthlyPlans->get($id);

        if ($this->monthlyPlans->delete($entity)) {
            return ['success' => true, 'message' => 'Plano mensal deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Plano mensal não deletado. Por favor, tente novamente.'];
    }
}
