<?php

declare(strict_types=1);

namespace App\Service\PlanTypes;

use Cake\ORM\Table;

class EditService
{
    private Table $planTypes;

    public function __construct(Table $planTypes)
    {
        $this->planTypes = $planTypes;
    }

    public function run(int $id, array $data): array
    {
        if (isset($data['value'])) {
            $data['value'] = (float)str_replace(['.', ','], ['', '.'], $data['value']);
        }

        $planType = $this->planTypes->get($id);
        $this->planTypes->patchEntity($planType, $data);

        if ($this->planTypes->save($planType)) {
            return ['success' => true, 'message' => 'Tipo de plano editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o tipo de plano.'];
    }

    public function getEditData(int $id)
    {
        return ['planType' => $this->planTypes->get($id)];
    }
}
