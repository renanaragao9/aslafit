<?php

declare(strict_types=1);

namespace App\Service\DietPlans;

use Cake\ORM\Table;

class CreateService
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

    public function getViewData(): array
    {
        $dietPlan = $this->getNewEntity();

        $mealTypes = $this->dietPlans->MealTypes->find('list', ['limit' => 200])->all();
        $foods = $this->dietPlans->Foods->find('list', ['limit' => 200])->all();

        $fichas = $this->dietPlans->Fichas->find('list', [
            'keyField' => 'id',
            'valueField' => function ($ficha) {
                return $ficha->student->name;
            }
        ])
            ->where(['Fichas.active' => 1])
            ->contain(['Students'])
            ->toArray();



        return compact('dietPlan', 'mealTypes', 'foods', 'fichas');
    }
}
