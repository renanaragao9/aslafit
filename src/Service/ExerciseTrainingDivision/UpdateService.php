<?php

declare(strict_types=1);

namespace App\Service\ExerciseTrainingDivision;

use Cake\ORM\Table;
use Cake\Routing\Router;

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

            $groupedExercises = [];
            foreach ($exercisesData as $exercise) {
                $divisionId = $exercise['exercise_data[training_division_id]'] ?? null;
                if ($divisionId) {
                    $groupedExercises[$divisionId][] = $exercise;
                }
            }

            foreach ($groupedExercises as $divisionId => $exercises) {
                foreach ($exercises as $index => $exercise) {
                    $entity = $this->exerciseTrainingDivision->newEntity(
                        $this->formatEntityData($exercise, $fichaId, $index + 1)
                    );

                    if (!$this->exerciseTrainingDivision->save($entity)) {
                        return ['success' => false, 'message' => 'Erro ao atualizar ficha de treino.'];
                    }
                }
            }

            return ['success' => true, 'message' => 'Ficha de treino atualizada com sucesso.'];
        });
    }

    public function getViewData(): array
    {
        return [
            'exerciseTrainingDivision' => $this->exerciseTrainingDivision->newEmptyEntity(),
            'fichas' => $this->getFichasList(),
            'exercises' => $this->getActiveExercises(),
            'trainingDivisions' => $this->getActiveTrainingDivisions()
        ];
    }

    public function getExistingExercises(int $fichaId): array
    {
        $ficha = $this->exerciseTrainingDivision->Fichas->get($fichaId, [
            'contain' => [
                'Students',
                'ExerciseTrainingDivision' => ['Exercises', 'TrainingDivisions']
            ]
        ]);

        return array_filter(array_map(function ($etd) {
            if (!$etd->exercise) {
                return null;
            }

            return [
                'id' => $etd->exercise_id,
                'name' => $etd->exercise->name,
                'img' => $this->getExerciseImageUrl($etd->exercise->image),
                'exercise_data[training_division_id]' => $etd->training_division_id,
                'exercise_data[series]' => $etd->series,
                'exercise_data[repetitions]' => $etd->repetitions,
                'exercise_data[weight]' => $etd->weight,
                'exercise_data[rest]' => $etd->rest,
                'exercise_data[description]' => $etd->description,
            ];
        }, $ficha->exercise_training_division));
    }

    private function formatEntityData(array $exercise, int $fichaId, int $order): array
    {
        return [
            'ficha_id' => $fichaId,
            'exercise_id' => $exercise['id'],
            'training_division_id' => $exercise['exercise_data[training_division_id]'],
            'series' => $exercise['exercise_data[series]'],
            'repetitions' => $exercise['exercise_data[repetitions]'],
            'weight' => $exercise['exercise_data[weight]'] ?? null,
            'rest' => $exercise['exercise_data[rest]'] ?? null,
            'description' => $exercise['exercise_data[description]'] ?? null,
            'sort_order' => $order,
        ];
    }

    private function getExerciseImageUrl(?string $imageName): string
    {
        $filename = $imageName ?: 'default.jpg';
        return Router::url('/img/exercises/img/' . $filename, true);
    }

    private function getFichasList(): array
    {
        return $this->exerciseTrainingDivision->Fichas->find('list', [
            'keyField' => 'id',
            'valueField' => fn($ficha) => $ficha->student->name,
        ])
            ->where(['Fichas.active' => 1])
            ->contain(['Students'])
            ->toArray();
    }

    private function getActiveExercises()
    {
        return $this->exerciseTrainingDivision->Exercises
            ->find()
            ->contain(['Equipments', 'MuscleGroups'])
            ->where(['Exercises.active' => 1])
            ->order(['Exercises.name' => 'ASC'])
            ->all();
    }

    private function getActiveTrainingDivisions(): array
    {
        return $this->exerciseTrainingDivision->TrainingDivisions
            ->find('list', [
                'keyField' => 'id',
                'valueField' => 'name',
            ])
            ->where(['active' => 1])
            ->toArray();
    }
}
