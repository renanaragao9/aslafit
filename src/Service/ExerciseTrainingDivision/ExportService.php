<?php

declare(strict_types=1);

namespace App\Service\ExerciseTrainingDivision;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $exerciseTrainingDivision;

    public function __construct(Table $exerciseTrainingDivision)
    {
        $this->exerciseTrainingDivision = $exerciseTrainingDivision;
    }

    public function run(): Response
    {
        $data = $this->exerciseTrainingDivision->find('all', [
            'contain' => ['Fichas', 'Exercises', 'TrainingDivisions']
        ])->toArray();

        $csvData = "ID,Ordem,Séries,Repetições,Peso,Descanso,Descrição,Ficha,Exercício,Divisão,Ativo,Criado,Modificado\n";
        foreach ($data as $item) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s\n",
                $item->id,
                $item->order,
                $item->series,
                $item->repetitions,
                $item->weight,
                $item->rest,
                $item->description,
                $item->ficha->id ?? 'N/A',
                $item->exercise->id ?? 'N/A',
                $item->training_division->id ?? 'N/A',
                $item->active ? 'Sim' : 'Não',
                $item->created->format('d/m/Y H:i:s'),
                $item->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('exercise_training_division.csv');
    }
}
