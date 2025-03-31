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

        $entities = $this->exerciseTrainingDivision->newEntities($data['exercises']);

        $errors = [];
        $sortIndex = 1;

        foreach ($entities as $entity) {
            $entity->sort_order = $sortIndex++;

            if (!$this->exerciseTrainingDivision->save($entity)) {
                $errors[] = $entity->getErrors();
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

        // Controller - dentro do create() ou getViewData() no service
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
