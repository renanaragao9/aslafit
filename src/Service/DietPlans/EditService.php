<?php

declare(strict_types=1);

namespace App\Service\DietPlans;

use Cake\ORM\Table;

class EditService
{
    private Table $dietPlans;

    public function __construct(Table $dietPlans)
    {
        $this->dietPlans = $dietPlans;
    }

    public function run(int $id, array $data): array
    {
        $dietPlan = $this->dietPlans->get($id);
        $this->dietPlans->patchEntity($dietPlan, $data);

        if ($this->dietPlans->save($dietPlan)) {
            return ['success' => true, 'message' => 'Plano alimentar editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o plano alimentar.'];
    }

    public function getEditData(int $id)
    {
        return ['dietPlan' => $this->dietPlans->get($id)];
    }
}
