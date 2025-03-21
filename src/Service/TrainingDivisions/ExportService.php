<?php

declare(strict_types=1);

namespace App\Service\TrainingDivisions;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $trainingDivisions;

    public function __construct(Table $trainingDivisions)
    {
        $this->trainingDivisions = $trainingDivisions;
    }

    public function run(): Response
    {
        $trainingDivisions = $this->trainingDivisions->find('all', ['contain' => ['ExerciseTrainingDivision']])->toArray();

        $csvData = "ID,Nome,Ativo,Criado,Modificado\n";
        foreach ($trainingDivisions as $division) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s\n",
                $division->id,
                $division->name,
                $division->active ? 'Sim' : 'Não',
                $division->created->format('d/m/Y H:i:s'),
                $division->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('divisao_de_treino.csv');
    }
}
