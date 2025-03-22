<?php

declare(strict_types=1);

namespace App\Service\PlanTypes;

use Cake\ORM\Table;

class AddService
{
    private Table $planTypes;

    public function __construct(Table $planTypes)
    {
        $this->planTypes = $planTypes;
    }

    public function run(array $data): array
    {
        if (isset($data['value'])) {
            $data['value'] = (float)str_replace(['.', ','], ['', '.'], $data['value']);
        }

        $planType = $this->planTypes->newEntity($data);

        if ($this->planTypes->save($planType)) {
            return ['success' => true, 'message' => 'Tipo de plano salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o tipo de plano.'];
    }

    public function getNewEntity()
    {
        return $this->planTypes->newEmptyEntity();
    }
}
