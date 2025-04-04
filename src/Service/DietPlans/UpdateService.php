<?php

declare(strict_types=1);

namespace App\Service\DietPlans;

use Cake\ORM\Table;

class UpdateService
{
    private Table $dietPlans;

    public function __construct(Table $dietPlans)
    {
        $this->dietPlans = $dietPlans;
    }

    public function run(array $mealsData, int $fichaId): array
    {
        return $this->dietPlans->getConnection()->transactional(function () use ($mealsData, $fichaId) {

            $this->dietPlans->deleteAll(['ficha_id' => $fichaId]);

            foreach ($mealsData as $mealData) {
                $entityData = [
                    'ficha_id' => $fichaId,
                    'food_id' => $mealData['id'],
                    'meal_type_id' => $mealData['food_data[meal_type_id]'],
                    'description' => $mealData['food_data[description]'] ?? null,
                ];

                $entity = $this->dietPlans->newEntity($entityData);

                if (!$this->dietPlans->save($entity)) {
                    return ['success' => false, 'message' => 'Erro ao atualizar plano alimentar.'];
                }
            }

            return ['success' => true, 'message' => 'Plano alimentar atualizado com sucesso.', 'fichaId' => $fichaId];
        });
    }

    public function getViewData(): array
    {
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

        return compact('mealTypes', 'foods', 'groupedFoods');
    }
}
