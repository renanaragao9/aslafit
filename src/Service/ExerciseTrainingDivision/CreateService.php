<?php

declare(strict_types=1);

namespace App\Service\ExerciseTrainingDivision;

use Cake\ORM\Table;

class CreateService
{
    private Table $exerciseTrainingDivision;

    public function __construct(Table $exerciseTrainingDivision)
    {
        $this->exerciseTrainingDivision = $exerciseTrainingDivision;
    }

    public function run(array $data): array
    {
        if (empty($data['exercises']) || !is_array($data['exercises'])) {
            return ['success' => false, 'message' => 'Nenhum exercício enviado.'];
        }

        $groupedExercises = [];
        foreach ($data['exercises'] as $exercise) {
            $divisionId = $exercise['exercise_data[training_division_id]'] ?? null;
            if ($divisionId) {
                $groupedExercises[$divisionId][] = [
                    'training_division_id' => $exercise['exercise_data[training_division_id]'],
                    'series' => $exercise['exercise_data[series]'],
                    'repetitions' => $exercise['exercise_data[repetitions]'],
                    'weight' => $exercise['exercise_data[weight]'] ?? null,
                    'rest' => $exercise['exercise_data[rest]'] ?? null,
                    'description' => $exercise['exercise_data[description]'] ?? null,
                    'ficha_id' => $data['ficha_id'],
                    'exercise_id' => $exercise['exercise_id'],
                ];
            }
        }

        $errors = [];
        foreach ($groupedExercises as $divisionId => $exercises) {
            foreach ($exercises as $index => $exerciseData) {
                $exerciseData['sort_order'] = $index + 1;
                $entity = $this->exerciseTrainingDivision->newEntity($exerciseData);

                if (!$this->exerciseTrainingDivision->save($entity)) {
                    $errors[] = $entity->getErrors();
                }
            }
        }

        if (empty($errors)) {
            return ['success' => true, 'message' => 'Ficha de treino salva com sucesso!'];
        }

        return ['success' => false, 'message' => 'Alguns exercícios não puderam ser salvos.', 'errors' => $errors];
    }

    public function getNewEntity()
    {
        return $this->exerciseTrainingDivision->newEmptyEntity();
    }

    public function getViewData(): array
    {
        $exerciseTrainingDivision = $this->getNewEntity();

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
