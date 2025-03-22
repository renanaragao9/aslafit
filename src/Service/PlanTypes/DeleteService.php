<?php

declare(strict_types=1);

namespace App\Service\PlanTypes;

use Cake\ORM\Table;

class DeleteService
{
    private Table $planTypes;

    public function __construct(Table $planTypes)
    {
        $this->planTypes = $planTypes;
    }

    public function run(int $id): array
    {
        $planType = $this->planTypes->get($id);

        if ($this->planTypes->delete($planType)) {
            return ['success' => true, 'message' => 'Tipo de plano deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o tipo de plano.'];
    }
}
