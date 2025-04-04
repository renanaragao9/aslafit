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

    public function run(array $mealsData, int $fichaId): array
    {
        $entities = [];

        foreach ($mealsData as $mealData) {
            $entityData = [
                'ficha_id' => $fichaId,
                'food_id' => $mealData['id'],
                'meal_type_id' => $mealData['food_data[meal_type_id]'],
                'description' => $mealData['food_data[description]'] ?? null,
            ];

            $entities[] = $this->dietPlans->newEntity($entityData);
        }

        return $this->dietPlans->getConnection()->transactional(function () use ($entities, $fichaId) {
            foreach ($entities as $entity) {
                if (!$this->dietPlans->save($entity)) {
                    return ['success' => false, 'message' => 'Erro ao salvar um dos itens do plano alimentar.'];
                }
            }

            return ['success' => true, 'message' => 'Plano alimentar salvo com sucesso.', 'fichaId' => $fichaId];
        });
    }


    public function getNewEntity()
    {
        return $this->dietPlans->newEmptyEntity();
    }

    public function getViewData(): array
    {
        $dietPlan = $this->getNewEntity();

        $mealTypes = $this->dietPlans->MealTypes->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->where(['active' => true])
            ->toArray();

        $foods = $this->dietPlans->Foods->find()
            ->contain(['FoodTypes'])
            ->where(['Foods.active' => true])
            ->all();

        $groupedFoods = [];
        foreach ($foods as $food) {
            $type = $food->food_type->name ?? 'Outros';
            $groupedFoods[$type][] = $food;
        }

        $fichas = $this->dietPlans->Fichas->find('list', [
            'keyField' => 'id',
            'valueField' => function ($ficha) {
                return $ficha->student->name;
            }
        ])
            ->where(['Fichas.active' => 1])
            ->contain(['Students'])
            ->toArray();

        return compact('dietPlan', 'mealTypes', 'foods', 'fichas', 'groupedFoods');
    }
}
