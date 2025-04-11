<?php

declare(strict_types=1);

namespace App\Service\MonthlyPlans;

use Cake\ORM\Table;

class EditService
{
    private Table $monthlyPlans;

    public function __construct(Table $monthlyPlans)
    {
        $this->monthlyPlans = $monthlyPlans;
    }

    public function run(int $id, array $data): array
    {
        if (isset($data['value'])) {
            $data['value'] = (float)str_replace(['.', ','], ['', '.'], $data['value']);
        }

        $entity = $this->monthlyPlans->get($id);
        $this->monthlyPlans->patchEntity($entity, $data);

        if ($this->monthlyPlans->save($entity)) {
            return ['success' => true, 'message' => 'Plano mensal editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Plano mensal não editado. Por favor, tente novamente.'];
    }

    public function getEditData(int $id): array
    {
        return [
            'monthlyPlan' => $this->monthlyPlans->get($id),
            'formPayments' => $this->monthlyPlans->FormPayments->find('list', ['limit' => 200])->all(),
            'planTypes' => $this->monthlyPlans->PlanTypes->find('list', ['limit' => 200])->all(),
            'students' => $this->monthlyPlans->Students->find('list', ['limit' => 200])->all(),
            'collaborators' => $this->monthlyPlans->Collaborators->find('list', ['limit' => 200])->all(),
        ];
    }
}
