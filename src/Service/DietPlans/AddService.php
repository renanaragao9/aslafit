<?php

declare(strict_types=1);

namespace App\Service\DietPlans;

use Cake\ORM\Table;

class AddService
{
    private Table $dietPlans;

    public function __construct(Table $dietPlans)
    {
        $this->dietPlans = $dietPlans;
    }

    public function run(array $data): array
    {
        $dietPlan = $this->dietPlans->newEntity($data);

        if ($this->dietPlans->save($dietPlan)) {
            return ['success' => true, 'message' => 'Plano alimentar salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o plano alimentar.'];
    }

    public function getNewEntity()
    {
        return $this->dietPlans->newEmptyEntity();
    }
}
