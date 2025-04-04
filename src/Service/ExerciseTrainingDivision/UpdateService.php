<?php

declare(strict_types=1);

namespace App\Service\ExerciseTrainingDivision;

use Cake\ORM\Table;

class UpdateService
{
    private Table $exerciseTrainingDivision;

    public function __construct(Table $exerciseTrainingDivision)
    {
        $this->exerciseTrainingDivision = $exerciseTrainingDivision;
    }

    public function run(array $exercisesData, int $fichaId): array
    {
        return $this->exerciseTrainingDivision->getConnection()->transactional(function () use ($exercisesData, $fichaId) {

            $this->exerciseTrainingDivision->deleteAll(['ficha_id' => $fichaId]);

            foreach ($exercisesData as $index => $exercise) {
                $entityData = [
                    'ficha_id' => $fichaId,
                    'exercise_id' => $exercise['id'],
                    'training_division_id' => $exercise['exercise_data[training_division_id]'],
                    'series' => $exercise['exercise_data[series]'],
                    'repetitions' => $exercise['exercise_data[repetitions]'],
                    'weight' => $exercise['exercise_data[weight]'] ?? null,
                    'rest' => $exercise['exercise_data[rest]'] ?? null,
                    'description' => $exercise['exercise_data[description]'] ?? null,
                    'sort_order' => $index + 1,
                ];

                $entity = $this->exerciseTrainingDivision->newEntity($entityData);

                if (!$this->exerciseTrainingDivision->save($entity)) {
                    return ['success' => false, 'message' => 'Erro ao atualizar ficha de treino.'];
                }
            }

            return ['success' => true, 'message' => 'Ficha de treino atualizada com sucesso.'];
        });
    }

    public function getViewData(): array
    {
        $exerciseTrainingDivision = $this->exerciseTrainingDivision->newEmptyEntity();

        $fichas = $this->exerciseTrainingDivision->Fichas->find('list', [
            'keyField' => 'id',
            'valueField' => function ($ficha) {
                return $ficha->student->name;
            }
        ])
            ->where(['Fichas.active' => 1])
            ->contain(['Students'])
            ->toArray();

        $exercises = $this->exerciseTrainingDivision->Exercises
            ->find()
            ->contain(['Equipments', 'MuscleGroups'])
            ->where(['Exercises.active' => 1])
            ->order(['Exercises.name' => 'ASC'])
            ->all();

        $trainingDivisions = $this->exerciseTrainingDivision->TrainingDivisions
            ->find('list', [
                'keyField' => 'id',
                'valueField' => 'name',
            ])
            ->where(['active' => 1])
            ->toArray();

        return compact('exerciseTrainingDivision', 'fichas', 'exercises', 'trainingDivisions');
    }
}
