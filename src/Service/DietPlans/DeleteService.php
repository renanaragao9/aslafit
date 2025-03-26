<?php

declare(strict_types=1);

namespace App\Service\DietPlans;

use Cake\ORM\Table;

class DeleteService
{
    private Table $dietPlans;

    public function __construct(Table $dietPlans)
    {
        $this->dietPlans = $dietPlans;
    }

    public function run(int $id): array
    {
        $dietPlan = $this->dietPlans->get($id);

        if ($this->dietPlans->delete($dietPlan)) {
            return ['success' => true, 'message' => 'Plano alimentar deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o plano alimentar.'];
    }
}
