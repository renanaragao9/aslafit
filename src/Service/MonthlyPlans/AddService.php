<?php

declare(strict_types=1);

namespace App\Service\MonthlyPlans;

use Cake\ORM\Table;

class AddService
{
    private Table $monthlyPlans;

    public function __construct(Table $monthlyPlans)
    {
        $this->monthlyPlans = $monthlyPlans;
    }

    public function run(array $data): array
    {

        if (isset($data['value'])) {
            $data['value'] = (float)str_replace(['.', ','], ['', '.'], $data['value']);
        }

        $entity = $this->monthlyPlans->newEntity($data);

        if ($this->monthlyPlans->save($entity)) {
            return ['success' => true, 'message' => 'Plano mensal renovado salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Plano mensal não renovado. Por favor, tente novamente.'];
    }

    public function getFormData(): array
    {
        return [
            'monthlyPlan' => $this->monthlyPlans->newEmptyEntity(),
            'formPayments' => $this->monthlyPlans->FormPayments->find('list', ['limit' => 200])->all(),
            'planTypes' => $this->monthlyPlans->PlanTypes->find('list', ['limit' => 200])->all(),
            'students' => $this->monthlyPlans->Students->find('list', ['limit' => 200])->all(),
            'collaborators' => $this->monthlyPlans->Collaborators->find('list', ['limit' => 200])->all(),
        ];
    }
}
